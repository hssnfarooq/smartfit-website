<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const OPTIONS = [
        [
            'name' => 'Brake Fluid Change',
            'description' => 'Replace old brake fluid to help maintain consistent braking performance and protect the braking system.',
            'sku' => 'SMARTFIT-BRAKE-QUOTE-FLUID',
        ],
        [
            'name' => 'New Brakes',
            'description' => 'Request an inspection and quote for replacement brake components suited to your vehicle.',
            'sku' => 'SMARTFIT-BRAKE-QUOTE-NEW-BRAKES',
        ],
        [
            'name' => 'Brake Pads',
            'description' => 'Request an inspection and quote for replacement brake pads.',
            'sku' => 'SMARTFIT-BRAKE-QUOTE-PADS',
        ],
        [
            'name' => 'Brake Discs',
            'description' => 'Request an inspection and quote for replacement brake discs.',
            'sku' => 'SMARTFIT-BRAKE-QUOTE-DISCS',
        ],
    ];

    public function up(): void
    {
        foreach (self::OPTIONS as $option) {
            $productId = $this->ensureProduct('lunar_products', $option);

            if (! $productId) {
                continue;
            }

            $variantId = $this->ensureVariant('lunar_product_variants', $productId, $option['sku']);

            if ($variantId) {
                $this->ensurePrice('lunar_prices', $variantId);
            }

            if ($this->hasStaticBackupTables()) {
                $this->mirrorProductToStaticBackup($productId);
                $this->mirrorVariantToStaticBackup($variantId, $productId);

                if ($variantId) {
                    $this->ensurePrice('lunar_prices_ORIG', $variantId);
                }
            }
        }
    }

    public function down(): void
    {
        foreach (self::OPTIONS as $option) {
            $this->removeOption('lunar_products', 'lunar_product_variants', 'lunar_prices', $option['sku']);

            if ($this->hasStaticBackupTables()) {
                $this->removeOption('lunar_products_ORIG', 'lunar_product_variants_ORIG', 'lunar_prices_ORIG', $option['sku']);
            }
        }
    }

    private function ensureProduct(string $table, array $option): ?int
    {
        if (! Schema::hasTable($table) || ! DB::table('lunar_product_types')->where('id', 5)->exists()) {
            return null;
        }

        $variantTable = $table === 'lunar_products' ? 'lunar_product_variants' : 'lunar_product_variants_ORIG';
        $existingProductId = DB::table($variantTable)->where('sku', $option['sku'])->value('product_id');

        if ($existingProductId) {
            return (int) $existingProductId;
        }

        return (int) DB::table($table)->insertGetId([
            'brand_id' => null,
            'product_type_id' => 5,
            'status' => 'published',
            'attribute_data' => json_encode([
                'name' => [
                    'field_type' => 'Lunar\\FieldTypes\\TranslatedText',
                    'value' => ['en' => $option['name']],
                ],
                'description' => [
                    'field_type' => 'Lunar\\FieldTypes\\TranslatedText',
                    'value' => ['en' => $option['description']],
                ],
                'time_slot' => [
                    'field_type' => 'Lunar\\FieldTypes\\Dropdown',
                    'value' => '1h',
                ],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            't_import_json' => null,
            'csv_import' => 0,
        ]);
    }

    private function ensureVariant(string $table, int $productId, string $sku): ?int
    {
        if (! Schema::hasTable($table)) {
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
            'deleted_at' => null,
            'csv_import' => 0,
        ]);
    }

    private function ensurePrice(string $table, int $variantId): void
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
                'price' => 0,
                'compare_price' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'csv_import' => 0,
            ]
        );
    }

    private function mirrorProductToStaticBackup(int $productId): void
    {
        if (DB::table('lunar_products_ORIG')->where('id', $productId)->exists()) {
            return;
        }

        $product = (array) DB::table('lunar_products')->where('id', $productId)->first();
        DB::table('lunar_products_ORIG')->insert($product);
    }

    private function mirrorVariantToStaticBackup(?int $variantId, int $productId): void
    {
        if (! $variantId || DB::table('lunar_product_variants_ORIG')->where('id', $variantId)->exists()) {
            return;
        }

        $variant = (array) DB::table('lunar_product_variants')->where('id', $variantId)->first();
        $variant['product_id'] = $productId;
        DB::table('lunar_product_variants_ORIG')->insert($variant);
    }

    private function removeOption(string $productTable, string $variantTable, string $priceTable, string $sku): void
    {
        if (! Schema::hasTable($productTable) || ! Schema::hasTable($variantTable) || ! Schema::hasTable($priceTable)) {
            return;
        }

        $variant = DB::table($variantTable)->where('sku', $sku)->first();

        if (! $variant) {
            return;
        }

        DB::table($priceTable)
            ->where('priceable_type', 'Lunar\\Models\\ProductVariant')
            ->where('priceable_id', $variant->id)
            ->delete();
        DB::table($variantTable)->where('id', $variant->id)->delete();
        DB::table($productTable)->where('id', $variant->product_id)->delete();
    }

    private function hasStaticBackupTables(): bool
    {
        return Schema::hasTable('lunar_products_ORIG')
            && Schema::hasTable('lunar_product_variants_ORIG')
            && Schema::hasTable('lunar_prices_ORIG');
    }
};
