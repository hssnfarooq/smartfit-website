<?php

namespace Tests\Feature;

use Tests\TestCase;

class AboutPageContractTest extends TestCase
{
    private function source(string $path): string
    {
        $source = file_get_contents(base_path($path));
        $this->assertNotFalse($source, "Unable to read {$path}");

        return $source;
    }

    public function test_homepage_and_about_page_share_the_same_manufacturer_source(): void
    {
        $manufacturers = require base_path('config/tyre_manufacturers.php');

        $this->assertSame([
            'Pirelli',
            'Bridgestone',
            'Hankook',
            'Uniroyal',
            'Continental',
            'Yokohama',
            'Goodyear',
            'Michelin',
            'Dunlop',
        ], array_column($manufacturers, 'name'));

        foreach (['resources/views/frontend/index.blade.php', 'resources/views/livewire/show-brands.blade.php'] as $template) {
            $this->assertStringContainsString("config('tyre_manufacturers', [])", $this->source($template));
        }

        $this->assertStringContainsString("? 'Tyres Manufacturers'", $this->source('resources/views/livewire/show-brands.blade.php'));
    }

    public function test_about_banner_uses_the_local_optimized_workshop_image(): void
    {
        $banner = $this->source('resources/views/site/blocks/page_head1.blade.php');
        $imagePath = public_path('assets/images/about/about-us-banner.webp');

        $this->assertStringContainsString("request()->is('about-us')", $banner);
        $this->assertStringContainsString("asset('assets/images/about/about-us-banner.webp')", $banner);
        $this->assertStringContainsString('page_banner--about', $banner);
        $this->assertFileExists($imagePath);
        $this->assertLessThan(200 * 1024, filesize($imagePath));

        [$width, $height] = getimagesize($imagePath);
        $this->assertSame(1920, $width);
        $this->assertSame(600, $height);
    }

    public function test_about_manufacturer_cards_have_one_shared_size(): void
    {
        $css = $this->source('public/assets/css/style.css');
        $cardRule = strstr($css, '.about_tyre_manufacturers .brand_logo_item {');

        $this->assertNotFalse($cardRule);
        $cardRule = strstr($cardRule, '}', true);
        $this->assertNotFalse($cardRule);
        $this->assertStringContainsString('width: 100%;', $cardRule);
        $this->assertStringContainsString('height: 105px !important;', $cardRule);
        $this->assertStringContainsString('min-height: 105px;', $cardRule);
    }
}
