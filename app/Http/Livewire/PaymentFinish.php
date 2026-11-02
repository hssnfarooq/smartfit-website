<?php

namespace App\Http\Livewire;

use App\Support\BookingCheckoutDetails;
use App\Support\BookingConfirmationSender;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;
use Lunar\Facades\CartSession;
use Lunar\Facades\Payments;
use Lunar\Models\Cart;
use Lunar\Models\Order;
use Lunar\Stripe\Facades\StripeFacade;

class PaymentFinish extends Component
{
    use PerformsRedirects;

    /**
     * The instance of the order.
     *
     * @var Order
     */
    public ?Cart $cart;

    public Order $order;

    /**
     * The return URL on a successful transaction
     *
     * @var string
     */
    public $returnUrl;

    /**
     * The policy for handling payments.
     *
     * @var string
     */
    public $policy;

    /**
     * {@inheritDoc}
     */
    protected $listeners = [
        'cardDetailsSubmitted',
    ];

    protected $queryString = [
        'payment_intent',
        'payment_intent_client_secret',
    ];

    public $payment_intent = null;

    public $payment_intent_client_secret = null;

    public $paymentType = 'card'; //'cash-in-hand';

    public string $redirekt = '';

    public string $paymentStatus = 'processing';

    public string $paymentMessage = 'We are confirming your payment. Please do not close this page.';

    /**
     * {@inheritDoc}
     */
    public function mount()
    {

        if (! $this->cart = CartSession::current()) {
            $this->redirekt = '/'; //$this->redirect('/');

            return;
        }

        if (request()->input('cmd') === 'finish') {
            $payment = request()->session()->get('payment');

            if (! data_get($payment, 'success') || ! $this->cart->completedOrder) {
                $this->markPaymentFailed();

                return;
            }

            $this->zavrsiSve();

            return;
        }

        if (! $this->paymentIntentBelongsToCart()) {
            Log::warning('Rejected a Stripe return that did not match the active cart.', [
                'cart_id' => $this->cart->id,
                'payment_intent' => $this->payment_intent,
            ]);
            $this->markPaymentFailed();

            return;
        }

        try {
            $intent = StripeFacade::fetchIntent($this->payment_intent);

            if (! $this->paymentIntentMatchesCart($intent)) {
                Log::warning('Rejected a Stripe return whose payment details did not match the active cart.', [
                    'cart_id' => $this->cart->id,
                    'payment_intent' => $this->payment_intent,
                ]);
                $this->markPaymentFailed();

                return;
            }

            if ($intent->status === 'processing') {
                $this->paymentStatus = 'pending';
                $this->paymentMessage = 'Your payment is still processing. We will confirm your booking as soon as Stripe completes it.';

                return;
            }

            if (! in_array($intent->status, ['succeeded', 'requires_capture'], true)) {
                $this->markPaymentFailed();

                return;
            }

            BookingCheckoutDetails::prepare($this->cart);

            $payment = Payments::driver($this->paymentType)->cart($this->cart)->withData([
                'payment_intent_client_secret' => $this->payment_intent_client_secret,
                'payment_intent' => $this->payment_intent,
            ])->authorize();

            if (! $payment->success) {
                $this->markPaymentFailed();

                return;
            }

            request()->session()->put('payment', $payment);
            $this->paymentStatus = 'success';
            $this->paymentMessage = 'Payment confirmed. We are completing your booking.';
            $this->redirekt = '?cmd=finish';
        } catch (\Throwable $exception) {
            report($exception);
            $this->markPaymentFailed();
        }
    }

    private function paymentIntentBelongsToCart(): bool
    {
        $meta = (array) $this->cart->meta;
        $expectedIntent = (string) ($meta['payment_intent'] ?? '');
        $returnedIntent = (string) $this->payment_intent;
        $returnedSecret = (string) $this->payment_intent_client_secret;

        return $expectedIntent !== ''
            && $returnedIntent !== ''
            && hash_equals($expectedIntent, $returnedIntent)
            && str_starts_with($returnedSecret, $returnedIntent.'_secret_');
    }

    private function paymentIntentMatchesCart($intent): bool
    {
        if (! $intent) {
            return false;
        }

        return (int) $intent->amount === (int) $this->cart->total->value
            && strtolower((string) $intent->currency) === strtolower((string) $this->cart->currency->code)
            && hash_equals((string) $intent->client_secret, (string) $this->payment_intent_client_secret);
    }

    private function markPaymentFailed(): void
    {
        $this->paymentStatus = 'failed';
        $this->paymentMessage = 'Your payment was not completed. No booking has been confirmed. Please return to payment and try again.';
    }

    private function zavrsiSve()
    {
        $order = $this->cart->completedOrder;

        if (! $order) {
            $this->markPaymentFailed();

            return;
        }

        BookingConfirmationSender::send($order);

        request()->session()->put('order', $order);
        request()->session()->forget([
            env('AUTO_KUKI'),
            env('INFO_KUKI'),
            env('TERMIN_KUKI'),
            env('PAYMENT_KUKI'),
            'payment',
        ]);
        CartSession::forget();
        $this->redirekt = env('STRIPE_SUCCESS_URL');
    }

    public function render()
    {
        return view('livewire.payment-finish');
    }
}
