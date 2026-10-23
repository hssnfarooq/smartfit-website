<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookingBrakeOptionsContractTest extends TestCase
{
    public function test_brake_section_contains_the_four_requested_checkbox_options(): void
    {
        $migration = file_get_contents(database_path('migrations/2026_10_23_000003_add_booking_brake_options.php'));

        foreach (['Brake Fluid Change', 'New Brakes', 'Brake Pads', 'Brake Discs'] as $option) {
            $this->assertStringContainsString("'name' => '{$option}'", $migration);
        }

        $this->assertStringContainsString("'price' => 0", $migration);
    }

    public function test_brake_rows_use_real_independent_checkboxes_and_request_pricing(): void
    {
        $checkbox = file_get_contents(resource_path('views/components/servis-item-chkbox.blade.php'));

        $this->assertStringContainsString('type="checkbox"', $checkbox);
        $this->assertStringContainsString('booking-checkbox-option__control', $checkbox);
        $this->assertStringContainsString('booking-checkbox-option__help', $checkbox);
        $this->assertStringContainsString('Price on request', $checkbox);
        $this->assertStringContainsString('wire:click="{{$checked ? \'makniServis\' : \'addToCart\'}}"', $checkbox);
    }

    public function test_brake_layout_is_scoped_and_responsive(): void
    {
        $group = file_get_contents(resource_path('views/components/servis-grupa.blade.php'));
        $loader = file_get_contents(app_path('Support/BookingServiceOptions.php'));
        $css = file_get_contents(public_path('assets/css/moj.css'));

        foreach (['booking-checkbox-options', 'booking-brake-options'] as $content) {
            $this->assertStringContainsString($content, $group);
        }

        $this->assertStringContainsString('SMARTFIT-BRAKE-QUOTE-FLUID', $loader);

        foreach (['.booking-checkbox-option', '.booking-checkbox-option__control', '.booking-checkbox-option__help', '@media (max-width: 575.98px)'] as $selector) {
            $this->assertStringContainsString($selector, $css);
        }
    }

    public function test_unchecked_brake_checkbox_is_white_with_an_explicit_outline(): void
    {
        $css = file_get_contents(public_path('assets/css/moj.css'));

        $this->assertStringContainsString('appearance: none;', $css);
        $this->assertStringContainsString('background-color: #ffffff !important;', $css);
        $this->assertStringContainsString('.booking-checkbox-option__control:checked', $css);
        $this->assertStringContainsString('background-color: #ed1e24 !important;', $css);
    }

    public function test_price_on_request_brake_lines_are_allowed_and_preserved(): void
    {
        $guard = file_get_contents(app_path('Support/CartPriceGuard.php'));
        $cart = file_get_contents(app_path('Http/Livewire/Components/Cart.php'));

        $this->assertStringContainsString("PRICE_ON_REQUEST_SKU_PREFIX = 'SMARTFIT-BRAKE-QUOTE-'", $guard);
        $this->assertStringContainsString('public static function isPriceOnRequest', $guard);
        $this->assertStringContainsString("'unit_price' => \$isPriceOnRequest ? 'Price on request'", $cart);
        $this->assertStringContainsString("'total' => \$isPriceOnRequest ? 'Price on request'", $cart);
    }
}
