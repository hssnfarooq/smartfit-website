<?php

namespace Tests\Feature;

use App\Support\GarageCatalog;
use Tests\TestCase;

class HomeGarageFinderContractTest extends TestCase
{
    public function test_finder_renders_accessible_inputs_suggestions_status_and_booking_action(): void
    {
        $html = view('site.partials.home-garage-finder')->render();

        $this->assertStringContainsString('for="garage-registration"', $html);
        $this->assertStringContainsString('id="garage-registration"', $html);
        $this->assertStringContainsString('for="garage-postcode"', $html);
        $this->assertStringContainsString('id="garage-postcode"', $html);
        $this->assertStringContainsString('role="listbox"', $html);
        $this->assertStringContainsString('role="status"', $html);
        $this->assertStringContainsString(route('garage-finder.postcodes'), $html);
        $this->assertStringContainsString(route('garage-finder.nearest'), $html);
        $this->assertStringContainsString(route('garage-finder.select'), $html);
        $this->assertStringContainsString('BOOK THIS GARAGE', $html);
    }

    public function test_finder_inputs_override_the_light_global_theme_text_colour(): void
    {
        $html = view('site.partials.home-garage-finder')->render();

        $this->assertStringContainsString('color: #171717 !important;', $html);
        $this->assertStringContainsString('caret-color: #171717;', $html);
        $this->assertStringContainsString('.home-garage-finder .form-control::placeholder', $html);
        $this->assertStringContainsString('color: #68707c !important;', $html);
    }

    public function test_garage_cards_render_all_six_catalogue_locations_once(): void
    {
        $html = view('site.partials.home-garages')->render();

        $this->assertSame(6, substr_count($html, 'data-garage-card'));

        foreach (GarageCatalog::all() as $garage) {
            $this->assertSame(1, substr_count($html, e($garage['address'])));
        }
    }

    public function test_finder_renders_the_review_result_from_the_no_javascript_fallback(): void
    {
        session()->put('garage_finder_result', [
            'searched_postcode' => 'PE1 3SA',
            'registration' => 'AO23 LUW',
            'garage' => [
                'slug' => 'hiq-welland-road',
                'name' => 'HiQ Tyres & Autocare',
                'address' => '7 Welland Rd, Dogsthorpe, Peterborough, PE1 3SA',
                'distance_miles' => 0.0,
                'directions_url' => 'https://www.google.com/maps/dir/?api=1&destination=welland',
            ],
        ]);
        session()->flashInput([
            'postcode' => 'PE1 3SA',
            'registration' => 'AO23 LUW',
        ]);

        $html = view('site.partials.home-garage-finder')->render();

        $this->assertStringContainsString('value="AO23 LUW"', $html);
        $this->assertStringContainsString('value="PE1 3SA"', $html);
        $this->assertStringContainsString('id="garage-finder-result" class="home-garage-finder__result mt-4" aria-labelledby="garage-finder-result-name">', $html);
        $this->assertStringContainsString('HiQ Tyres &amp; Autocare', $html);
        $this->assertStringContainsString('Less than 1 mile from PE1 3SA', $html);
        $this->assertStringContainsString('value="hiq-welland-road"', $html);
    }

    public function test_homepage_uses_shared_finder_and_catalogue_partials_without_hardcoded_addresses(): void
    {
        $homepage = file_get_contents(resource_path('views/frontend/index.blade.php'));
        $cmsBlock = file_get_contents(resource_path('views/site/blocks/banner-2-boxa.blade.php'));

        $this->assertStringContainsString("@include('site.partials.home-garage-finder')", $homepage);
        $this->assertStringContainsString("@include('site.partials.home-garages')", $homepage);
        $this->assertStringContainsString("@include('site.partials.home-garage-finder')", $cmsBlock);

        foreach (GarageCatalog::all() as $garage) {
            $this->assertStringNotContainsString($garage['address'], $homepage);
        }
    }
}
