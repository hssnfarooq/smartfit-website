<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookingMotOptionsContractTest extends TestCase
{
    public function test_booking_mot_cards_have_the_required_content_and_three_row_structure(): void
    {
        $card = file_get_contents(resource_path('views/components/servis-item-radio.blade.php'));

        foreach ([
            'MOT Class 4',
            'Most cars, taxis, ambulances, motor caravans and small vans up to 3,000kg',
            "'price' => '£35'",
            'MOT Class 7',
            'Goods vehicles/vans over 3,000kg and up to 3,500kg',
            "'price' => '£55'",
            'card-header',
            'card-body',
            'card-footer',
        ] as $content) {
            $this->assertStringContainsString($content, $card);
        }
    }

    public function test_mot_cards_keep_the_existing_livewire_cart_selection(): void
    {
        $card = file_get_contents(resource_path('views/components/servis-item-radio.blade.php'));
        $item = file_get_contents(resource_path('views/livewire/components/servis/add-to-cart.blade.php'));

        $this->assertStringContainsString('wire:click="{{$checked ? \'makniServis\' : \'addToCart\'}}"', $card);
        $this->assertStringContainsString('col-md-4 booking-compact-option', $item);
        $this->assertStringContainsString('booking-mot-option', $item);
    }

    public function test_mot_card_styling_is_scoped_and_responsive(): void
    {
        $css = file_get_contents(public_path('assets/css/moj.css'));

        foreach (['.booking-compact-options', '.booking-compact-option', '.booking-compact-card', '@media (max-width: 767.98px)'] as $selector) {
            $this->assertStringContainsString($selector, $css);
        }

        $this->assertStringContainsString('font-size: 1rem;', $css);
        $this->assertStringContainsString('font-weight: 400;', $css);
        $this->assertMatchesRegularExpression('/\.booking-compact-card \.card-footer\s*\{[^}]*font-weight:\s*700;/s', $css);
        $this->assertStringContainsString('min-height: 68px;', $css);
        $this->assertStringContainsString('padding: 9px 14px;', $css);
    }

    public function test_migration_sets_the_checkout_prices_in_minor_units(): void
    {
        $migration = file_get_contents(database_path('migrations/2026_10_23_000001_update_booking_mot_options.php'));

        $this->assertStringContainsString("'price' => 3500", $migration);
        $this->assertStringContainsString("'price' => 5500", $migration);
        $this->assertStringContainsString("->where('priceable_type', 'Lunar\\\\Models\\\\ProductVariant')", $migration);
    }
}
