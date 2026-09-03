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

    public $paymentType = 'card';//'cash-in-hand';

    private $redirekt = '';
    /**
     * {@inheritDoc}
     */
    

     public function mount()
     {
         if (is_null(CartSession::current())){
             $this->redirekt = env('STRIPE_SUCCESS_URL');
             
             return;
         }
 
         if (! $this->cart = CartSession::current()) {
             $this->redirekt = '/booking/order';
 
             return;
         }
 
         //moja dopuna da se stvori odma i Payment instanca u lunaru
         if ($this->payment_intent) {
 
             //kemija za adrese jer su potrebne za lunarphp, pa punim s fake adresama -> po potrebi će se to mjenjati ako če trebati
            $this->adreseKemija();
 
             $payment = Payments::driver($this->paymentType)->cart($this->cart)->withData([
                 'payment_intent_client_secret' => $this->payment_intent_client_secret,
                 'payment_intent' => $this->payment_intent,
             ])->authorize();
             
             if ($payment->success) {
 
                 request()->session()->put('payment',  $payment);
                 
                 if (! $this->cart || ! $this->cart->completedOrder) {
                     $this->redirekt = '/';
         
                     return;
                 }
                 
                 $this->order = $this->cart->completedOrder;
                 
                 CartSession::forget();
                 
                 request()->session()->forget([env('AUTO_KUKI'), env('INFO_KUKI'), env('TERMIN_KUKI')]);
                 
                 $this->redirekt = env('STRIPE_SUCCESS_URL');
                 return;
             }
         }
 
         Stripe::setApiKey(config('services.stripe.key'));
         $this->policy = config('stripe.policy', 'capture');
         
     }


    public function checkout()
    {
        $payment = Payments::cart($this->cart)->withData([
            'payment_intent_client_secret' => $this->payment_intent_client_secret,
            'payment_intent' => $this->payment_intent,
        ])->authorize();

        if ($payment->success) {
            redirect()->route('checkout-success.view');

            return;
        }

        return redirect()->route('checkout-success.view');
    }

     /**
     * Return available shipping options.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getShippingOptionsProperty()
    {
        return ShippingManifest::getOptions(
            $this->cart
        );
    }

    private function adreseKemija(){
        $address = [
            'country_id' => 235,//'GB',//null,
            'title' => null,
            'first_name' => 'mmm',
            'last_name' => 'nnn',
            'company_name' => null,
            'line_one' => '-',
            'line_two' => null,
            'line_three' => null,
            'city' => '-',
            'state' => null,
            'postcode' => '-',
            'delivery_instructions' => null,
            'contact_email' => null,
            'contact_phone' => null,
            'meta' => null,
        ];

        $this->cart->setBillingAddress($address);
        $this->cart->setShippingAddress($address);
        
       // $option = $this->shippingOptions->first(fn ($option) => $option->getIdentifier() == $this->chosenShipping);

       // $this->cart->setShippingOption($option);
    }

    /**
     * Return the client secret for Payment Intent
     *
     * @return void
     */
    public function getClientSecretProperty($payment_intent = true)
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
