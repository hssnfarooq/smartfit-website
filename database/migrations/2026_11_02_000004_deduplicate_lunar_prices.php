<?php

use App\Support\DuplicatePriceCleaner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::transaction(function () {
            $cleaner = app(DuplicatePriceCleaner::class);

            $cleaner->clean('lunar_prices');
            $this->synchronizeWheelAlignmentBackupPrice();
            $cleaner->clean('lunar_prices_ORIG');
        });
    }

    public function down(): void
    {
        // Duplicate rows are invalid data and are intentionally not restored.
    }

    private function synchronizeWheelAlignmentBackupPrice(): void
    {
        if (! Schema::hasTable('lunar_product_variants')
            || ! Schema::hasTable('lunar_prices')
            || ! Schema::hasTable('lunar_product_variants_ORIG')
            || ! Schema::hasTable('lunar_prices_ORIG')) {
            return;
        }

        $liveVariantId = DB::table('lunar_product_variants')
            ->where('product_id', 3)
            ->whereNull('deleted_at')
            ->orderBy('id')
            ->value('id');

        $backupVariantId = DB::table('lunar_product_variants_ORIG')
            ->where('product_id', 3)
            ->whereNull('deleted_at')
            ->orderBy('id')
            ->value('id');

        if (! $liveVariantId || ! $backupVariantId) {
            throw new \RuntimeException('The 4 Wheel Alignment variant is missing from a price table.');
        }

        $livePrice = DB::table('lunar_prices')
            ->where('currency_id', 1)
            ->where('priceable_type', 'Lunar\\Models\\ProductVariant')
            ->where('priceable_id', $liveVariantId)
            ->whereNull('customer_group_id')
            ->where('tier', 1)
            ->where('price', '>', 0)
            ->value('price');

        if (! $livePrice) {
            throw new \RuntimeException('The 4 Wheel Alignment price is not positive.');
        }

        DB::table('lunar_prices_ORIG')
            ->where('currency_id', 1)
            ->where('priceable_type', 'Lunar\\Models\\ProductVariant')
            ->where('priceable_id', $backupVariantId)
            ->whereNull('customer_group_id')
            ->where('tier', 1)
            ->update([
                'price' => (int) $livePrice,
                'updated_at' => now(),
                'csv_import' => 0,
            ]);
    }
};
