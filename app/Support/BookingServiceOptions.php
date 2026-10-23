<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Lunar\Models\Price;
use Lunar\Models\Product;
use Lunar\Models\ProductVariant;

class BookingServiceOptions
{
    private const PRODUCT_ORDER = [
        2 => [140, 20, 110],
        3 => [2, 5],
    ];

    private const BRAKE_SKUS = [
        'SMARTFIT-BRAKE-QUOTE-FLUID',
        'SMARTFIT-BRAKE-QUOTE-NEW-BRAKES',
        'SMARTFIT-BRAKE-QUOTE-PADS',
        'SMARTFIT-BRAKE-QUOTE-DISCS',
    ];

    public static function forGroup(int $groupId): Collection
    {
        $currencyId = CartPriceGuard::currentCurrencyId();

        if (! $currencyId) {
            return collect();
        }

        $productOrder = self::PRODUCT_ORDER[$groupId] ?? [];
        $allowsZeroPrice = in_array($groupId, [5, 9], true);

        $products = Product::query()
            ->where('product_type_id', $groupId)
            ->where('status', 'published')
            ->when($productOrder !== [], fn ($query) => $query->whereIn('id', $productOrder))
            ->orderBy('id')
            ->get();

        if ($products->isEmpty()) {
            return collect();
        }

        $variantTable = (new ProductVariant)->getTable();
        $priceTable = (new Price)->getTable();

        $variantIdsByProduct = DB::table($variantTable.' as variants')
            ->join($priceTable.' as prices', function ($join) use ($currencyId) {
                $join->on('prices.priceable_id', '=', 'variants.id')
                    ->where('prices.priceable_type', ProductVariant::class)
                    ->where('prices.currency_id', $currencyId);
            })
            ->whereIn('variants.product_id', $products->pluck('id'))
            ->when($groupId === 5, fn ($query) => $query->whereIn('variants.sku', self::BRAKE_SKUS))
            ->where('prices.price', $allowsZeroPrice ? '>=' : '>', 0)
            ->whereNull('variants.deleted_at')
            ->groupBy('variants.product_id')
            ->selectRaw('variants.product_id, MIN(variants.id) as variant_id')
            ->pluck('variant_id', 'product_id');

        if ($variantIdsByProduct->isEmpty()) {
            return collect();
        }

        $variants = ProductVariant::query()
            ->whereIn('id', $variantIdsByProduct->values())
            ->get()
            ->keyBy('product_id');

        $priceIdsByVariant = DB::table($priceTable)
            ->where('priceable_type', ProductVariant::class)
            ->where('currency_id', $currencyId)
            ->whereIn('priceable_id', $variantIdsByProduct->values())
            ->where('price', $allowsZeroPrice ? '>=' : '>', 0)
            ->groupBy('priceable_id')
            ->selectRaw('priceable_id, MIN(id) as price_id')
            ->pluck('price_id', 'priceable_id');

        $prices = Price::query()
            ->with(['currency', 'priceable'])
            ->whereIn('id', $priceIdsByVariant->values())
            ->get()
            ->keyBy('priceable_id');

        $options = $products->map(function (Product $product) use ($variants, $prices) {
            $variant = $variants->get($product->id);

            if (! $variant) {
                return null;
            }

            $price = $prices->get($variant->id);

            return [
                'product_id' => (int) $product->id,
                'variant_id' => (int) $variant->id,
                'name' => (string) $product->translateAttribute('name'),
                'description' => (string) $product->translateAttribute('description'),
                'price_label' => $price?->priceIncTax()->formatted(),
                'price_value' => $price ? (int) $price->getRawOriginal('price') : null,
                'sku' => (string) $variant->sku,
            ];
        })->filter();

        if ($productOrder !== []) {
            $positions = array_flip($productOrder);

            return $options
                ->sortBy(fn (array $option) => $positions[$option['product_id']] ?? PHP_INT_MAX)
                ->values();
        }

        if ($groupId === 5) {
            $positions = array_flip(self::BRAKE_SKUS);

            return $options
                ->sortBy(fn (array $option) => $positions[$option['sku']] ?? PHP_INT_MAX)
                ->values();
        }

        return $options->values();
    }
}
