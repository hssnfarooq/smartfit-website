<?php

namespace Tests\Feature;

use Tests\TestCase;

class PaymentCheckoutContractTest extends TestCase
{
    public function test_payment_page_uses_a_scoped_responsive_checkout_layout(): void
    {
        $view = file_get_contents(resource_path('views/livewire/payment-page.blade.php'));
        $css = file_get_contents(public_path('assets/css/checkout.css'));

        $this->assertStringContainsString('class="payment-layout"', $view);
        $this->assertStringContainsString('Order summary', $view);
        $this->assertStringContainsString('Pay {{ $total }}', $view);
        $this->assertStringContainsString('processed securely by Stripe', $view);
        $this->assertStringContainsString('<span>Klarna</span>', $view);
        $this->assertStringContainsString('<span>Revolut Pay</span>', $view);
        $this->assertStringContainsString('<span>Link</span>', $view);
        $this->assertStringContainsString('customer eligibility', $view);
        $this->assertStringContainsString("address: { country: 'GB' }", $view);
        $this->assertStringContainsString('.payment-form', $css);
        $this->assertStringContainsString('@media (max-width: 991px)', $css);
        $this->assertStringNotContainsString("\n  form {", $css);
        $this->assertStringNotContainsString("\n  button {", $css);
    }

    public function test_payment_return_has_visible_failure_state_and_cart_intent_validation(): void
    {
        $component = file_get_contents(app_path('Http/Livewire/PaymentFinish.php'));
        $view = file_get_contents(resource_path('views/livewire/payment-finish.blade.php'));

        $this->assertStringContainsString('paymentIntentBelongsToCart', $component);
        $this->assertStringContainsString('paymentIntentMatchesCart', $component);
        $this->assertStringContainsString('hash_equals($expectedIntent, $returnedIntent)', $component);
        $this->assertStringContainsString("str_starts_with(\$returnedSecret, \$returnedIntent.'_secret_')", $component);
        $this->assertStringContainsString('(int) $intent->amount === (int) $this->cart->total->value', $component);
        $this->assertStringContainsString('$this->cart->currency->code', $component);
        $this->assertStringContainsString("\$paymentStatus === 'failed'", $view);
        $this->assertStringContainsString('Payment Not Completed', $view);
        $this->assertStringContainsString('Return to payment', $view);
        $this->assertStringContainsString('Payment Processing', $view);
    }

    public function test_stripe_webhook_secret_uses_the_key_expected_by_lunar(): void
    {
        $services = file_get_contents(config_path('services.php'));

        $this->assertStringContainsString("'payment_intent' => env('LUNAR_STRIPE_WEBHOOK_SECRET')", $services);
    }
}
