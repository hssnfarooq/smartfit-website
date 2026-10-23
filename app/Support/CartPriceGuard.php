<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Lunar\Base\Purchasable;
use Lunar\Models\Currency;
use Lunar\Models\ProductVariant;

class CartPriceGuard
{
    private const PRICE_ON_REQUEST_SKU_PREFIX = 'SMARTFIT-BRAKE-QUOTE-';
    private const COMPLIMENTARY_PRODUCT_TYPE_ID = 9;

    private static function table(string $name): string
    {
        return config('lunar.database.table_prefix').$name;
    }

    public static function currentCurrencyId(): ?int
    {
        $cartId = session(config('lunar.cart.session_key'));

        if ($cartId) {
            $currencyId = DB::table(self::table('carts'))
                ->where('id', $cartId)
                ->value('currency_id');

            if ($currencyId) {
                return (int) $currencyId;
            }
        }

        return Currency::getDefault()?->id;
    }

    public static function purchasableHasCurrencyPrice(?Purchasable $purchasable): bool
    {
        $currencyId = self::currentCurrencyId();

        if (! $currencyId || ! $purchasable instanceof ProductVariant) {
            return false;
        }

        $minimumPrice = self::isPriceOnRequest($purchasable) || self::isComplimentaryFreeCheck($purchasable) ? 0 : 1;

        return DB::table(self::table('prices'))
            ->where('priceable_type', ProductVariant::class)
            ->where('priceable_id', $purchasable->id)
            ->where('currency_id', $currencyId)
            ->where('price', '>=', $minimumPrice)
            ->exists();
    }

    public static function isPriceOnRequest(?Purchasable $purchasable): bool
    {
        return $purchasable instanceof ProductVariant
            && str_starts_with((string) $purchasable->sku, self::PRICE_ON_REQUEST_SKU_PREFIX);
    }

    public static function isComplimentaryFreeCheck(?Purchasable $purchasable): bool
    {
        if (! $purchasable instanceof ProductVariant) {
            return false;
        }

        return DB::table(self::table('product_variants').' as variants')
            ->join(self::table('products').' as products', 'products.id', '=', 'variants.product_id')
            ->where('variants.id', $purchasable->id)
            ->where('products.product_type_id', self::COMPLIMENTARY_PRODUCT_TYPE_ID)
            ->exists();
    }

    public static function pruneCurrentCartLinesWithoutCurrencyPrices(): int
    {
        $cartId = session(config('lunar.cart.session_key'));

        if (! $cartId) {
            return 0;
        }

        $currencyId = self::currentCurrencyId();

        if (! $currencyId) {
            return 0;
        }

        $cartLinesTable = self::table('cart_lines');
        $pricesTable = self::table('prices');
        $variantsTable = self::table('product_variants');
        $productsTable = self::table('products');

        return DB::table($cartLinesTable)
            ->where('cart_id', $cartId)
            ->where('purchasable_type', ProductVariant::class)
            ->whereNotExists(function ($query) use ($cartLinesTable, $pricesTable, $variantsTable, $productsTable, $currencyId) {
                $query->select(DB::raw(1))
                    ->from($pricesTable)
                    ->where('priceable_type', ProductVariant::class)
                    ->whereColumn($pricesTable.'.priceable_id', $cartLinesTable.'.purchasable_id')
                    ->where('currency_id', $currencyId)
                    ->where(function ($priceQuery) use ($pricesTable, $variantsTable, $productsTable, $cartLinesTable) {
                        $priceQuery->where($pricesTable.'.price', '>', 0)
                            ->orWhere(function ($zeroPriceQuery) use ($pricesTable, $variantsTable, $productsTable, $cartLinesTable) {
                                $zeroPriceQuery
                                    ->where($pricesTable.'.price', 0)
                                    ->whereExists(function ($variantQuery) use ($variantsTable, $productsTable, $cartLinesTable) {
                                        $variantQuery->select(DB::raw(1))
                                            ->from($variantsTable)
                                            ->whereColumn($variantsTable.'.id', $cartLinesTable.'.purchasable_id')
                                            ->where(function ($eligibleVariantQuery) use ($variantsTable, $productsTable) {
                                                $eligibleVariantQuery
                                                    ->where($variantsTable.'.sku', 'like', self::PRICE_ON_REQUEST_SKU_PREFIX.'%')
                                                    ->orWhereExists(function ($productQuery) use ($variantsTable, $productsTable) {
                                                        $productQuery->select(DB::raw(1))
                                                            ->from($productsTable)
                                                            ->whereColumn($productsTable.'.id', $variantsTable.'.product_id')
                                                            ->where($productsTable.'.product_type_id', self::COMPLIMENTARY_PRODUCT_TYPE_ID);
                                                    });
                                            });
                                    });
                            });
                    });
            })
            ->delete();
    }
}
