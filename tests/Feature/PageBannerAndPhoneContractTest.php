<?php

namespace Tests\Feature;

use App\Support\PhoneNumber;
use Tests\TestCase;

class PageBannerAndPhoneContractTest extends TestCase
{
    private function source(string $path): string
    {
        $source = file_get_contents(base_path($path));
        $this->assertNotFalse($source, "Unable to read {$path}");

        return $source;
    }

    public function test_primary_phone_number_variants_are_normalized_in_rendered_html(): void
    {
        foreach ([
            '1733 569998',
            '01733569998',
            '01733-569-998',
            '+44 1733 569998',
            '+44 (0)1733 569998',
        ] as $variant) {
            $this->assertSame(
                '<p>Call '.PhoneNumber::DISPLAY.'</p>',
                PhoneNumber::normalizeHtml("<p>Call {$variant}</p>")
            );
        }

        foreach ([
            'tel:1733569998',
            'tel: 1733569998',
            'tel:01733 569998',
            'tel:+44 1733 569998',
        ] as $variant) {
            $this->assertSame(
                '<a href="'.PhoneNumber::HREF.'">Call</a>',
                PhoneNumber::normalizeHtml("<a href=\"{$variant}\">Call</a>")
            );
        }
    }

    public function test_all_generic_cms_pages_use_the_shared_phone_normalizer(): void
    {
        $frontend = $this->source('resources/views/frontend/index.blade.php');

        $this->assertStringContainsString(
            '{!! \\App\\Support\\PhoneNumber::normalizeHtml($item->renderBlocks()) !!}',
            $frontend
        );
    }

    public function test_shared_page_banner_uses_the_readable_gradient_and_text_colours(): void
    {
        $css = $this->source('public/assets/css/style.css');

        $this->assertStringContainsString('.page_banner::before {', $css);
        $this->assertStringContainsString('background: linear-gradient(90deg, rgba(255, 255, 255, 0.92)', $css);
        $this->assertStringContainsString('.page_banner > .container {', $css);
        $this->assertStringContainsString('z-index: 1;', $css);
        $this->assertStringContainsString('.page_banner .page_title,', $css);
        $this->assertStringContainsString('.page_banner .breadcrumb_nav > li,', $css);
        $this->assertStringContainsString('color: #171717 !important;', $css);
    }
}
