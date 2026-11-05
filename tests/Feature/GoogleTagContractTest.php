<?php

namespace Tests\Feature;

use Tests\TestCase;

class GoogleTagContractTest extends TestCase
{
    public function test_google_tag_is_centralized_and_loaded_immediately_after_head(): void
    {
        $partial = file_get_contents(resource_path('views/frontend/inc/google-tag.blade.php'));

        $this->assertStringContainsString('https://www.googletagmanager.com/gtm.js?id=GTM-THZJC4VQ', $partial);
        $this->assertStringContainsString('window.dataLayer = window.dataLayer || [];', $partial);
        $this->assertStringContainsString('function gtag(){dataLayer.push(arguments);}', $partial);
        $this->assertStringContainsString("gtag('js', new Date());", $partial);

        $legacyAnalytics = file_get_contents(resource_path('views/frontend/inc/kuki-konsent.blade.php'));
        $cookieConfig = file_get_contents(config_path('laravel-cookie-consent.php'));
        $this->assertStringNotContainsString('googletagmanager.com/gtag', $legacyAnalytics);
        $this->assertStringNotContainsString('GOOGLE_ANALYTICS_ID', $legacyAnalytics);
        $this->assertStringNotContainsString("'js_action' => 'loadGoogleAnalytics'", $cookieConfig);

        foreach ([
            'resources/views/frontend/index.blade.php',
            'resources/views/frontend/shop.blade.php',
            'resources/views/frontend/test.blade.php',
        ] as $layout) {
            $source = file_get_contents(base_path($layout));

            $this->assertMatchesRegularExpression(
                '/<head>\s*@include\([\'\"]frontend\.inc\.google-tag[\'\"]\)/',
                $source,
                "Google tag must be the first content after <head> in {$layout}"
            );
            $this->assertSame(1, substr_count($source, 'frontend.inc.google-tag'));
        }
    }
}
