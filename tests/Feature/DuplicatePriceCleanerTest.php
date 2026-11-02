<?php

namespace Tests\Feature;

use App\Support\DuplicatePriceCleaner;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use RuntimeException;
use Tests\TestCase;

class DuplicatePriceCleanerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');
        DB::setDefaultConnection('sqlite');

        Schema::create('lunar_prices', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('customer_group_id')->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->string('priceable_type');
            $table->unsignedBigInteger('priceable_id');
            $table->unsignedInteger('price');
            $table->unsignedInteger('tier')->default(1);
            $table->boolean('csv_import')->default(false);
            $table->timestamps();
        });
        Schema::create('lunar_prices_ORIG', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('customer_group_id')->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->string('priceable_type');
            $table->unsignedBigInteger('priceable_id');
            $table->unsignedInteger('price');
            $table->unsignedInteger('tier')->default(1);
            $table->boolean('csv_import')->default(false);
            $table->timestamps();
        });
        Schema::create('lunar_product_variants', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('product_id');
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::create('lunar_product_variants_ORIG', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('product_id');
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function test_it_keeps_one_row_for_each_identical_duplicate_price_key(): void
    {
        $this->insertPrice(1, 10, 3500);
        $this->insertPrice(2, 10, 3500);
        $this->insertPrice(3, 10, 3500);

        $removed = app(DuplicatePriceCleaner::class)->clean('lunar_prices');

        $this->assertSame(2, $removed);
        $this->assertSame([1], DB::table('lunar_prices')->pluck('id')->all());
    }

    public function test_it_prefers_the_single_positive_value_over_duplicate_zero_prices(): void
    {
        $this->insertPrice(1, 11, 4500);
        $this->insertPrice(2, 11, 0);
        $this->insertPrice(3, 11, 0);

        $removed = app(DuplicatePriceCleaner::class)->clean('lunar_prices');

        $this->assertSame(2, $removed);
        $this->assertDatabaseHas('lunar_prices', ['id' => 1, 'priceable_id' => 11, 'price' => 4500]);
        $this->assertSame(1, DB::table('lunar_prices')->where('priceable_id', 11)->count());
    }

    public function test_it_does_not_merge_different_customer_groups_or_tiers(): void
    {
        $this->insertPrice(1, 12, 1000, null, 1);
        $this->insertPrice(2, 12, 1000, 7, 1);
        $this->insertPrice(3, 12, 900, null, 2);

        $removed = app(DuplicatePriceCleaner::class)->clean('lunar_prices');

        $this->assertSame(0, $removed);
        $this->assertSame(3, DB::table('lunar_prices')->count());
    }

    public function test_it_refuses_to_choose_between_multiple_positive_prices(): void
    {
        $this->insertPrice(1, 13, 3500);
        $this->insertPrice(2, 13, 5500);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('multiple positive prices');

        app(DuplicatePriceCleaner::class)->clean('lunar_prices');
    }

    public function test_cleanup_migration_covers_live_and_static_backup_price_tables(): void
    {
        $migration = file_get_contents(database_path('migrations/2026_11_02_000004_deduplicate_lunar_prices.php'));

        $this->assertStringContainsString("clean('lunar_prices')", $migration);
        $this->assertStringContainsString("clean('lunar_prices_ORIG')", $migration);
        $this->assertStringContainsString('synchronizeWheelAlignmentBackupPrice', $migration);
    }

    public function test_cleanup_migration_deduplicates_both_tables_and_preserves_wheel_alignment_price(): void
    {
        DB::table('lunar_product_variants')->insert([
            'id' => 11,
            'product_id' => 3,
            'deleted_at' => null,
        ]);
        DB::table('lunar_product_variants_ORIG')->insert([
            'id' => 11,
            'product_id' => 3,
            'deleted_at' => null,
        ]);

        $this->insertPrice(1, 11, 4500);
        $this->insertPrice(2, 11, 0);
        DB::table('lunar_prices_ORIG')->insert([
            $this->priceRow(1, 11, 0),
            $this->priceRow(2, 11, 0),
        ]);

        $migration = require database_path('migrations/2026_11_02_000004_deduplicate_lunar_prices.php');
        $migration->up();

        $this->assertSame(1, DB::table('lunar_prices')->where('priceable_id', 11)->count());
        $this->assertSame(4500, (int) DB::table('lunar_prices')->where('priceable_id', 11)->value('price'));
        $this->assertSame(1, DB::table('lunar_prices_ORIG')->where('priceable_id', 11)->count());
        $this->assertSame(4500, (int) DB::table('lunar_prices_ORIG')->where('priceable_id', 11)->value('price'));
    }

    private function insertPrice(
        int $id,
        int $variantId,
        int $price,
        ?int $customerGroupId = null,
        int $tier = 1
    ): void {
        DB::table('lunar_prices')->insert($this->priceRow(
            $id,
            $variantId,
            $price,
            $customerGroupId,
            $tier
        ));
    }

    private function priceRow(
        int $id,
        int $variantId,
        int $price,
        ?int $customerGroupId = null,
        int $tier = 1
    ): array {
        return [
            'id' => $id,
            'customer_group_id' => $customerGroupId,
            'currency_id' => 1,
            'priceable_type' => 'Lunar\\Models\\ProductVariant',
            'priceable_id' => $variantId,
            'price' => $price,
            'tier' => $tier,
            'csv_import' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
