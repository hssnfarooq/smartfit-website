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
}
