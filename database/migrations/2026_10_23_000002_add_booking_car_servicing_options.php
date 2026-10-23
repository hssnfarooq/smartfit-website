<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const OPTIONS = [
        140 => [
            'name' => 'Interim Service',
            'description' => 'Our interim service is recommended for high mileage drivers who want peace of mind between annual services.',
            'price' => 9495,
            'sku' => 'SMARTFIT-INTERIM-SERVICE',
            'time_slot' => '2h',
        ],
        20 => [
            'name' => 'Full Service',
            'description' => 'A full service is a thorough inspection of your vehicle with a 53 point check covering everything from essential fluids under the bonnet to brake discs and pads.',
            'price' => 15995,
            'sku' => 'SMARTFIT-FULL-SERVICE',
            'time_slot' => '1.5h',
        ],
        110 => [
            'name' => 'Major Service',
            'description' => 'A major service is a thorough inspection of your vehicle with a check covering everything from fuel filter, spark plugs and pads.',
            'price' => 19495,
            'sku' => 'SMARTFIT-MAJOR-SERVICE',
            'time_slot' => '2h',
        ],
    ];

    public function up(): void
    {
        foreach (self::OPTIONS as $productId => $option) {
            $this->updateProduct('lunar_products', $productId, $option);
            $variantId = $this->ensureVariant('lunar_product_variants', $productId, $option['sku']);

            if ($variantId) {
                $this->ensurePrice('lunar_prices', $variantId, $option['price']);
            }

            if ($this->hasStaticBackupTables()) {
                $this->updateProduct('lunar_products_ORIG', $productId, $option);
                $this->mirrorVariantToStaticBackup($variantId, $productId, $option['sku']);

                if ($variantId) {
                    $this->ensurePrice('lunar_prices_ORIG', $variantId, $option['price']);
                }
            }
        }
    }

    public function down(): void
    {
        foreach (self::OPTIONS as $productId => $option) {
            $this->removeOption('lunar_product_variants', 'lunar_prices', $option['sku']);

            if ($this->hasStaticBackupTables()) {
                $this->removeOption('lunar_product_variants_ORIG', 'lunar_prices_ORIG', $option['sku']);
            }

            $originalName = str_replace(' Service', ' Car Service', $option['name']);
            $restored = $option;
            $restored['name'] = $originalName;
            $restored['description'] = '<p>'.$option['description'].'</p>';

            $this->updateProduct('lunar_products', $productId, $restored);

            if ($this->hasStaticBackupTables()) {
                $this->updateProduct('lunar_products_ORIG', $productId, $restored);
            }
        }
    }

    private function updateProduct(string $table, int $productId, array $option): void
    {
        if (! Schema::hasTable($table)) {
            return;
        }

        $product = DB::table($table)->where('id', $productId)->first();

        if (! $product || (int) $product->product_type_id !== 2) {
            return;
        }

        $attributeData = json_decode($product->attribute_data, true) ?: [];
        $attributeData['name'] = [
            'field_type' => 'Lunar\\FieldTypes\\TranslatedText',
            'value' => ['en' => $option['name']],
        ];
        $attributeData['description'] = [
            'field_type' => 'Lunar\\FieldTypes\\TranslatedText',
            'value' => ['en' => $option['description']],
        ];
        $attributeData['time_slot'] = [
            'field_type' => 'Lunar\\FieldTypes\\Dropdown',
            'value' => $option['time_slot'],
        ];

        DB::table($table)
            ->where('id', $productId)
            ->update([
                'attribute_data' => json_encode($attributeData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'updated_at' => now(),
            ]);
    }

    private function ensureVariant(string $table, int $productId, string $sku): ?int
    {
        if (! Schema::hasTable($table) || ! DB::table('lunar_products')->where('id', $productId)->exists()) {
            return null;
        }

        $existing = DB::table($table)->where('sku', $sku)->first();

        if ($existing) {
            return (int) $existing->id;
        }

        return (int) DB::table($table)->insertGetId([
            'product_id' => $productId,
            'tax_class_id' => 1,
            'attribute_data' => '[]',
            'unit_quantity' => 1,
            'sku' => $sku,
            'shippable' => 0,
            'stock' => 0,
            'backorder' => 0,
            'purchasable' => 'always',
            'created_at' => now(),
            'updated_at' => now(),
            'csv_import' => 0,
        ]);
    }

    private function mirrorVariantToStaticBackup(?int $variantId, int $productId, string $sku): void
    {
        if (! $variantId || DB::table('lunar_product_variants_ORIG')->where('id', $variantId)->exists()) {
            return;
        }

        $variant = (array) DB::table('lunar_product_variants')->where('id', $variantId)->first();
        $variant['product_id'] = $productId;
        $variant['sku'] = $sku;

        DB::table('lunar_product_variants_ORIG')->insert($variant);
    }

    private function ensurePrice(string $table, int $variantId, int $price): void
    {
        if (! Schema::hasTable($table)) {
            return;
        }

        DB::table($table)->updateOrInsert(
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

    private function removeOption(string $variantTable, string $priceTable, string $sku): void
    {
        if (! Schema::hasTable($variantTable) || ! Schema::hasTable($priceTable)) {
            return;
        }

        $variantIds = DB::table($variantTable)->where('sku', $sku)->pluck('id');

        DB::table($priceTable)
            ->whereIn('priceable_id', $variantIds)
            ->where('priceable_type', 'Lunar\\Models\\ProductVariant')
            ->delete();

        DB::table($variantTable)->whereIn('id', $variantIds)->delete();
    }

    private function hasStaticBackupTables(): bool
    {
        return Schema::hasTable('lunar_products_ORIG')
            && Schema::hasTable('lunar_product_variants_ORIG')
            && Schema::hasTable('lunar_prices_ORIG');
    }
};
