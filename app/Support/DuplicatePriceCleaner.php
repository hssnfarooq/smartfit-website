<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use RuntimeException;

class DuplicatePriceCleaner
{
    private const KEY_COLUMNS = [
        'currency_id',
        'priceable_type',
        'priceable_id',
        'customer_group_id',
        'tier',
    ];

    public function clean(string $table): int
    {
        if (! preg_match('/^[A-Za-z0-9_]+$/', $table)) {
            throw new RuntimeException('Invalid price table name.');
        }

        if (! Schema::hasTable($table)) {
            return 0;
        }

        return DB::transaction(function () use ($table) {
            $groups = DB::table($table)
                ->select(self::KEY_COLUMNS)
                ->selectRaw('COUNT(*) as row_count')
                ->groupBy(self::KEY_COLUMNS)
                ->havingRaw('COUNT(*) > 1')
                ->get();

            $duplicateSets = $groups->map(function ($group) use ($table) {
                $rows = $this->queryForKey($table, $group)
                    ->orderBy('id')
                    ->get();

                $positivePrices = $rows
                    ->pluck('price')
                    ->map(fn ($price) => (int) $price)
                    ->filter(fn (int $price) => $price > 0)
                    ->unique()
                    ->values();

                if ($positivePrices->count() > 1) {
                    throw new RuntimeException(
                        "Refusing to deduplicate {$table} priceable {$group->priceable_id}: multiple positive prices exist."
                    );
                }

                $allPrices = $rows
                    ->pluck('price')
                    ->map(fn ($price) => (int) $price)
                    ->unique()
                    ->values();

                if ($positivePrices->isEmpty() && $allPrices->count() > 1) {
                    throw new RuntimeException(
                        "Refusing to deduplicate {$table} priceable {$group->priceable_id}: conflicting non-positive prices exist."
                    );
                }

                $authoritativePrice = $positivePrices->first() ?? $allPrices->first();
                $keepId = (int) $rows
                    ->first(fn ($row) => (int) $row->price === (int) $authoritativePrice)
                    ->id;

                return [
                    'keep_id' => $keepId,
                    'delete_ids' => $rows->pluck('id')
                        ->map(fn ($id) => (int) $id)
                        ->reject(fn (int $id) => $id === $keepId)
                        ->values(),
                ];
            });

            return $duplicateSets->sum(function (array $set) use ($table) {
                if ($set['delete_ids']->isEmpty()) {
                    return 0;
                }

                return DB::table($table)->whereIn('id', $set['delete_ids'])->delete();
            });
        });
    }

    private function queryForKey(string $table, object $group)
    {
        $query = DB::table($table)
            ->where('currency_id', $group->currency_id)
            ->where('priceable_type', $group->priceable_type)
            ->where('priceable_id', $group->priceable_id)
            ->where('tier', $group->tier);

        return $group->customer_group_id === null
            ? $query->whereNull('customer_group_id')
            : $query->where('customer_group_id', $group->customer_group_id);
    }
}
