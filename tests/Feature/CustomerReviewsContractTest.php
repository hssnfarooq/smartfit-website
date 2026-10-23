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
        $controls = $this->source('resources/views/site/partials/customer-review-controls.blade.php');
        $css = $this->source('public/assets/css/style.css');

        $this->assertSame(4, substr_count($frontend, '@include("site.partials.customer-review-controls")'));
        $this->assertSame(1, substr_count($mot, '@include("site.partials.customer-review-controls")'));
        $this->assertStringContainsString('aria-label="Previous reviews"', $controls);
        $this->assertStringContainsString('aria-label="Next reviews"', $controls);
        $this->assertStringContainsString('reviews-arrow-previous.svg', $controls);
        $this->assertStringContainsString('reviews-arrow-next.svg', $controls);
        $this->assertStringNotContainsString('review-arrow-glyph', $controls);

        foreach ([$frontend, $mot] as $template) {
            $this->assertStringNotContainsString('.reviews_arrow_right:hover', $template);
            $this->assertStringNotContainsString('.reviews_arrow_left:hover', $template);
        }

        foreach ([
            'gap: 21px;',
            'margin-top: 27px;',
            'width: 51px !important',
            'width: 43px !important',
            'box-shadow: none !important',
        ] as $contract) {
            $this->assertStringContainsString($contract, $css);
        }

        $this->assertFileExists(public_path('assets/images/icons/reviews-arrow-previous.svg'));
        $this->assertFileExists(public_path('assets/images/icons/reviews-arrow-next.svg'));
    }

    public function test_review_cards_follow_the_figma_divider_and_flat_card_treatment(): void
    {
        $slides = $this->source('resources/views/site/partials/customer-review-slides.blade.php');
        $css = $this->source('public/assets/css/style.css');

        $this->assertStringContainsString('customer-review-slide', $slides);
        $this->assertStringNotContainsString('shadow-sm', $slides);
        $this->assertStringContainsString('border-top: 1px solid #e5e5e5;', $css);
        $this->assertStringContainsString('font-size: 13px;', $css);
    }
}
