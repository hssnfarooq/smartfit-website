<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->restorePrices('lunar_products', 'lunar_product_variants', 'lunar_prices');

        if ($this->hasStaticBackupTables()) {
            $this->restorePrices('lunar_products_ORIG', 'lunar_product_variants_ORIG', 'lunar_prices_ORIG');
        }
    }

    public function down(): void
    {
        // Existing Wheel Alignment prices are preserved, so there is nothing safe to undo.
    }

    private function restorePrices(string $productTable, string $variantTable, string $priceTable): void
    {
        if (! Schema::hasTable($productTable) || ! Schema::hasTable($variantTable) || ! Schema::hasTable($priceTable)) {
            return;
        }

        $productIds = DB::table($productTable)
            ->where('product_type_id', 4)
            ->where('status', 'published')
            ->pluck('id');

        foreach (DB::table($variantTable)->whereIn('product_id', $productIds)->whereNull('deleted_at')->get() as $variant) {
            $price = $this->findExistingPositivePrice($priceTable, (int) $variant->id, (string) $variant->sku);

            if ($price === null) {
                continue;
            }

            DB::table($priceTable)->updateOrInsert(
                [
                    'currency_id' => 1,
                    'priceable_type' => 'Lunar\\Models\\ProductVariant',
                    'priceable_id' => $variant->id,
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

    private function findExistingPositivePrice(string $priceTable, int $variantId, string $sku): ?int
    {
        $price = DB::table($priceTable)
            ->where('priceable_type', 'Lunar\\Models\\ProductVariant')
            ->where('priceable_id', $variantId)
            ->where('price', '>', 0)
            ->value('price');

        if ($price !== null) {
            return (int) $price;
        }

        if (! $this->hasStaticBackupTables()) {
            return null;
        }

        $otherVariantTable = $priceTable === 'lunar_prices' ? 'lunar_product_variants_ORIG' : 'lunar_product_variants';
        $otherPriceTable = $priceTable === 'lunar_prices' ? 'lunar_prices_ORIG' : 'lunar_prices';
        $otherVariantId = DB::table($otherVariantTable)->where('sku', $sku)->value('id');

        if (! $otherVariantId) {
            return null;
        }

        $price = DB::table($otherPriceTable)
            ->where('priceable_type', 'Lunar\\Models\\ProductVariant')
            ->where('priceable_id', $otherVariantId)
            ->where('price', '>', 0)
            ->value('price');

        return $price === null ? null : (int) $price;
    }

    private function hasStaticBackupTables(): bool
    {
        return Schema::hasTable('lunar_products_ORIG')
            && Schema::hasTable('lunar_product_variants_ORIG')
            && Schema::hasTable('lunar_prices_ORIG');
    }
};
