<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReadyWhenYouAreContractTest extends TestCase
{
    public function test_all_four_main_pages_use_the_shared_ready_cta(): void
    {
        $mainPages = file_get_contents(resource_path('views/frontend/index.blade.php'));
        $mot = file_get_contents(resource_path('views/livewire/components/mot/ispis-mota.blade.php'));

        $this->assertSame(3, substr_count($mainPages, "@include('site.partials.ready-when-you-are'"));
        $this->assertSame(1, substr_count($mot, "@include('site.partials.ready-when-you-are'"));
    }

    public function test_shared_ready_cta_has_the_required_copy_and_actions(): void
    {
        $partial = file_get_contents(resource_path('views/site/partials/ready-when-you-are.blade.php'));

        $this->assertStringContainsString('Ready When You Are', $partial);
        $this->assertStringContainsString('Speak to the Peterborough team directly', $partial);
        $this->assertStringContainsString('tel:01733569998', $partial);
        $this->assertStringContainsString('sf-cta--outline-dark', $partial);
        $this->assertStringContainsString('sf-cta--primary', $partial);
    }

    public function test_ready_cta_styling_is_centralized(): void
    {
        $css = file_get_contents(public_path('assets/css/style.css'));

        foreach ([
            '.sf-ready-cta',
            '.sf-ready-cta__message',
            '.sf-ready-cta__icon',
            '.sf-ready-cta__title',
            '.sf-ready-cta__subtitle',
            '.sf-ready-cta__actions',
        ] as $selector) {
            $this->assertStringContainsString($selector, $css);
        }
    }
}
