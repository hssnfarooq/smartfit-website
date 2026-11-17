<?php

namespace Tests\Feature;

use Tests\TestCase;

class MotServiceAreaContractTest extends TestCase
{
    private function partialSource(): string
    {
        return file_get_contents(resource_path('views/site/partials/service-area-map.blade.php'));
    }

    public function test_all_map_pages_use_the_shared_figma_service_area_component(): void
    {
        $frontend = file_get_contents(resource_path('views/frontend/index.blade.php'));
        $mot = file_get_contents(resource_path('views/livewire/components/mot/ispis-mota.blade.php'));

        $this->assertSame(3, substr_count($frontend, "@include('site.partials.service-area-map'"));
        $this->assertSame(1, substr_count($mot, "@include('site.partials.service-area-map'"));

        foreach ([
            'fleet-service-area',
            'repairs-service-area',
            'servicing-service-area',
        ] as $areaId) {
            $this->assertStringContainsString("'serviceAreaId' => '{$areaId}'", $frontend);
        }
        $this->assertStringContainsString("'serviceAreaId' => 'mot-service-area'", $mot);
    }

    public function test_shared_service_area_component_matches_the_figma_structure(): void
    {
        $source = $this->partialSource();

        foreach ([
            'sf-service-area__container',
            'sf-service-area__title',
            'sf-service-area__card',
            'sf-service-area__content',
            'sf-service-area__buttons',
            'sf-service-area__map',
        ] as $class) {
            $this->assertStringContainsString($class, $source);
        }

        $this->assertStringContainsString('grid-template-columns: repeat(2, minmax(0, 1fr));', $source);
        $this->assertStringContainsString('min-height: 536px;', $source);
        $this->assertStringContainsString('<div class="container sf-service-area__container">', $source);
        $this->assertStringContainsString('font-size: var(--sf-type-body) !important;', $source);
        $this->assertStringContainsString('font-size: 16px;', $source);
        $this->assertStringContainsString('min-height: 52px;', $source);
        $this->assertStringContainsString('padding: 10px 22px;', $source);
        $this->assertStringNotContainsString('font-size: clamp(1.25rem, 1.4vw, 1.625rem) !important;', $source);
        $this->assertStringContainsString('font-size: var(--sf-type-h2) !important;', $source);
        $this->assertStringNotContainsString('font-size: clamp(3rem, 4.25vw, 4.5rem) !important;', $source);
    }

    public function test_shared_service_area_controls_are_interactive_and_accessible(): void
    {
        $source = $this->partialSource();

        foreach (['Peterborough', 'Stamford', 'Whittlesey', 'Crowland', 'Bourne', 'Huntingdon', 'Oundle', 'Sawtry', 'Ramsey', 'St Ives'] as $area) {
            $this->assertStringContainsString("['{$area}'", $source);
        }
        $this->assertStringContainsString('aria-pressed=', $source);
        $this->assertStringContainsString("setAttribute('aria-pressed'", $source);
        $this->assertStringContainsString('fa-solid fa-location-dot', $source);
        $this->assertStringContainsString('font-size: 48px;', $source);
        $this->assertStringContainsString('iconSize: [44, 56]', $source);
        $this->assertStringContainsString('iconAnchor: [22, 56]', $source);
        $this->assertStringContainsString('tile.openstreetmap.org', $source);
        $this->assertStringNotContainsString('basemaps.cartocdn.com', $source);
        $this->assertStringContainsString('marker.setLatLng', $source);
        $this->assertStringContainsString('setView([locations[0].lat, locations[0].lng], 11)', $source);
    }

    public function test_shared_service_area_has_mobile_layout_rules(): void
    {
        $source = $this->partialSource();

        $this->assertStringContainsString('.sf-service-area__card { grid-template-columns: 1fr; }', $source);
        $this->assertStringContainsString('.sf-service-area__map-canvas { min-height: 320px; height: 320px; }', $source);
    }
}
