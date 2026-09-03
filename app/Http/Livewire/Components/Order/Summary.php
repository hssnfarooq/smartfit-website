<?php

namespace App\Http\Livewire\Components\Order;

use App\Models\ShopUser;
use App\Models\Vehicles;
use App\Support\CartPriceGuard;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Stripe\Facades\StripeFacade;
use Stripe\Stripe;
use Lunar\Models\Cart;
use Lunar\Models\Customer;

use function PHPUnit\Framework\isNull;

class Summary extends Component
{
    public $total, $subtotal, $tax, $ajmo = false;

    public $cart, $error;
    protected $disabled = ' disabled';
    protected $listeners = [
        'add-to-cart' => 'mount',
        'obrisanRed' => 'mount',
        'infoDodan' => 'mount',
        'terminDodan' => 'mount',
        'lokacijaDodana' => 'mount',
        'autoDodan' => 'mount',
    ];

    public function mount()
    {
        CartPriceGuard::pruneCurrentCartLinesWithoutCurrencyPrices();
        $this->cart = is_null(CartSession::current()) ? CartSession::manager() : CartSession::current();
        $this->total();

        if($this->sveGotovo() && (isset($this->cart->lines) && count($this->cart->lines) > 0))
            $this->disabled = '';
    }

    private function sveGotovo(){   
        $return = true; 
        $this->error = '';
        //lokacija
        if (!request()->session()->exists(env('LOKACIJA_KUKI'))){
            $return = false;
            $this->error .= '<div>- You have to select the location.</div>';
        }
            
        //auto
        if (!request()->session()->exists(env('AUTO_KUKI'))){
            $return = false;
            $this->error .= '<div>- Vehicle details are required.</div>';
        }
        //user info
        if (!request()->session()->exists(env('INFO_KUKI')) || request()->session()->get(env('INFO_KUKI'))['gdpr'] != 1)   {
            $return = false;
            $this->error .= '<div>- Please fill in your contact info and GDPR permissions.</div>';
        }
        //termin
        if (!request()->session()->exists(env('TERMIN_KUKI')))     {
            $return = false;
            $this->error .= '<div>- Please select prefered apointments</div>';
        }

            
        return $return;
    }

    public function total()
    {
        CartPriceGuard::pruneCurrentCartLinesWithoutCurrencyPrices();
        $this->total = CartSession::current() ? CartSession::current()->total->formatted() : ('£0.00');//
        $this->subtotal = CartSession::current() ? CartSession::current()->subTotal->formatted() : ('£0.00');//
        $this->tax = CartSession::current() ? CartSession::current()->taxTotal->formatted() : ('£0.00');//
    }

    public function paymentPage(){
  
        request()->session()->put(env('PAYMENT_KUKI'), []);
        return redirect()->to('/booking/payment');

    }

    public function render()
    {
        $this->ajmo = true;

        //CartSession::manager()->current();

        //echo 'GDPR: '.request()->session()->get(env('INFO_KUKI'))['gdpr'];
        //echo 'EEEEEEEE: '.$this->cart->id;
        //request()->session()->flush();//CartSession::forget();
        //CartSession::forget();
        return view('livewire.components.order.summary');
    }

    ////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////
    //ako je total 0 pa nejde na payment page //////////////////////////
    public function zavrsiBesplatnuNarudzbu(){
        $this->total();
        //die(CartSession::current()->total);
        if($this->total !== '£0.00')
            return;

        $this->zaveziUsera();//unutra je i adresa kemija jer nema adrese za dostavu a lunar ju treba
        
        $order = CartSession::current()->createOrder(
            allowMultipleOrders: false,
            orderIdToUpdate: null,
        );
        
        CartSession::forget();
                
        request()->session()->forget([env('AUTO_KUKI'), env('INFO_KUKI'), env('TERMIN_KUKI')]);
        
        request()->session()->put('order', $order);   

        return redirect()->to(env('STRIPE_SUCCESS_URL'));
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

        CartSession::current()->setBillingAddress($address);
        CartSession::current()->setShippingAddress($address);
        
       // $option = $this->shippingOptions->first(fn ($option) => $option->getIdentifier() == $this->chosenShipping);

       // $this->cart->setShippingOption($option);
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

        CartSession::current()->setCustomer($customer);
    }
    //////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
}
