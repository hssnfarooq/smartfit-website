<?php

namespace Tests\Feature;

use App\Support\SupplierCatalogueCleaner;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SupplierCatalogueCleanerTest extends TestCase
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

        Schema::create('lunar_products', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->boolean('csv_import')->default(false);
        });
        Schema::create('lunar_product_variants', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('product_id');
            $table->boolean('csv_import')->default(false);
        });
        Schema::create('lunar_prices', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('priceable_type');
            $table->unsignedBigInteger('priceable_id');
            $table->unsignedInteger('price');
            $table->boolean('csv_import')->default(false);
        });
        Schema::create('lunar_urls', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('element_type');
            $table->unsignedBigInteger('element_id');
        });
        Schema::create('lunar_channelables', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('channelable_type');
            $table->unsignedBigInteger('channelable_id');
        });
        Schema::create('search_index', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('key');
            $table->string('index');
        });
    }

    public function test_supplier_cleanup_removes_imported_tyres_without_touching_booking_products(): void
    {
        DB::table('lunar_products')->insert([
            ['id' => 3, 'csv_import' => 0],
            ['id' => 100, 'csv_import' => 1],
        ]);
        DB::table('lunar_product_variants')->insert([
            ['id' => 11, 'product_id' => 3, 'csv_import' => 0],
            ['id' => 200, 'product_id' => 100, 'csv_import' => 1],
        ]);
        DB::table('lunar_prices')->insert([
            ['id' => 1, 'priceable_type' => 'Lunar\\Models\\ProductVariant', 'priceable_id' => 11, 'price' => 4500, 'csv_import' => 0],
            ['id' => 2, 'priceable_type' => 'Lunar\\Models\\ProductVariant', 'priceable_id' => 200, 'price' => 8000, 'csv_import' => 1],
        ]);
        DB::table('lunar_urls')->insert([
            ['id' => 1, 'element_type' => 'Lunar\\Models\\Product', 'element_id' => 3],
            ['id' => 2, 'element_type' => 'Lunar\\Models\\Product', 'element_id' => 100],
        ]);
        DB::table('lunar_channelables')->insert([
            ['id' => 1, 'channelable_type' => 'Lunar\\Models\\Product', 'channelable_id' => 3],
            ['id' => 2, 'channelable_type' => 'Lunar\\Models\\Product', 'channelable_id' => 100],
        ]);
        DB::table('search_index')->insert([
            ['id' => 1, 'key' => '3', 'index' => 'products'],
            ['id' => 2, 'key' => '100', 'index' => 'products'],
        ]);

        $removed = app(SupplierCatalogueCleaner::class)->clear();

        $this->assertSame(1, $removed);
        $this->assertDatabaseHas('lunar_products', ['id' => 3, 'csv_import' => 0]);
        $this->assertDatabaseHas('lunar_product_variants', ['id' => 11, 'product_id' => 3]);
        $this->assertDatabaseHas('lunar_prices', ['priceable_id' => 11, 'price' => 4500]);
        $this->assertDatabaseHas('lunar_urls', ['element_id' => 3]);
        $this->assertDatabaseHas('lunar_channelables', ['channelable_id' => 3]);
        $this->assertDatabaseHas('search_index', ['key' => '3', 'index' => 'products']);

        $this->assertDatabaseMissing('lunar_products', ['id' => 100]);
        $this->assertDatabaseMissing('lunar_product_variants', ['id' => 200]);
        $this->assertDatabaseMissing('lunar_prices', ['priceable_id' => 200]);
        $this->assertDatabaseMissing('lunar_urls', ['element_id' => 100]);
        $this->assertDatabaseMissing('lunar_channelables', ['channelable_id' => 100]);
        $this->assertDatabaseMissing('search_index', ['key' => '100', 'index' => 'products']);
    }
}
