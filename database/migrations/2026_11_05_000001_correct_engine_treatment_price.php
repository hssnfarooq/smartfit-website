<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const PRICE = 9495;

    private const PREVIOUS_PRICE = 11985;

    public function up(): void
    {
        $this->setPrice(self::PRICE);
    }

    public function down(): void
    {
        $this->setPrice(self::PREVIOUS_PRICE);
    }

    private function setPrice(int $price): void
    {
        $variantIds = DB::table('lunar_product_variants as variants')
            ->join('lunar_products as products', 'products.id', '=', 'variants.product_id')
            ->where('products.product_type_id', 7)
            ->where('variants.sku', 'S01')
            ->whereNull('variants.deleted_at')
            ->pluck('variants.id');

        if ($variantIds->isEmpty()) {
            return;
        }

        foreach (['lunar_prices', 'lunar_prices_ORIG'] as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            DB::table($table)
                ->where('priceable_type', 'Lunar\\Models\\ProductVariant')
                ->whereIn('priceable_id', $variantIds)
                ->update([
                    'price' => $price,
                    'updated_at' => now(),
                ]);
        }
    }
};
