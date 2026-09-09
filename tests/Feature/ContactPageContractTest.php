<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContactPageContractTest extends TestCase
{
    private function source(string $path): string
    {
        $source = file_get_contents(base_path($path));
        $this->assertNotFalse($source, "Unable to read {$path}");

        return $source;
    }

    public function test_contact_banner_uses_contact_us_for_its_title_and_breadcrumb(): void
    {
        $banner = $this->source('resources/views/site/blocks/page_head1.blade.php');

        $this->assertStringContainsString("request()->is('contacts-kennings-auto-centre')", $banner);
        $this->assertStringContainsString("? 'CONTACT US'", $banner);
        $this->assertSame(2, substr_count($banner, '{{ $pageTitle }}'));
    }

    public function test_contact_details_use_the_approved_address_and_phone(): void
    {
        foreach ([
            'resources/views/site/blocks/kontakti1.blade.php',
            'resources/views/site/__blocks/kontakti1.blade.php',
        ] as $template) {
            $source = $this->source($template);

            $this->assertStringContainsString('7 Welland Rd, Dogsthorpe,<br>Peterborough, PE1 3SA', $source);
            $this->assertStringContainsString("str_replace('+44 1733 569998', '01733 569998'", $source);
            $this->assertStringContainsString('maps?q=7+Welland+Rd,+Dogsthorpe,+Peterborough,+PE1+3SA', $source);
        }
    }

    public function test_contact_form_has_one_contact_us_heading_without_the_outline_heading(): void
    {
        foreach ([
            'resources/views/site/blocks/kontakt_forma1.blade.php',
            'resources/views/site/__blocks/kontakt_forma1.blade.php',
        ] as $template) {
            $source = $this->source($template);
            $contactOverride = strstr($source, "@if (request()->is('contacts-kennings-auto-centre'))");
            $this->assertNotFalse($contactOverride);
            $contactOverride = strstr($contactOverride, '@else', true);
            $this->assertNotFalse($contactOverride);

            $this->assertStringContainsString('class="heading_text wow" data-splitting>CONTACT US</h3>', $contactOverride);
            $this->assertStringNotContainsString('outline_text', $contactOverride);
            $this->assertStringNotContainsString('REQUEST AN APPOINTMENT ONLINE', $contactOverride);
        }
    }
}
