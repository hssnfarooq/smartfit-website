<?php

namespace Tests\Feature;

use Tests\TestCase;

class NumberedCardTypographyContractTest extends TestCase
{
    public function test_shared_numbered_card_typography_matches_the_card_heading(): void
    {
        $css = file_get_contents(public_path('assets/css/style.css'));

        $this->assertStringContainsString('.sf-numbered-card-heading > .sf-numbered-card-number', $css);
        $this->assertStringContainsString('.sf-numbered-card-heading > .sf-numbered-card-title', $css);
        $this->assertStringContainsString('font-size: inherit !important;', $css);
        $this->assertStringContainsString('font-weight: inherit !important;', $css);
        $this->assertStringContainsString('font-family: inherit !important;', $css);
    }

    public function test_home_fleet_repairs_and_servicing_numbered_cards_use_the_shared_style(): void
    {
        $source = file_get_contents(resource_path('views/frontend/index.blade.php'));

        $this->assertSame(22, substr_count($source, 'sf-numbered-card-heading'));
        $this->assertSame(22, substr_count($source, 'sf-numbered-card-number'));
        $this->assertSame(22, substr_count($source, 'sf-numbered-card-title'));

        foreach (['fm-wheader', 'rp-wheader', 'sv-wheader'] as $sectionClass) {
            $this->assertStringContainsString($sectionClass . ' sf-numbered-card-heading', $source);
        }
    }

    public function test_mot_numbered_cards_use_the_same_shared_style(): void
    {
        $source = file_get_contents(resource_path('views/livewire/components/mot/ispis-mota.blade.php'));

        $this->assertStringContainsString('<h3 class="sf-numbered-card-heading">', $source);
        $this->assertStringContainsString('class="num sf-numbered-card-number"', $source);
        $this->assertStringNotContainsString('class="num" style=', $source);
    }
}
