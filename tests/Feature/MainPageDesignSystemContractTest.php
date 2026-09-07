<?php

namespace Tests\Feature;

use Tests\TestCase;

class MainPageDesignSystemContractTest extends TestCase
{
    private function source(string $path): string
    {
        $source = file_get_contents(base_path($path));
        $this->assertNotFalse($source, "Unable to read {$path}");

        return $source;
    }

    /**
     * @return list<string>
     */
    private function openingTagsWithClass(string $source, string $class): array
    {
        preg_match_all('/<(?:a|button)\b[^>]*>/s', $source, $matches);

        return array_values(array_filter(
            $matches[0],
            static function (string $tag) use ($class): bool {
                if (! preg_match('/\bclass\s*=\s*"([^"]*)"/s', $tag, $classMatch)) {
                    return false;
                }

                return in_array($class, preg_split('/\s+/', trim($classMatch[1])) ?: [], true);
            }
        ));
    }

    /**
     * @return list<string>
     */
    private function classesFromOpeningTag(string $tag): array
    {
        $this->assertMatchesRegularExpression('/\bclass\s*=\s*"([^"]*)"/s', $tag);
        preg_match('/\bclass\s*=\s*"([^"]*)"/s', $tag, $matches);

        return preg_split('/\s+/', trim($matches[1])) ?: [];
    }

    private function relativeLuminance(string $hex): float
    {
        $rgb = array_map(
            static fn (int $offset): float => hexdec(substr($hex, $offset, 2)) / 255,
            [1, 3, 5]
        );

        $linear = array_map(
            static fn (float $channel): float => $channel <= 0.04045
                ? $channel / 12.92
                : (($channel + 0.055) / 1.055) ** 2.4,
            $rgb
        );

        return (0.2126 * $linear[0]) + (0.7152 * $linear[1]) + (0.0722 * $linear[2]);
    }

    private function contrastRatio(string $foreground, string $background): float
    {
        $lighter = max($this->relativeLuminance($foreground), $this->relativeLuminance($background));
        $darker = min($this->relativeLuminance($foreground), $this->relativeLuminance($background));

        return ($lighter + 0.05) / ($darker + 0.05);
    }

    public function test_frontend_layout_scopes_the_design_system_to_the_six_main_pages(): void
    {
        $view = $this->source('resources/views/frontend/index.blade.php');

        foreach ([
            "'home-page' => 'home'",
            "'home' => 'home'",
            "'mot' => 'mot'",
            "'mot-peterborough' => 'mot'",
            "'mots' => 'mot'",
            "'repairs' => 'repairs'",
            "'car-servicing' => 'services'",
            "'tyres' => 'tyres'",
            "'fleet-and-contract-work' => 'fleet'",
        ] as $mapping) {
            $this->assertStringContainsString($mapping, $view);
        }

        $this->assertStringContainsString("'sf-main-page' => \$sfPageKey !== null", $view);
        $this->assertStringContainsString('"sf-page-{$sfPageKey}" => $sfPageKey !== null', $view);
        $this->assertStringNotContainsString("'services' => 'services'", $view);
    }

    public function test_central_stylesheet_defines_the_approved_scoped_type_tokens(): void
    {
        $css = $this->source('public/assets/css/style.css');

        foreach ([
            '--sf-type-h1: clamp(2rem, 1.5rem + 2vw, 3rem)',
            '--sf-type-h2: clamp(1.75rem, 1.5rem + 1vw, 2.25rem)',
            '--sf-type-h3: clamp(1.25rem, 1.18rem + 0.3vw, 1.375rem)',
            '--sf-type-h4: 1.125rem',
            '--sf-type-body: 1rem',
            '--sf-type-supporting: 0.875rem',
            '--sf-type-label: 0.8125rem',
            '.sf-main-page .page_content h1',
            '.sf-main-page .page_content h2',
            '.sf-main-page .page_content h3',
        ] as $contract) {
            $this->assertStringContainsString($contract, $css);
        }
    }

    public function test_frontend_layout_does_not_mutate_typography_after_render(): void
    {
        $view = $this->source('resources/views/frontend/index.blade.php');

        $this->assertStringNotContainsString("querySelectorAll('h1')", $view);
        $this->assertStringNotContainsString("querySelectorAll('h2')", $view);
        $this->assertStringNotContainsString("querySelectorAll('h3')", $view);
        $this->assertStringNotContainsString("querySelectorAll('ul li')", $view);
    }

    public function test_excluded_pages_header_and_footer_keep_the_legacy_typography_via_scoped_css(): void
    {
        $css = $this->source('public/assets/css/style.css');
        $scope = ':where(body:not(.sf-main-page) .page_content, .site_header, .site_footer)';
        $strongScope = ':is(body:not(.sf-main-page) .page_content, .site_header, .site_footer)';

        foreach (['h1', 'h2', 'h4', 'h5', 'h6', 'p', '.fs-5'] as $target) {
            $this->assertStringContainsString("{$scope} {$target}", $css);
        }

        $this->assertStringContainsString("{$strongScope} h3", $css);
        $this->assertStringContainsString("{$strongScope} ul li", $css);
        $quotedStrongScope = preg_quote($strongScope, '/');
        $this->assertMatchesRegularExpression(
            "/{$quotedStrongScope} h3\\s*\\{[^}]*font-family:\\s*Mulish\\s*!important;[^}]*font-weight:\\s*800\\s*!important;[^}]*font-size:\\s*25px\\s*!important;[^}]*line-height:\\s*30\\.4px;[^}]*letter-spacing:\\s*-0\\.19px;[^}]*text-transform:\\s*uppercase;/s",
            $css
        );
        $quotedScope = preg_quote($strongScope, '/');
        $this->assertMatchesRegularExpression(
            "/{$quotedScope} ul li\\s*\\{[^}]*color:\\s*#444;[^}]*font-size:\\s*18px\\s*!important;[^}]*font-family:\\s*Mulish\\s*!important;/s",
            $css
        );
        $this->assertMatchesRegularExpression(
            "/".preg_quote($scope, '/')." h2\\s*\\{[^}]*letter-spacing:\\s*0\\s*!important;/s",
            $css
        );
        $this->assertStringNotContainsString("querySelectorAll('h3')", $this->source('resources/views/frontend/index.blade.php'));
    }

    public function test_homepage_heading_like_paragraphs_use_the_section_heading_token(): void
    {
        $view = $this->source('resources/views/frontend/index.blade.php');

        foreach ([
            'RELIABLE AUTOMOTIVE REPAIR AND MAINTENANCE YOU CAN COUNT ON',
            'GET IN TOUCH',
        ] as $copy) {
            $pattern = '/(<p\\b[^>]*class="[^"]*\\bsf-section-heading\\b[^"]*"[^>]*>)\\s*'.preg_quote($copy, '/').'\\s*<\\/p>/s';
            $this->assertMatchesRegularExpression($pattern, $view, $copy);
            preg_match($pattern, $view, $matches);
            $this->assertDoesNotMatchRegularExpression(
                '/(?:font-family|font-size|font-weight|line-height|letter-spacing)\\s*:/',
                $matches[1],
                $copy
            );
        }

        $this->assertSame(2, substr_count($view, 'sf-section-heading'));
        $this->assertStringContainsString(
            '.sf-main-page .page_content p.sf-section-heading',
            $this->source('public/assets/css/style.css')
        );
    }

    public function test_homepage_package_titles_close_at_the_same_heading_level(): void
    {
        $view = $this->source('resources/views/frontend/index.blade.php');

        $this->assertStringContainsString(
            "<h3 class=\"fw-bold text-dark mb-1\" style=\"font-family: Mulish;font-weight: 800 !important;line-height: 30.4px;letter-spacing: -0.19px;text-align: center;vertical-align: middle;text-transform: uppercase !important;\">\n                    {{ \$pkg['title'] }}\n                </h3>",
            $view
        );
    }

    public function test_label_rule_outspecifies_supporting_utility_classes(): void
    {
        $css = $this->source('public/assets/css/style.css');

        $this->assertStringContainsString('.sf-main-page .page_content label.small,', $css);
        $this->assertStringContainsString('.sf-main-page .page_content label.text-muted,', $css);
    }

    public function test_central_stylesheet_defines_shared_cta_geometry_and_variants(): void
    {
        $css = $this->source('public/assets/css/style.css');

        foreach ([
            '.sf-main-page .page_content .sf-cta',
            'min-height: 48px',
            'padding: 0 26px',
            'font-size: 13px',
            'font-weight: 800',
            'border: 2px solid transparent',
            'border-radius: 999px',
            'letter-spacing: 0.35px',
            '.sf-cta--primary',
            '.sf-cta--outline-light',
            '.sf-cta--outline-dark',
            '.sf-cta:focus-visible',
            '.sf-cta:disabled',
        ] as $contract) {
            $this->assertStringContainsString($contract, $css);
        }
    }

    public function test_cta_focus_indicator_has_contrast_on_light_and_dark_contexts(): void
    {
        $css = $this->source('public/assets/css/style.css');

        $this->assertMatchesRegularExpression(
            '/\.sf-main-page \.page_content \.sf-cta:focus-visible\s*\{[^}]*outline:\s*3px solid #343a40\s*!important;[^}]*outline-offset:\s*3px\s*!important;[^}]*box-shadow:\s*0 0 0 3px #fff\s*!important;/s',
            $css
        );

        $this->assertGreaterThanOrEqual(3, $this->contrastRatio('#343a40', '#ffffff'));
        $this->assertGreaterThanOrEqual(3, $this->contrastRatio('#ffffff', '#181818'));
        $this->assertGreaterThanOrEqual(3, $this->contrastRatio('#ffffff', '#ed1e24'));
    }

    public function test_fleet_and_services_leave_shared_cta_states_in_control(): void
    {
        $view = $this->source('resources/views/frontend/index.blade.php');
        $css = $this->source('public/assets/css/style.css');

        $this->assertDoesNotMatchRegularExpression(
            '/\\.(?:fm|sv)-btn(?:-[a-z]+)?:(?:hover|focus|focus-visible|active|disabled)\\s*\\{/',
            $view
        );
        $this->assertDoesNotMatchRegularExpression(
            '/\\.(?:fm|sv)-btn(?:-[a-z]+)?(?:\\s*,[^{}]+)*\\s*\\{[^}]*(?:box-shadow|transition)\\s*:/s',
            $view
        );

        foreach (['primary', 'outline-light', 'outline-dark'] as $variant) {
            $this->assertMatchesRegularExpression(
                '/\\.sf-main-page \\.page_content \\.sf-cta--'.preg_quote($variant, '/').':hover\\s*\\{[^}]*background(?:-color)?:\\s*[^;]+!important;[^}]*border-color:\\s*[^;]+!important;[^}]*color:\\s*[^;]+!important;/s',
                $css,
                $variant
            );
        }

        $this->assertMatchesRegularExpression(
            '/\\.sf-main-page \\.page_content \\.sf-cta:focus-visible\\s*\\{[^}]*box-shadow:\\s*0 0 0 3px #fff\\s*!important;/s',
            $css
        );
        $this->assertMatchesRegularExpression(
            '/@media \\(prefers-reduced-motion:\\s*reduce\\)\\s*\\{\\s*\\.sf-main-page \\.page_content \\.sf-cta\\s*\\{[^}]*transition:\\s*none\\s*!important;/s',
            $css
        );
    }

    public function test_shared_cta_owns_exact_letter_spacing_on_every_migrated_action(): void
    {
        $css = $this->source('public/assets/css/style.css');
        $this->assertMatchesRegularExpression(
            '/\\.sf-main-page \\.page_content \\.sf-cta\\s*\\{[^}]*letter-spacing:\\s*0\\.35px\\s*!important;/s',
            $css
        );

        foreach ([
            'resources/views/frontend/index.blade.php',
            'resources/views/livewire/components/home/auto-search.blade.php',
            'resources/views/livewire/components/mot/ispis-mota.blade.php',
            'resources/views/livewire/gume-katalog.blade.php',
        ] as $template) {
            foreach ($this->openingTagsWithClass($this->source($template), 'sf-cta') as $tag) {
                $this->assertDoesNotMatchRegularExpression('/letter-spacing\\s*:/', $tag, "{$template}: {$tag}");
            }
        }

        $legacyCss = $this->source('resources/views/frontend/index.blade.php')
            .$this->source('resources/views/livewire/components/mot/ispis-mota.blade.php');
        $this->assertDoesNotMatchRegularExpression(
            '/\\.(?:fm|sv)-btn(?:-[a-z]+)?(?:\\s*,[^{}]+)*\\s*\\{[^}]*letter-spacing\\s*:/s',
            $legacyCss
        );
        $this->assertDoesNotMatchRegularExpression(
            '/\\.mot-cta-btn-(?:red|outline)\\s*\\{[^}]*letter-spacing\\s*:/s',
            $legacyCss
        );
    }

    public function test_primary_stylesheet_request_uses_filemtime_without_a_duplicate_request(): void
    {
        $meta = $this->source('resources/views/frontend/inc/meta.blade.php');
        preg_match_all('/<link\\b[^>]*>/s', $meta, $matches);
        $styleRequests = array_values(array_filter(
            $matches[0],
            static fn (string $tag): bool => str_contains($tag, "asset('assets/css/style.css')")
        ));

        $this->assertCount(1, $styleRequests);
        $this->assertStringContainsString(
            "href=\"{{ asset('assets/css/style.css') }}?v={{ filemtime(public_path('assets/css/style.css')) }}\"",
            $styleRequests[0]
        );
    }

    public function test_main_page_templates_use_the_shared_cta_classes(): void
    {
        $templates = [
            'resources/views/frontend/index.blade.php' => 30,
            'resources/views/livewire/components/home/auto-search.blade.php' => 3,
            'resources/views/livewire/components/mot/ispis-mota.blade.php' => 10,
            'resources/views/livewire/gume-katalog.blade.php' => 1,
        ];

        foreach ($templates as $template => $expectedCount) {
            $tags = $this->openingTagsWithClass($this->source($template), 'sf-cta');
            $this->assertCount($expectedCount, $tags, $template);

            foreach ($tags as $tag) {
                $classes = $this->classesFromOpeningTag($tag);
                $variants = array_intersect($classes, [
                    'sf-cta--primary',
                    'sf-cta--outline-light',
                    'sf-cta--outline-dark',
                ]);
                $this->assertCount(1, $variants, "{$template}: {$tag}");
            }
        }

        $tyres = $this->source('resources/views/livewire/gume-katalog.blade.php');
        $this->assertMatchesRegularExpression(
            '/<button[^>]+type="submit"[^>]+sf-cta[^>]+sf-cta--primary/s',
            $tyres
        );
    }
}
