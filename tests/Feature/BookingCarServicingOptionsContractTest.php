<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookingCarServicingOptionsContractTest extends TestCase
{
    public function test_servicing_cards_have_the_required_content_and_prices(): void
    {
        $card = file_get_contents(resource_path('views/components/servis-item-radio.blade.php'));

        foreach ([
            'Interim Service',
            'Our interim service is recommended for high mileage drivers who want peace of mind between annual services.',
            "'price' => '£94.95'",
            'Full Service',
            'A full service is a thorough inspection of your vehicle with a 53 point check covering everything from essential fluids under the bonnet to brake discs and pads.',
            "'price' => '£159.95'",
            'Major Service',
            'A major service is a thorough inspection of your vehicle with a check covering everything from fuel filter, spark plugs and pads.',
            "'price' => '£194.95'",
        ] as $content) {
            $this->assertStringContainsString($content, $card);
        }
    }

    public function test_servicing_cards_use_the_shared_compact_three_column_layout(): void
    {
        $loader = file_get_contents(app_path('Support/BookingServiceOptions.php'));
        $group = file_get_contents(resource_path('views/components/servis-grupa.blade.php'));
        $item = file_get_contents(resource_path('views/livewire/components/servis/add-to-cart.blade.php'));
        $css = file_get_contents(public_path('assets/css/moj.css'));

        $this->assertStringContainsString("2 => [140, 20, 110]", $loader);
        $this->assertStringContainsString('booking-servicing-options', $group);
        $this->assertStringContainsString('col-md-4 booking-compact-option', $item);
        $this->assertStringContainsString('booking-servicing-option', $item);
        $this->assertStringContainsString('.booking-compact-card', $css);
    }

    public function test_servicing_migration_creates_real_checkout_prices(): void
    {
        $migration = file_get_contents(database_path('migrations/2026_10_23_000002_add_booking_car_servicing_options.php'));

        foreach ([
            "'price' => 9495",
            "'price' => 15995",
            "'price' => 19495",
            'SMARTFIT-INTERIM-SERVICE',
            'SMARTFIT-FULL-SERVICE',
            'SMARTFIT-MAJOR-SERVICE',
        ] as $content) {
            $this->assertStringContainsString($content, $migration);
        }
    }

    public function test_servicing_prices_are_repaired_and_static_catalog_matches_variants_by_sku(): void
    {
        $repairMigration = database_path('migrations/2026_10_23_000004_repair_booking_car_servicing_prices.php');

        $this->assertFileExists($repairMigration);

        $repair = file_get_contents($repairMigration);
        $controller = file_get_contents(app_path('Http/Controllers/Api/V1/ProductController.php'));

        foreach ([
            "'SMARTFIT-INTERIM-SERVICE' => 9495",
            "'SMARTFIT-FULL-SERVICE' => 15995",
            "'SMARTFIT-MAJOR-SERVICE' => 19495",
            'lunar_prices_ORIG',
        ] as $content) {
            $this->assertStringContainsString($content, $repair);
        }

        $this->assertStringContainsString("->keyBy('sku')", $controller);
        $this->assertStringContainsString('$variants_old->get($variant->sku)', $controller);
        $this->assertStringNotContainsString('$variants_old[$i]->id', $controller);
    }
}
