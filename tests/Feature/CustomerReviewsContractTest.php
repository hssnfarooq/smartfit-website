<?php

namespace Tests\Feature;

use Tests\TestCase;

class CustomerReviewsContractTest extends TestCase
{
    private function source(string $path): string
    {
        $source = file_get_contents(base_path($path));
        $this->assertNotFalse($source, "Unable to read {$path}");

        return $source;
    }

    public function test_real_customer_reviews_are_centralized_and_preserved_verbatim(): void
    {
        $this->assertSame([
            ['name' => 'Vesel', 'review' => 'Great service reasonable prices, fast work, highly recommended.'],
            ['name' => 'Carl Cilenti', 'review' => 'Really brilliant service quick efficient and reasonable , Only had dealings with Daren who has always been really professional and helpful totally recommend these guys!'],
            ['name' => 'Natalie Smith', 'review' => "Would not to to anyone else no issue is to small or little and always do they're best to fit you in around yourself."],
            ['name' => 'Shakay Events', 'review' => 'Fantastic service, fair price. Customer service topnotch.'],
            ['name' => 'Tricia Duffy', 'review' => "Good service ,fair price ,nice staff. Inly place I would go .feel as a woman that I'm treated honestly and fairly."],
            ['name' => 'Ken Green', 'review' => 'Brilliant garage.. always does a great job. Very fair prices.'],
            ['name' => 'Aiga Sliksane', 'review' => 'Fast, friendly and professional! I recommend!'],
            ['name' => 'Shafiq Mohammed', 'review' => 'Very nice desserts especially Halva.'],
            ['name' => 'Jackie Nightingale', 'review' => 'Polite, reliable people with great pricing.'],
            ['name' => 'Everisto Sigauke', 'review' => 'Nice people and fix my car nicely.'],
            ['name' => 'Dj Silk', 'review' => 'Best service in town.'],
        ], require base_path('config/customer_reviews.php'));
    }

    public function test_every_hard_coded_review_surface_uses_the_shared_reviews(): void
    {
        $frontend = $this->source('resources/views/frontend/index.blade.php');
        $mot = $this->source('resources/views/livewire/components/mot/ispis-mota.blade.php');
        $cmsBlock = $this->source('resources/views/site/blocks/testimonials.blade.php');
        $slides = $this->source('resources/views/site/partials/customer-review-slides.blade.php');

        $this->assertSame(4, substr_count($frontend, '@include("site.partials.customer-review-slides")'));
        $this->assertSame(1, substr_count($mot, '@include("site.partials.customer-review-slides")'));
        $this->assertStringContainsString("config('customer_reviews', [])", $cmsBlock);
        $this->assertStringContainsString("config('customer_reviews', [])", $slides);

        foreach (['AMINATOU SMART', 'ABE THOMAS', 'ALEX GRIFFIN', 'DAVID MILLER', 'SARAH JENKINS'] as $dummyName) {
            $this->assertStringNotContainsString($dummyName, $frontend);
            $this->assertStringNotContainsString($dummyName, $mot);
            $this->assertStringNotContainsString($dummyName, $cmsBlock);
        }
    }

    public function test_review_navigation_is_visible_accessible_and_font_independent(): void
    {
        $frontend = $this->source('resources/views/frontend/index.blade.php');
        $mot = $this->source('resources/views/livewire/components/mot/ispis-mota.blade.php');
        $css = $this->source('public/assets/css/style.css');

        foreach ([$frontend, $mot] as $template) {
            $this->assertStringContainsString('aria-label="Previous reviews"', $template);
            $this->assertStringContainsString('aria-label="Next reviews"', $template);
            $this->assertStringContainsString('review-arrow-glyph text-dark', $template);
            $this->assertStringContainsString('review-arrow-glyph text-white', $template);
            $this->assertStringNotContainsString('fa-arrow-left text-dark small', $template);
            $this->assertStringNotContainsString('fa-arrow-right text-white small', $template);
        }

        foreach (['visibility: visible !important', 'opacity: 1 !important', 'font-family: Arial, sans-serif !important'] as $contract) {
            $this->assertStringContainsString($contract, $css);
        }
    }
}
