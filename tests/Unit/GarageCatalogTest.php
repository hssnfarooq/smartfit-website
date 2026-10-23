<?php

namespace Tests\Unit;

use App\Support\GarageCatalog;
use Tests\TestCase;

class GarageCatalogTest extends TestCase
{
    public function test_it_contains_the_six_homepage_garages_with_unique_slugs(): void
    {
        $garages = GarageCatalog::all();

        $this->assertCount(6, $garages);
        $this->assertSame(
            ['PE1 3QQ', 'PE1 2PF', 'PE1 4RA', 'PE1 3SA', 'PE1 2AS', 'PE29 3RJ'],
            array_column($garages, 'postcode')
        );
        $this->assertCount(6, array_unique(array_column($garages, 'slug')));
    }

    public function test_find_returns_a_known_garage_and_rejects_an_unknown_slug(): void
    {
        $garage = GarageCatalog::find('hiq-welland-road');

        $this->assertSame('7 Welland Rd, Dogsthorpe, Peterborough, PE1 3SA', $garage['address']);
        $this->assertNull(GarageCatalog::find('forged-garage'));
    }

    public function test_nearest_selects_welland_road_for_its_postcode_coordinates(): void
    {
        $garage = GarageCatalog::nearest(52.596556, -0.240931);

        $this->assertSame('hiq-welland-road', $garage['slug']);
        $this->assertSame(0.0, $garage['distance_miles']);
    }

    public function test_nearest_selects_huntingdon_for_its_postcode_coordinates(): void
    {
        $garage = GarageCatalog::nearest(52.331686, -0.178818);

        $this->assertSame('hiq-huntingdon', $garage['slug']);
        $this->assertSame(0.0, $garage['distance_miles']);
    }
}
