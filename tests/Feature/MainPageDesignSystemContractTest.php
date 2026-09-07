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
            '/\.sf-main-page \.page_content \.sf-cta:focus-visible\s*\{[^}]*outline:\s*3px solid #343a40;[^}]*outline-offset:\s*3px;[^}]*box-shadow:\s*0 0 0 3px #fff;/s',
            $css
        );

        $this->assertGreaterThanOrEqual(3, $this->contrastRatio('#343a40', '#ffffff'));
        $this->assertGreaterThanOrEqual(3, $this->contrastRatio('#ffffff', '#181818'));
        $this->assertGreaterThanOrEqual(3, $this->contrastRatio('#ffffff', '#ed1e24'));
    }

    public function test_main_page_templates_use_the_shared_cta_classes(): void
    {
        $templates = [
            'resources/views/frontend/index.blade.php',
            'resources/views/livewire/components/home/auto-search.blade.php',
            'resources/views/livewire/components/mot/ispis-mota.blade.php',
            'resources/views/livewire/gume-katalog.blade.php',
        ];

        foreach ($templates as $template) {
            $this->assertStringContainsString('sf-cta', $this->source($template), $template);
        }

        $tyres = $this->source('resources/views/livewire/gume-katalog.blade.php');
        $this->assertMatchesRegularExpression(
            '/<button[^>]+type="submit"[^>]+sf-cta[^>]+sf-cta--primary/s',
            $tyres
        );
    }
}
