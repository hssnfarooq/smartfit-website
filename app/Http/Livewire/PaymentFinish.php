<?php

namespace App\Http\Livewire;

use App\Mail\FinishedAlertMail;
use App\Mail\FinishedMail;
use App\Models\ShopUser;
use App\Models\Vehicles;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;
use Lunar\Facades\CartSession;
use Lunar\Facades\Payments;
use Lunar\Facades\ShippingManifest;
use Lunar\Models\Cart;
use Lunar\Models\Customer;
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

            $this->zaveziUsera();

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

        try {
            $customerEmail = data_get(request()->session()->get(env('INFO_KUKI')), 'email');
            if ($customerEmail) {
                Mail::to($customerEmail)->send(new FinishedMail($order, $order->id));
            }
            Mail::to(env('MAIL_TO_DEFAULT'))->send(new FinishedAlertMail($order, $order->id));
        } catch (\Throwable $exception) {
            Log::error('Booking completed but confirmation email could not be sent.', [
                'order_id' => $order->id,
                'error' => $exception->getMessage(),
            ]);
        }

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

    private function adreseKemija()
    {
        $address = [
            'country_id' => 235, //'GB',//null,
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

    private function zaveziUsera()
    {

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
                'password' => '-',
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

        $customer->users()->syncWithoutDetaching([$user->id]);

        $this->cart->setCustomer($customer);
    }

    public function render()
    {
        return view('livewire.payment-finish');
    }
}
