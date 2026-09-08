<?php

namespace Tests\Feature;

use Tests\TestCase;

class MenuStructureContractTest extends TestCase
{
    private function source(string $path): string
    {
        $source = file_get_contents(base_path($path));
        $this->assertNotFalse($source, "Unable to read {$path}");

        return $source;
    }

    private function between(string $source, string $start, string $end): string
    {
        $startAt = strpos($source, $start);
        $this->assertNotFalse($startAt, "Missing start marker: {$start}");
        $endAt = strpos($source, $end, $startAt + strlen($start));
        $this->assertNotFalse($endAt, "Missing end marker: {$end}");

        return substr($source, $startAt, $endAt - $startAt);
    }

    /**
     * @param list<string> $expectedHeadings
     * @param list<array{0: string, 1: string|null}> $expectedItems
     */
    private function assertMenuBlock(string $block, array $expectedHeadings, array $expectedItems): void
    {
        preg_match_all('/<p class="fleet_col_title">(.*?)<\/p>/s', $block, $headingMatches);
        $headings = array_map(static fn (string $value): string => trim(strip_tags($value)), $headingMatches[1]);
        $this->assertSame($expectedHeadings, $headings);

        preg_match_all('/<li class="fleet_item">(.*?)<\/li>/s', $block, $itemMatches);
        $actualItems = array_map(static function (string $markup): array {
            preg_match('/<a\b[^>]*href="([^"]+)"/s', $markup, $linkMatch);

            return [
                html_entity_decode(trim(strip_tags($markup)), ENT_QUOTES | ENT_HTML5),
                $linkMatch[1] ?? null,
            ];
        }, $itemMatches[1]);

        $this->assertSame($expectedItems, $actualItems);
    }

    public function test_sheet_defined_header_items_keep_the_existing_mot_mega_menu(): void
    {
        $menu = $this->source('resources/views/components/menu.blade.php');

        $this->assertStringContainsString(
            '$isMegaMenu = $isFleet || $isServices || $isMot || $isTyres || $isRepairs;',
            $menu
        );
        $this->assertStringContainsString('@elseif ($isMot)', $menu);
        $this->assertStringContainsString('$isDropdown = $link->tree || $isMegaMenu;', $menu);
        $this->assertStringContainsString('@elseif ($link->tree)', $menu);
        $this->assertStringContainsString(
            '.mega_menu_three_columns {'.PHP_EOL.'        grid-template-columns: repeat(3, minmax(0, 1fr)) !important;',
            str_replace("\r\n", "\n", $menu)
        );

        foreach ([
            "if (\$isServices) \$url = '/car-servicing';",
            "if (\$isTyres) \$url = '/tyres';",
            "if (\$isFleet) \$url = '/fleet-and-contract-work';",
            "if (\$isRepairs) \$url = '/repairs';",
        ] as $canonicalLink) {
            $this->assertStringContainsString($canonicalLink, $menu);
        }
    }

    public function test_services_mega_menu_matches_the_sheet_exactly(): void
    {
        $menu = $this->source('resources/views/components/menu.blade.php');
        $block = $this->between($menu, '@elseif ($isServices)', '@elseif ($isMot)');

        $this->assertMenuBlock($block, [
            'Vehicle Servicing',
            'Maintenance',
            'Additional Services',
        ], [
            ['Interim Car Service', '/interim-car-service'],
            ['Full Car Service', '/full-car-service'],
            ['Major Car Service', '/major-car-service'],
            ['Electric Vehicle Servicing & Maintenance', '/electric-vehicle-servicing-and-maintenance'],
            ['Hybrid Vehicle Servicing', '/hybrid-vehicle-servicing'],
            ['Oil & Filter', '/oil-and-filter'],
            ['Free 25 Point Health Check', '/free-25-point-health-check'],
            ['Air Conditioning Service', '/air-conditioning-service'],
            ['Brake Fluid Change', '/brake-fluid-change'],
            ['Battery Check & Replacement', '/batteries'],
            ['Vehicle Diagnostics', '/vehicle-diagnostics'],
            ['Vehicle Recovery', '/vehicle-recovery'],
        ]);
        $this->assertStringContainsString('KEEP YOUR VEHICLE PERFORMING AT ITS BEST', $block);
        $this->assertStringContainsString('Routine servicing and maintenance for all makes and models', $block);
    }

    public function test_mot_mega_menu_remains_unchanged_until_the_sheet_is_finalized(): void
    {
        $menu = $this->source('resources/views/components/menu.blade.php');
        $block = $this->between($menu, '@elseif ($isMot)', '@elseif ($isTyres)');

        $this->assertMenuBlock($block, [
            'MOT',
            'MOT & Service',
            'Commercial Vehicles',
        ], [
            ['Book Your MOT', '/mot'],
            ['MOT Class 4', '/mot-class-4'],
            ['MOT Class 5', '/mot-class-5-kennings-auto-centre'],
            ['MOT Class 7', '/mot-class-7'],
            ['MOT Retest', '/mot-class-4'],
            ['MOT Preparation', '/mot-class-4'],
            ['When is My MOT Due', '/mot'],
            ['Combined MOT & Service', '/mot-class-4-oil-and-filter'],
            ['MOT Class 4 + Oil & Filter', '/mot-class-4-oil-and-filter'],
            ['MOT Class 4 + Interim Service', '/mot-class-4-interim-service'],
            ['MOT Class 4 + Full Service', '/mot-class-4-full-service'],
            ['MOT Class 4 + Major Service', '/mot-class-4-major-service'],
            ['MOT Class 5 - Smartfit Autos', '/mot-class-5-kennings-auto-centre'],
            ['MOT Class 7', '/mot-class-7'],
            ['Common MOT Failures', '/mot'],
            ['Pre MOT Checks', '/free-25-point-health-check'],
            ['MOT Test Advise', '/mot'],
            ['MOT Repair', '/repairs'],
        ]);
        $this->assertStringContainsString('MOT due?', $block);
        $this->assertStringContainsString('Fast and reliable MOT testing available', $block);
    }

    public function test_tyres_mega_menu_matches_the_sheet_exactly(): void
    {
        $menu = $this->source('resources/views/components/menu.blade.php');
        $block = $this->between($menu, '@elseif ($isTyres)', '@elseif ($isRepairs)');

        $this->assertMenuBlock($block, [
            'Tyre Services',
            'Wheel & Alignment',
            'Tyre Information',
        ], [
            ['Tyre Fitting', '/tyres-2'],
            ['Mobile Tyre Fitting', '/mobile-tyre-fitting'],
            ['Puncture Repairs (Coming Soon)', null],
            ['TPMS', '/tyre-pressure-monitoring-system'],
            ['Wheel Balancing (Coming Soon)', null],
            ['Tyre Rotation (Coming Soon)', null],
            ['Seasonal Tyre Charges (Coming Soon)', null],
            ['Wheel Alignment', '/wheel-alignment'],
            ['4 Wheel Laser Alignment', '/4-wheel-laser-alignment'],
            ['Alloy Wheel Refurbishment', '/alloy-wheel-refurbishment'],
            ['Tyre Pressure Advise (Coming Soon)', null],
            ['Tyre Safety Checks (Coming Soon)', null],
            ['Tyre Wear & Tread Depth (Coming Soon)', null],
            ['Tyre Maintenance Tips (Coming Soon)', null],
            ['Winter vs Summer Tyres (Coming Soon)', null],
        ]);
    }

    public function test_fleet_mega_menu_matches_the_sheet_exactly(): void
    {
        $menu = $this->source('resources/views/components/menu.blade.php');
        $block = $this->between($menu, '@if ($isFleet)', '@elseif ($isServices)');

        $this->assertMenuBlock($block, [
            'Fleet Services',
            'Business Support',
            'Commercial Vehicles',
        ], [
            ['Fleet Maintenance (Coming Soon)', null],
            ['Fleet Servicing (Coming Soon)', null],
            ['Fleet Repair (Coming Soon)', null],
            ['MOT Management (Coming Soon)', null],
            ['Contract Work (Coming Soon)', null],
            ['Priority Bookings (Coming Soon)', null],
            ['Van Servicing (Coming Soon)', null],
            ['Commercial Vehicle Repair (Coming Soon)', null],
            ['Vehicle Recovery (Coming Soon)', null],
            ['Vehicle Health Checks (Coming Soon)', null],
        ]);
        $this->assertStringContainsString('KEEP YOUR FLEET MOVING', $block);
        $this->assertStringContainsString('Reliable main tenancy and repair solutions for business and commercial vehicles', $block);
    }

    public function test_repairs_mega_menu_matches_the_sheet_exactly(): void
    {
        $menu = $this->source('resources/views/components/menu.blade.php');
        $block = $this->between($menu, '@elseif ($isRepairs)', '@elseif ($link->tree)');

        $this->assertMenuBlock($block, [
            'Engine & Mechanical',
            'Brakes',
            'Electrical & Diagnostics',
            'Exhaust & General Repairs',
        ], [
            ['Engine Repairs (Coming Soon)', null],
            ['Timing Belt Replacement (Coming Soon)', null],
            ['Clutch Repairs', '/clutches'],
            ['GearBox Repairs (Coming Soon)', null],
            ['Cooling System Repairs (Coming Soon)', null],
            ['Brake Repairs', '/brakes'],
            ['Suspension Repairs', '/shocks-and-suspension'],
            ['Shock Absorbers', '/shocks-and-suspension'],
            ['Steering Repair', '/steering'],
            ['Vehicle Diagnostics', '/vehicle-diagnostics'],
            ['Battery Replacement', '/batteries'],
            ['Starter Motor Repairs (Coming Soon)', null],
            ['Alternator Repairs (Coming Soon)', null],
            ['Electrical Fault Finding (Coming Soon)', null],
            ['Exhaust Repairs', '/exhausts'],
            ['General Vehicle Repairs (Coming Soon)', null],
        ]);
    }

    public function test_footer_links_match_the_sheet(): void
    {
        $footer = $this->source('resources/views/components/footer.blade.php');

        foreach ([
            '<li><a href="/about-us">ABOUT US</a></li>',
            '<li><a href="/mot">MOT</a></li>',
            '<li><a href="/repairs">REPAIRS</a></li>',
            '<li><a href="/car-servicing">SERVICES</a></li>',
            '<li><a href="/tyres">TYRE SHOP</a></li>',
            '<li><a href="/fleet-and-contract-work">FLEET</a></li>',
            '<li><a href="/contacts-kennings-auto-centre">CONTACT US</a></li>',
            '<li><a href="/mobile-tyre-fitting">MOBILE TYRE FITTING</a></li>',
            '<li><a href="/tyre-pressure-monitoring-system">TYRE PRESSURE MONITORING SYSTEM</a></li>',
            '<li><a href="/4-wheel-laser-alignment">4 WHEEL LASER ALIGNMENT</a></li>',
            '<li><a href="/wheel-alignment">WHEEL ALIGNMENT</a></li>',
            '<li><a href="/tyre-storage-facility">TYRE STORAGE FACILITY</a></li>',
            '<li><a href="/alloy-wheel-refurbishment">ALLOY WHEEL REFURBISHMENT</a></li>',
        ] as $link) {
            $this->assertStringContainsString($link, $footer);
        }
    }

    public function test_mega_menu_typography_uses_shared_sizes_for_equivalent_text(): void
    {
        $menu = str_replace("\r\n", "\n", $this->source('resources/views/components/menu.blade.php'));

        $this->assertStringContainsString('--mega-menu-title-size: 19px;', $menu);
        $this->assertStringContainsString('--mega-menu-item-size: 15px;', $menu);
        $this->assertStringContainsString('font-size: var(--mega-menu-title-size) !important;', $menu);
        $this->assertStringContainsString('font-size: var(--mega-menu-item-size) !important;', $menu);
        $this->assertStringContainsString("font-family: inherit !important;\n        font-size: inherit !important;", $menu);
        $this->assertStringContainsString("--mega-menu-title-size: 17px;\n            --mega-menu-item-size: 14px;", $menu);

        $this->assertStringNotContainsString('.tyres_mega_menu_inner .fleet_col_title,', $menu);
        $this->assertStringNotContainsString('.tyres_mega_menu_inner .fleet_item,', $menu);
        $this->assertStringNotContainsString('font-size: 14.5px !important;', $menu);
    }
}
