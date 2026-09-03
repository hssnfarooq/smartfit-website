<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Lunar\Base\Purchasable;
use Lunar\Models\Currency;
use Lunar\Models\ProductVariant;

class CartPriceGuard
{
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

        return DB::table(self::table('prices'))
            ->where('priceable_type', ProductVariant::class)
            ->where('priceable_id', $purchasable->id)
            ->where('currency_id', $currencyId)
            ->where('price', '>', 0)
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

        return DB::table($cartLinesTable)
            ->where('cart_id', $cartId)
            ->where('purchasable_type', ProductVariant::class)
            ->whereNotExists(function ($query) use ($cartLinesTable, $pricesTable, $currencyId) {
                $query->select(DB::raw(1))
                    ->from($pricesTable)
                    ->where('priceable_type', ProductVariant::class)
                    ->whereColumn($pricesTable.'.priceable_id', $cartLinesTable.'.purchasable_id')
                    ->where('currency_id', $currencyId)
                    ->where('price', '>', 0);
            })
            ->delete();
    }
}
