<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Lunar\Models\Cart;
use Lunar\Stripe\Facades\StripeFacade;
use Stripe\Stripe;
use Lunar\Facades\CartSession;
use Lunar\Facades\Payments;
use Lunar\Facades\ShippingManifest;
//use Lunar\Models\CartAddress;
use Lunar\Models\Order;

class PaymentPage extends Component
{

    /**
     * The instance of the order.
     *
     * @var Order
     */
    public ?Cart $cart;

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


    protected $redirekt = '';
    /**
     * {@inheritDoc}
     */
    public function mount()
    {
        if (!request()->session()->exists(env('PAYMENT_KUKI'))){
            $this->redirekt = '/booking/order';
            return;
        }
        
        $payment_respone = request()->session()->get(env('PAYMENT_KUKI'));
        if(isset($payment_respone->success)){
            $this->redirekt = '/booking/order';
        }

        if (! $this->cart = CartSession::current()) {
            $this->redirekt = '/booking/order';

            return;
        }
        
        Stripe::setApiKey(config('services.stripe.key'));
        $this->policy = config('stripe.policy', 'capture');

    }

    /**
     * Return the client secret for Payment Intent
     *
     * @return void
     */
    public function getClientSecretProperty()
    {
        $intent = StripeFacade::createIntent($this->cart);

        return $intent->client_secret;
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
