<?php

namespace App\Http\Livewire;

use App\Support\CartPriceGuard;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Facades\Payments;
use Lunar\Models\Cart;
use Lunar\Models\Order;
use Lunar\Stripe\Facades\StripeFacade;
//use Lunar\Models\CartAddress;
use Stripe\Stripe;

class PaymentPage extends Component
{
    /**
     * The instance of the order.
     *
     * @var Order
     */
    public ?Cart $cart = null;

    public array $orderLines = [];

    public string $subtotal = '';

    public string $tax = '';

    public string $total = '';

    public string $vehicleRegistration = '';

    public string $customerEmail = '';

    public string $clientSecret = '';

    public string $paymentSetupError = '';

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

    public string $redirekt = '';

    /**
     * {@inheritDoc}
     */
    public function mount()
    {
        if (! request()->session()->exists(env('PAYMENT_KUKI'))) {
            $this->redirekt = '/booking/order';

            return;
        }

        $paymentResponse = request()->session()->get(env('PAYMENT_KUKI'));
        if (data_get($paymentResponse, 'success')) {
            $this->redirekt = '/booking/order';
        }

        CartPriceGuard::pruneCurrentCartLinesWithoutCurrencyPrices();

        if (! $this->cart = CartSession::current()) {
            $this->redirekt = '/booking/order';

            return;
        }

        Stripe::setApiKey(config('services.stripe.key'));
        $this->policy = config('stripe.policy', 'capture');

        $this->orderLines = $this->cart->lines->map(function ($line) {
            return [
                'description' => $line->purchasable->getDescription(),
                'quantity' => $line->quantity,
                'total' => $line->total->formatted(),
            ];
        })->values()->toArray();

        $this->subtotal = $this->cart->subTotal->formatted();
        $this->tax = $this->cart->taxTotal->formatted();
        $this->total = $this->cart->total->formatted();
        $this->vehicleRegistration = (string) data_get(
            request()->session()->get(env('AUTO_KUKI')),
            'registration',
            ''
        );
        $this->customerEmail = (string) data_get(
            request()->session()->get(env('INFO_KUKI')),
            'email',
            ''
        );

        try {
            $this->clientSecret = (string) StripeFacade::createIntent($this->cart)->client_secret;
        } catch (\Throwable $exception) {
            report($exception);
            $this->paymentSetupError = 'We could not initialise the secure payment form. Please try again.';
        }
    }

    /**
     * Return the carts billing address.
     *
     * @return void
     */
    public function getBillingProperty()
    {
        return $this->cart->billingAddress;
    }

    public function render()
    {
        return view('livewire.payment-page');
    }
}
