<?php

namespace Tests\Feature;

use App\Support\SiteSeo;
use Illuminate\Http\Request;
use Tests\TestCase;

class SiteSeoContractTest extends TestCase
{
    public function test_primary_pages_have_unique_search_metadata(): void
    {
        $slugs = [
            'home-page',
            'mot',
            'repairs',
            'car-servicing',
            'tyres',
            'fleet-and-contract-work',
            'about-us',
            'contacts-kennings-auto-centre',
        ];
        $titles = [];
        $descriptions = [];

        foreach ($slugs as $slug) {
            $page = (object) ['slug' => $slug, 'title' => $slug, 'description' => ''];
            $seo = SiteSeo::resolve($page, request: Request::create('/'.$slug));

            $this->assertNotEmpty($seo['title']);
            $this->assertNotEmpty($seo['description']);
            $this->assertLessThanOrEqual(60, mb_strlen($seo['title']));
            $this->assertLessThanOrEqual(160, mb_strlen($seo['description']));
            $titles[] = $seo['title'];
            $descriptions[] = $seo['description'];
        }

        $this->assertCount(count($titles), array_unique($titles));
        $this->assertCount(count($descriptions), array_unique($descriptions));
    }

    public function test_canonical_is_self_referencing_and_drops_query_parameters(): void
    {
        $request = Request::create('https://www.smartfitautos.co.uk/mot?campaign=summer');
        $seo = SiteSeo::resolve(
            (object) ['slug' => 'mot', 'title' => 'MOT', 'description' => ''],
            request: $request,
        );

        $this->assertSame('https://www.smartfitautos.co.uk/mot', $seo['canonical']);
        $this->assertSame('en-GB', $seo['language']);
        $this->assertSame('en_GB', $seo['locale']);
    }

    public function test_unknown_cms_pages_receive_a_useful_fallback(): void
    {
        $page = (object) [
            'slug' => 'clutches',
            'title' => 'CLUTCHES',
            'description' => '',
        ];
        $seo = SiteSeo::resolve($page, request: Request::create('/clutches'));

        $this->assertSame('Clutches in Peterborough | Smartfit Autos', $seo['title']);
        $this->assertStringContainsString('Book Clutches in Peterborough', $seo['description']);
    }

    public function test_frontend_layout_uses_british_english_and_central_seo_partial(): void
    {
        $source = file_get_contents(resource_path('views/frontend/index.blade.php'));
        $partial = file_get_contents(resource_path('views/frontend/inc/seo.blade.php'));

        $this->assertStringContainsString('<html lang="en-GB"', $source);
        $this->assertStringContainsString("@include('frontend.inc.seo')", $source);
        $this->assertStringNotContainsString('SEO::generate()', $source);
        $this->assertStringContainsString('<link rel="canonical"', $partial);
        $this->assertStringContainsString('<meta name="description"', $partial);
        $this->assertSame('current', config('seotools.meta.defaults.canonical'));
    }
}
