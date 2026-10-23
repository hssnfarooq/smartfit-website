<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->setPriceToZero('lunar_product_variants', 'lunar_prices');
        $this->setPriceToZero('lunar_product_variants_ORIG', 'lunar_prices_ORIG');
    }

    public function down(): void
    {
        // The complimentary check's canonical price is zero. Reverting this
        // data repair must not restore the incorrect historical charges.
    }

    private function setPriceToZero(string $variantTable, string $priceTable): void
    {
        if (! Schema::hasTable($variantTable) || ! Schema::hasTable($priceTable)) {
            return;
        }

        $variantIds = DB::table($variantTable)
            ->where('product_id', 4)
            ->pluck('id');

        if ($variantIds->isEmpty()) {
            return;
        }

        DB::table($priceTable)
            ->where('priceable_type', 'Lunar\\Models\\ProductVariant')
            ->whereIn('priceable_id', $variantIds)
            ->update(['price' => 0, 'updated_at' => now()]);
    }
};
