<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const OPTIONS = [
        2 => [
            'name' => 'MOT Class 4',
            'description' => 'Most cars, taxis, ambulances, motor caravans and small vans up to 3,000kg',
            'price' => 3500,
        ],
        5 => [
            'name' => 'MOT Class 7',
            'description' => 'Goods vehicles/vans over 3,000kg and up to 3,500kg',
            'price' => 5500,
        ],
    ];

    public function up(): void
    {
        foreach (self::OPTIONS as $productId => $option) {
            $this->updateProduct($productId, $option['name'], $option['description']);
            $this->updateVariantPrices($productId, $option['price']);
        }
    }

    public function down(): void
    {
        $this->updateProduct(2, 'MOT Class 7', null);
        $this->updateVariantPrices(2, 16985);

        $this->updateProduct(5, 'MOT Class 7', null);
        $this->updateVariantPrices(5, 5500);
    }

    private function updateProduct(int $productId, string $name, ?string $description): void
    {
        $product = DB::table('lunar_products')->where('id', $productId)->first();

        if (! $product || (int) $product->product_type_id !== 3) {
            return;
        }

        $attributeData = json_decode($product->attribute_data, true) ?: [];
        $attributeData['name'] = [
            'field_type' => 'Lunar\\FieldTypes\\TranslatedText',
            'value' => ['en' => $name],
        ];
        $attributeData['description'] = [
            'field_type' => 'Lunar\\FieldTypes\\TranslatedText',
            'value' => ['en' => $description],
        ];

        DB::table('lunar_products')
            ->where('id', $productId)
            ->update([
                'attribute_data' => json_encode($attributeData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                'updated_at' => now(),
            ]);
    }

    private function updateVariantPrices(int $productId, int $price): void
    {
        $variantIds = DB::table('lunar_product_variants')
            ->where('product_id', $productId)
            ->pluck('id');

        if ($variantIds->isEmpty()) {
            return;
        }

        DB::table('lunar_prices')
            ->whereIn('priceable_id', $variantIds)
            ->where('priceable_type', 'Lunar\\Models\\ProductVariant')
            ->update([
                'price' => $price,
                'updated_at' => now(),
            ]);
    }
};
