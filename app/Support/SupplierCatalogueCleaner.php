<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;

class SupplierCatalogueCleaner
{
    public function clear(): int
    {
        return DB::transaction(function (): int {
            $productIds = DB::table('lunar_products')
                ->where('csv_import', 1)
                ->pluck('id');

            if ($productIds->isEmpty()) {
                return 0;
            }

            $variantIds = DB::table('lunar_product_variants')
                ->whereIn('product_id', $productIds)
                ->pluck('id');

            if (Schema::hasTable('search_index')) {
                DB::table('search_index')
                    ->where('index', 'products')
                    ->whereIn('key', $productIds->map(fn ($id) => (string) $id))
                    ->delete();
            }

            if (Schema::hasTable('lunar_channelables')) {
                DB::table('lunar_channelables')
                    ->where('channelable_type', Product::class)
                    ->whereIn('channelable_id', $productIds)
                    ->delete();
            }

            DB::table('lunar_urls')
                ->where('element_type', Product::class)
                ->whereIn('element_id', $productIds)
                ->delete();

            DB::table('lunar_prices')
                ->where('priceable_type', ProductVariant::class)
                ->whereIn('priceable_id', $variantIds)
                ->delete();

            DB::table('lunar_product_variants')
                ->whereIn('id', $variantIds)
                ->delete();

            DB::table('lunar_products')
                ->whereIn('id', $productIds)
                ->delete();

            return $productIds->count();
        });
    }
}
