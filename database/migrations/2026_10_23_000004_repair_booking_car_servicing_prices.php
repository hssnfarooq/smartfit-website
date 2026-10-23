<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const PRICES = [
        'SMARTFIT-INTERIM-SERVICE' => 9495,
        'SMARTFIT-FULL-SERVICE' => 15995,
        'SMARTFIT-MAJOR-SERVICE' => 19495,
    ];

    public function up(): void
    {
        $this->repairPrices('lunar_product_variants', 'lunar_prices');
        $this->repairPrices('lunar_product_variants_ORIG', 'lunar_prices_ORIG');
    }

    public function down(): void
    {
        // These are the canonical booking prices, so rolling this data repair
        // back must not reintroduce the corrupted or missing values.
    }

    private function repairPrices(string $variantTable, string $priceTable): void
    {
        if (! Schema::hasTable($variantTable) || ! Schema::hasTable($priceTable)) {
            return;
        }

        foreach (self::PRICES as $sku => $price) {
            $variantId = DB::table($variantTable)->where('sku', $sku)->value('id');

            if (! $variantId) {
                continue;
            }

            DB::table($priceTable)->updateOrInsert(
                [
                    'currency_id' => 1,
                    'priceable_type' => 'Lunar\\Models\\ProductVariant',
                    'priceable_id' => $variantId,
                    'tier' => 1,
                ],
                [
                    'customer_group_id' => null,
                    'price' => $price,
                    'compare_price' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'csv_import' => 0,
                ]
            );
        }
    }
};
