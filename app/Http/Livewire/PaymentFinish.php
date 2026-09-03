<?php

namespace App\Http\Livewire;

use App\Mail\FinishedAlertMail;
use App\Mail\FinishedMail;
use App\Models\ShopUser;
use App\Models\Vehicles;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;
use Lunar\Facades\CartSession;
use Lunar\Models\Cart;
use Lunar\Models\Order;
use Lunar\Facades\Payments;
use Lunar\Facades\ShippingManifest;
use Lunar\Models\Customer;

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

    public $paymentType = 'card';//'cash-in-hand';

    protected $redirekt = '';
    /**
     * {@inheritDoc}
     */

    public function mount()
    {

        if (! $this->cart = CartSession::current()) {
            $this->redirekt = '/';//$this->redirect('/');

            return;
        }

        if(request()->input('cmd') != null)
            if(request()->input('cmd') == 'finish'){
                $this->zavrsiSve();
                return;
            }
       

        $this->zaveziUsera();
        
        //moja dopuna da se stvori odma i Payment instanca u lunaru
        if ($this->payment_intent) {
 
            //kemija za adrese jer su potrebne za lunarphp, pa punim s fake adresama -> po potrebi će se to mjenjati ako če trebati
           

            $payment = Payments::driver($this->paymentType)->cart($this->cart)->withData([
                'payment_intent_client_secret' => $this->payment_intent_client_secret,
                'payment_intent' => $this->payment_intent,
            ])->authorize();
            
            
            if ($payment->success) {

                //$this->adreseKemija();

                request()->session()->put('payment',  $payment);     

                
                /*if (! $this->cart || ! $this->cart->completedOrder) {
                    $this->redirekt = '/';//$this->redirect('/');
        
                    return;
                }*/                
                
                $this->redirekt = '?cmd=finish';//$this->redirect(env('STRIPE_SUCCESS_URL'));

                return;
            }
        }

    }

    private function zavrsiSve(){
        $order = $this->cart->completedOrder;

        Mail::to(collect(request()->session()->get(env('INFO_KUKI')))['email'])->send(new FinishedMail($order, $order->id));
        Mail::to(env('MAIL_TO_DEFAULT'))->send(new FinishedAlertMail($order, $order->id));//obavijest da je neko kupio
/*
        request()->session()->forget([env('TERMIN_KUKI')]);//env('AUTO_KUKI'), env('INFO_KUKI'), 
        CartSession::forget();
*/
        request()->session()->flush();  
        $this->redirekt = env('STRIPE_SUCCESS_URL');
                
    }

    private function adreseKemija(){
        $address = [
            'country_id' => 235,//'GB',//null,
            'title' => null,
            'first_name' => request()->session()->get(env('INFO_KUKI'))['name'],
            'last_name' => request()->session()->get(env('INFO_KUKI'))['last_name'],
            'company_name' => null,
            'line_one' => '-',
            'line_two' => null,
            'line_three' => null,
            'city' => '-',
            'state' => null,
            'postcode' => '-',
            'delivery_instructions' => null,
            'contact_email' => request()->session()->get(env('INFO_KUKI'))['email'],
            'contact_phone' => request()->session()->get(env('INFO_KUKI'))['telephone'],
            'meta' => null,
        ];

        $this->cart->setBillingAddress($address);
        $this->cart->setShippingAddress($address);
        
       // $option = $this->shippingOptions->first(fn ($option) => $option->getIdentifier() == $this->chosenShipping);
        //$this->cart->setShippingOption($option);
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


    private function zaveziUsera(){

        $this->adreseKemija();

        $vehicle = Vehicles::firstOrCreate(
            ['registration' => request()->session()->get(env('AUTO_KUKI'))->registration],
            [
                'registration' => request()->session()->get(env('AUTO_KUKI'))->registration,
                'meta' => json_encode([
                    'account_no' => request()->session()->get(env('AUTO_KUKI'))->registration,
                    'registration' => request()->session()->get(env('AUTO_KUKI'))->registration,
                    'model' => request()->session()->get(env('AUTO_KUKI'))->model,
                    'make' => request()->session()->get(env('AUTO_KUKI'))->make,
                    'registration_date' => request()->session()->get(env('AUTO_KUKI'))->registrationDate,
                    'fuel_type' => request()->session()->get(env('AUTO_KUKI'))->fuelType,
                    'mot_due_date' => isset(request()->session()->get(env('AUTO_KUKI'))->motTests) ? request()->session()->get(env('AUTO_KUKI'))->motTests[0]->expiryDate : request()->session()->get(env('AUTO_KUKI'))->motTestDueDate,
                ]),
            ]
        );
        $user = ShopUser::firstOrCreate(
            ['email' => collect(request()->session()->get(env('INFO_KUKI')))['email']],
            [
                'name' => request()->session()->get(env('INFO_KUKI'))['name'],
                'email' => request()->session()->get(env('INFO_KUKI'))['email'],
                'password' => '-'
            ]
        );
        $customer = Customer::firstOrCreate(
            //['account_ref' => request()->session()->get(env('AUTO_KUKI'))->registration],
            [
                'title' => request()->session()->get(env('INFO_KUKI'))['title'],
                'first_name' => request()->session()->get(env('INFO_KUKI'))['name'],
                'last_name' => request()->session()->get(env('INFO_KUKI'))['last_name'],
                'company_name' => '',
                'vat_no' => '',
                'account_ref' => request()->session()->get(env('AUTO_KUKI'))->registration,
                'meta' => [
                    'future_communications' => request()->session()->get(env('INFO_KUKI'))['futureCommunications'],
                    'vehicle_id' => $vehicle->id,
                    'account_no' => request()->session()->get(env('AUTO_KUKI'))->registration,
                    'registration' => request()->session()->get(env('AUTO_KUKI'))->registration,
                    'model' => request()->session()->get(env('AUTO_KUKI'))->model,
                    'make' => request()->session()->get(env('AUTO_KUKI'))->make,
                    'registration_date' => request()->session()->get(env('AUTO_KUKI'))->registrationDate,
                    'fuel_type' => request()->session()->get(env('AUTO_KUKI'))->fuelType,
                    'mot_due_date' => isset(request()->session()->get(env('AUTO_KUKI'))->motTests) ? request()->session()->get(env('AUTO_KUKI'))->motTests[0]->expiryDate : request()->session()->get(env('AUTO_KUKI'))->motTestDueDate,
                ],
            ],
            [
                'title' => request()->session()->get(env('INFO_KUKI'))['title'],
                'first_name' => request()->session()->get(env('INFO_KUKI'))['name'],
                'last_name' => request()->session()->get(env('INFO_KUKI'))['last_name'],
                'company_name' => '',
                'vat_no' => '',
                'account_ref' => request()->session()->get(env('AUTO_KUKI'))->registration,
                'meta' => [
                    'future_communications' => request()->session()->get(env('INFO_KUKI'))['futureCommunications'],
                    'vehicle_id' => $vehicle->id,
                    'account_no' => request()->session()->get(env('AUTO_KUKI'))->registration,
                    'registration' => request()->session()->get(env('AUTO_KUKI'))->registration,
                    'model' => request()->session()->get(env('AUTO_KUKI'))->model,
                    'make' => request()->session()->get(env('AUTO_KUKI'))->make,
                    'registration_date' => request()->session()->get(env('AUTO_KUKI'))->registrationDate,
                    'fuel_type' => request()->session()->get(env('AUTO_KUKI'))->fuelType,
                    'mot_due_date' => isset(request()->session()->get(env('AUTO_KUKI'))->motTests) ? request()->session()->get(env('AUTO_KUKI'))->motTests[0]->expiryDate : request()->session()->get(env('AUTO_KUKI'))->motTestDueDate,
                ],
            ]
        );


        $customer->users()->attach($user);

        $this->cart->setCustomer($customer);
    }

    public function render()
    {
        return view('livewire.payment-finish');
    }
}
