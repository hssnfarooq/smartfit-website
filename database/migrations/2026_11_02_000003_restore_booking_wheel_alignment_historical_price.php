<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const PRODUCT_ID = 3;

    private const HISTORICAL_PRICE = 4500;

    public function up(): void
    {
        if (! Schema::hasTable('lunar_products')
            || ! Schema::hasTable('lunar_product_variants')
            || ! Schema::hasTable('lunar_prices')) {
            return;
        }

        $product = DB::table('lunar_products')
            ->where('id', self::PRODUCT_ID)
            ->where('product_type_id', 4)
            ->where('status', 'published')
            ->first();

        if (! $product || ! str_contains((string) $product->attribute_data, '4 Wheel Alignment')) {
            return;
        }

        $variant = DB::table('lunar_product_variants')
            ->where('product_id', self::PRODUCT_ID)
            ->whereNull('deleted_at')
            ->orderBy('id')
            ->first();

        if (! $variant) {
            return;
        }

        DB::table('lunar_prices')->updateOrInsert(
            [
                'currency_id' => 1,
                'priceable_type' => 'Lunar\\Models\\ProductVariant',
                'priceable_id' => $variant->id,
                'tier' => 1,
            ],
            [
                'customer_group_id' => null,
                'price' => self::HISTORICAL_PRICE,
                'compare_price' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'csv_import' => 0,
            ]
        );
    }

    public function down(): void
    {
        // This restores historical production data and should not remove it on rollback.
    }
};
