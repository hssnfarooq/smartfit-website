<?php

namespace Tests\Feature;

use Tests\TestCase;

class BookingServiceInformationIconContractTest extends TestCase
{
    public function test_every_toggle_option_renders_a_self_contained_information_button(): void
    {
        $html = view('components.servis-item-chkbox', [
            'servisId' => 501,
            'servisName' => 'Option without a description',
            'servisDescription' => '',
            'priceLabel' => null,
            'priceValue' => null,
            'grupa' => 5,
            'checked' => false,
        ])->render();

        $this->assertStringContainsString('booking-service-info', $html);
        $this->assertStringContainsString('data-bs-target="#exampleModal501"', $html);
        $this->assertStringContainsString('<span aria-hidden="true">i</span>', $html);
        $this->assertStringNotContainsString('fa-circle-exclamation', $html);
    }

    public function test_information_button_has_a_dependency_free_blue_circle_style(): void
    {
        $css = file_get_contents(public_path('assets/css/moj.css'));

        $this->assertStringContainsString('.booking-service-info', $css);
        $this->assertStringContainsString('background-color: #087ff5;', $css);
        $this->assertStringContainsString('color: #ffffff;', $css);
        $this->assertStringContainsString('border-radius: 50%;', $css);
        $this->assertStringContainsString('font-style: italic;', $css);
    }
}
