<?php

namespace Tests\Feature;

use Tests\TestCase;

class HeroFeatureTypographyContractTest extends TestCase
{
    public function test_primary_page_hero_features_share_one_central_style(): void
    {
        $css = file_get_contents(public_path('assets/css/style.css'));

        foreach ([
            '.sf-hero-features',
            '.sf-hero-feature',
            'font-size: 1rem !important;',
            'color: rgba(255, 255, 255, 0.58) !important;',
            'color: #ed1e24 !important;',
        ] as $rule) {
            $this->assertStringContainsString($rule, $css);
        }
    }

    public function test_fleet_repairs_and_services_use_the_shared_hero_feature_component(): void
    {
        $source = file_get_contents(resource_path('views/frontend/index.blade.php'));

        $this->assertSame(3, substr_count($source, 'sf-hero-features'));
        $this->assertSame(7, substr_count($source, 'sf-hero-feature"'));

        foreach (['fm-hero-feats', 'rp-hero-feats', 'sv-hero-feats'] as $pageClass) {
            $this->assertStringContainsString($pageClass . ' sf-hero-features', $source);
        }
    }

    public function test_mot_uses_the_same_shared_hero_feature_component(): void
    {
        $source = file_get_contents(resource_path('views/livewire/components/mot/ispis-mota.blade.php'));

        $this->assertStringContainsString('features sf-hero-features', $source);
        $this->assertSame(3, substr_count($source, 'class="sf-hero-feature"'));
        $this->assertStringNotContainsString('.mot-hero .features div {', $source);
    }

    public function test_repairs_hero_features_stay_on_one_desktop_row(): void
    {
        $css = file_get_contents(public_path('assets/css/style.css'));
        $source = file_get_contents(resource_path('views/frontend/index.blade.php'));

        $this->assertStringContainsString('.rp-hero-feats.sf-hero-features', $css);
        $this->assertStringContainsString('flex-wrap: nowrap;', $css);
        $this->assertStringContainsString('.rp-hero-feats .sf-hero-feature', $css);
        $this->assertStringContainsString('white-space: nowrap;', $css);
        $this->assertStringContainsString("<div class=\"col-lg-7\">\n<h1 class=\"fm-hero-title\">CAR REPAIR", $source);
        $this->assertStringContainsString("<div class=\"col-lg-5\">\n<div class=\"rp-diag-wrap\">", $source);
    }
}
