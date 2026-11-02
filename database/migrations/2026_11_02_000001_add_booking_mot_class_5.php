<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const OPTIONS = [
        2 => [
            'name' => 'MOT Class 4',
            'description' => 'Most cars, taxis, ambulances, motor caravans and small vans up to 3,000kg',
            'price' => 3500,
            'sku' => 'SMARTFIT-MOT-CLASS-4',
        ],
        5 => [
            'name' => 'MOT Class 7',
            'description' => 'Goods vehicles/vans over 3,000kg and up to 3,500kg',
            'price' => 5500,
            'sku' => 'SMARTFIT-MOT-CLASS-7',
        ],
    ];

    private const CLASS_FIVE = [
        'name' => 'MOT Class 5',
        'description' => 'Larger passenger vehicles, generally with 13+ passenger seats',
        'price' => 5500,
        'sku' => 'SMARTFIT-MOT-CLASS-5',
    ];

    public function up(): void
    {
        foreach (self::OPTIONS as $productId => $option) {
            $this->repairExistingOption('lunar_products', 'lunar_product_variants', 'lunar_prices', $productId, $option);

            if ($this->hasStaticBackupTables()) {
                $this->repairExistingOption('lunar_products_ORIG', 'lunar_product_variants_ORIG', 'lunar_prices_ORIG', $productId, $option);
            }
        }

        $productId = $this->ensureClassFive();

        if ($productId && $this->hasStaticBackupTables()) {
            $this->mirrorToStaticBackup($productId, self::CLASS_FIVE['sku']);
        }
    }

    public function down(): void
    {
        $this->removeBySku('lunar_products', 'lunar_product_variants', 'lunar_prices', self::CLASS_FIVE['sku']);

        if ($this->hasStaticBackupTables()) {
            $this->removeBySku('lunar_products_ORIG', 'lunar_product_variants_ORIG', 'lunar_prices_ORIG', self::CLASS_FIVE['sku']);
        }
    }

    private function repairExistingOption(string $productTable, string $variantTable, string $priceTable, int $productId, array $option): void
    {
        if (! Schema::hasTable($productTable) || ! Schema::hasTable($variantTable) || ! Schema::hasTable($priceTable)) {
            return;
        }

        $product = DB::table($productTable)->where('id', $productId)->first();

        if (! $product || (int) $product->product_type_id !== 3) {
            return;
        }

        $this->updateProduct($productTable, $productId, $option);

        $variant = DB::table($variantTable)->where('sku', $option['sku'])->first()
            ?: DB::table($variantTable)->where('product_id', $productId)->orderBy('id')->first();

        if (! $variant) {
            return;
        }

        DB::table($variantTable)->where('id', $variant->id)->update([
            'sku' => $option['sku'],
            'updated_at' => now(),
        ]);

        $this->ensurePrice($priceTable, (int) $variant->id, $option['price']);
    }

    private function ensureClassFive(): ?int
    {
        if (! Schema::hasTable('lunar_products') || ! DB::table('lunar_product_types')->where('id', 3)->exists()) {
            return null;
        }

        $existingVariant = DB::table('lunar_product_variants')->where('sku', self::CLASS_FIVE['sku'])->first();

        if ($existingVariant) {
            $productId = (int) $existingVariant->product_id;
            $this->updateProduct('lunar_products', $productId, self::CLASS_FIVE);
            $this->ensurePrice('lunar_prices', (int) $existingVariant->id, self::CLASS_FIVE['price']);

            return $productId;
        }

        $productId = (int) DB::table('lunar_products')->insertGetId($this->productPayload(self::CLASS_FIVE));
        $variantId = (int) DB::table('lunar_product_variants')->insertGetId($this->variantPayload($productId, self::CLASS_FIVE['sku']));
        $this->ensurePrice('lunar_prices', $variantId, self::CLASS_FIVE['price']);

        return $productId;
    }

    private function mirrorToStaticBackup(int $productId, string $sku): void
    {
        $variant = DB::table('lunar_product_variants')->where('product_id', $productId)->where('sku', $sku)->first();

        if (! $variant) {
            return;
        }

        $existingBackupVariant = DB::table('lunar_product_variants_ORIG')->where('sku', $sku)->first();

        if ($existingBackupVariant) {
            $this->updateProduct('lunar_products_ORIG', (int) $existingBackupVariant->product_id, self::CLASS_FIVE);
            $this->ensurePrice('lunar_prices_ORIG', (int) $existingBackupVariant->id, self::CLASS_FIVE['price']);

            return;
        }

        DB::table('lunar_products_ORIG')->updateOrInsert(
            ['id' => $productId],
            array_diff_key((array) DB::table('lunar_products')->where('id', $productId)->first(), ['id' => true])
        );
        DB::table('lunar_product_variants_ORIG')->updateOrInsert(
            ['id' => $variant->id],
            array_diff_key((array) $variant, ['id' => true])
        );
        $this->ensurePrice('lunar_prices_ORIG', (int) $variant->id, self::CLASS_FIVE['price']);
    }

    private function updateProduct(string $table, int $productId, array $option): void
    {
        $product = DB::table($table)->where('id', $productId)->first();
        $attributes = json_decode($product->attribute_data, true) ?: [];
        $attributes['name'] = [
            'field_type' => 'Lunar\\FieldTypes\\TranslatedText',
            'value' => ['en' => $option['name']],
        ];
        $attributes['description'] = [
            'field_type' => 'Lunar\\FieldTypes\\TranslatedText',
            'value' => ['en' => $option['description']],
        ];

        DB::table($table)->where('id', $productId)->update([
            'status' => 'published',
            'attribute_data' => json_encode($attributes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'updated_at' => now(),
        ]);
    }

    private function productPayload(array $option): array
    {
        return [
            'brand_id' => null,
            'product_type_id' => 3,
            'status' => 'published',
            'attribute_data' => json_encode([
                'name' => ['field_type' => 'Lunar\\FieldTypes\\TranslatedText', 'value' => ['en' => $option['name']]],
                'description' => ['field_type' => 'Lunar\\FieldTypes\\TranslatedText', 'value' => ['en' => $option['description']]],
                'time_slot' => ['field_type' => 'Lunar\\FieldTypes\\Dropdown', 'value' => '1h'],
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            't_import_json' => null,
            'csv_import' => 0,
        ];
    }

    private function variantPayload(int $productId, string $sku): array
    {
        return [
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
        ];
    }

    private function ensurePrice(string $table, int $variantId, int $price): void
    {
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

    private function removeBySku(string $productTable, string $variantTable, string $priceTable, string $sku): void
    {
        if (! Schema::hasTable($variantTable)) {
            return;
        }

        $variant = DB::table($variantTable)->where('sku', $sku)->first();

        if (! $variant) {
            return;
        }

        DB::table($priceTable)->where('priceable_type', 'Lunar\\Models\\ProductVariant')->where('priceable_id', $variant->id)->delete();
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
