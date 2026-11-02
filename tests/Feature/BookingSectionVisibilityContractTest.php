<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookingSectionVisibilityContractTest extends TestCase
{
    public function test_empty_service_groups_are_not_rendered(): void
    {
        $group = file_get_contents(resource_path('views/components/servis-grupa.blade.php'));

        $this->assertStringContainsString('@if($servisi->isNotEmpty())', $group);
    }

    public function test_wheel_alignment_keeps_its_existing_positive_price_in_the_active_currency(): void
    {
        $migration = file_get_contents(database_path('migrations/2026_11_02_000002_restore_booking_wheel_alignment.php'));

        $this->assertStringContainsString("->where('product_type_id', 4)", $migration);
        $this->assertStringContainsString("->where('price', '>', 0)", $migration);
        $this->assertStringContainsString("'currency_id' => 1", $migration);
        $this->assertStringContainsString('lunar_prices_ORIG', $migration);
    }
}
