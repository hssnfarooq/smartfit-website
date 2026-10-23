<?php

namespace Tests\Feature;

use Tests\TestCase;

class RepairsEmergencySectionContractTest extends TestCase
{
    private function source(): string
    {
        return file_get_contents(resource_path('views/frontend/index.blade.php'));
    }

    public function test_emergency_repair_heading_has_a_visible_scoped_style(): void
    {
        $source = $this->source();

        $this->assertStringContainsString('<h2 class="rp-emg-title">EMERGENCY &amp; SAME<br>DAY CAR REPAIRS</h2>', $source);
        $this->assertStringContainsString('h2.rp-emg-title', $source);
        $this->assertStringContainsString('color:#fff!important', $source);
        $this->assertStringContainsString('font-size:clamp(3.25rem,3.75vw,4.5rem)!important', $source);
    }

    public function test_emergency_repair_section_matches_the_figma_layout_contract(): void
    {
        $source = $this->source();

        foreach ([
            'rp-emergency__container',
            'rp-emergency__grid',
            'rp-emg-desc',
            'rp-emg-list',
            'rp-emg-item',
            'rp-emg-icon',
            'rp-emg-item-title',
            'rp-emg-cta',
        ] as $class) {
            $this->assertStringContainsString($class, $source);
        }

        $this->assertStringContainsString('width:min(1780px,calc(100% - 144px))', $source);
        $this->assertStringContainsString('min-height:666px', $source);
        $this->assertStringContainsString('min-height:141px', $source);
        $this->assertStringContainsString('min-width:312px', $source);
    }

    public function test_emergency_repair_section_has_a_mobile_layout(): void
    {
        $source = $this->source();

        $this->assertStringContainsString('.rp-emergency__grid{grid-template-columns:1fr;gap:34px}', $source);
        $this->assertStringContainsString('.rp-emergency__container{width:calc(100% - 30px)}', $source);
        $this->assertStringContainsString('.rp-emergency .rp-emg-cta{width:100%;min-width:0;', $source);
        $this->assertStringContainsString('.rp-emg-item{min-height:96px;', $source);
    }

    public function test_local_repair_experts_section_does_not_show_a_booking_cta(): void
    {
        $this->assertStringNotContainsString('BOOK YOUR REPAIR TODAY', $this->source());
    }
}
