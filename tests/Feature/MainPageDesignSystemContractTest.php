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

    public function test_label_rule_outspecifies_supporting_utility_classes(): void
    {
        $css = $this->source('public/assets/css/style.css');

        $this->assertStringContainsString('.sf-main-page .page_content label.small,', $css);
        $this->assertStringContainsString('.sf-main-page .page_content label.text-muted,', $css);
    }
}
