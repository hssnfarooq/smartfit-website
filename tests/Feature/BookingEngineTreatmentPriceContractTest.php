<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookingEngineTreatmentPriceContractTest extends TestCase
{
    public function test_price_repair_targets_every_static_engine_treatment_copy(): void
    {
        $migration = file_get_contents(database_path(
            'migrations/2026_11_05_000001_correct_engine_treatment_price.php'
        ));

        $this->assertStringContainsString('private const PRICE = 9495;', $migration);
        $this->assertStringContainsString("->where('products.product_type_id', 7)", $migration);
        $this->assertStringContainsString("->where('variants.sku', 'S01')", $migration);
        $this->assertStringContainsString("['lunar_prices', 'lunar_prices_ORIG']", $migration);
    }
}
