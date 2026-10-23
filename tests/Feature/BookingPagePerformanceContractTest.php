<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookingPagePerformanceContractTest extends TestCase
{
    public function test_booking_catalogue_uses_a_bounded_option_loader(): void
    {
        $group = file_get_contents(resource_path('views/components/servis-grupa.blade.php'));

        $this->assertFileExists(app_path('Support/BookingServiceOptions.php'));
        $this->assertStringContainsString('BookingServiceOptions::forGroup', $group);
        $this->assertStringNotContainsString("'prices' => function", $group);
        $this->assertStringNotContainsString("'variants' => function", $group);
    }

    public function test_service_option_livewire_state_contains_ids_and_display_values_not_models(): void
    {
        $component = file_get_contents(app_path('Http/Livewire/Components/Servis/AddToCart.php'));
        $group = file_get_contents(resource_path('views/components/servis-grupa.blade.php'));

        $this->assertStringContainsString('public int $purchasableId', $component);
        $this->assertStringContainsString('private function resolvePurchasable()', $component);
        $this->assertStringNotContainsString('public ?Purchasable $purchasable', $component);
        $this->assertStringNotContainsString('public Product $servis', $component);
        $this->assertStringNotContainsString(':purchasable="$variant"', $group);
        $this->assertStringNotContainsString(':servis="$servis"', $group);
    }
}
