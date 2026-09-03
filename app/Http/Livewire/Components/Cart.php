<?php

namespace App\Http\Livewire\Components;

use A17\Twill\Models\User;
use App\Models\ShopUser;
use App\Support\CartPriceGuard;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Models\Customer;

class Cart extends Component
{
    /**
     * The editable cart lines.
     */
    public array $lines;

    public bool $linesVisible = false;

    public $test;

    protected $listeners = [
        'add-to-cart' => 'handleAddToCart',
        'remove-line' => 'removeLine',
    ];

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'lines.*.quantity' => 'required|numeric|min:1|max:10000',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function mount()
    {
        CartPriceGuard::pruneCurrentCartLinesWithoutCurrencyPrices();
        $this->mapLines();
    }

    /**
     * Get the current cart instance.
     *
     * @return \Lunar\Managers\CartManager
     */
    public function getCartProperty()
    {
        CartPriceGuard::pruneCurrentCartLinesWithoutCurrencyPrices();
        return CartSession::current();
    }

    /**
     * Return the cart lines from the cart.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCartLinesProperty()
    {
        return $this->cart->lines ?? collect();
    }

    /**
     * Update the cart lines.
     *
     * @return void
     */
    public function updateLines()
    {
        $this->validate();

        CartSession::updateLines(
            collect($this->lines)
        );
        $this->mapLines();
        $this->emit('cartUpdated');
    }

    public function removeLine($id, $product = 0)
    {
        CartSession::remove($id);
        $this->mapLines();
        $this->emit('obrisanRed', $product);
    }

    /**
     * Map the cart lines.
     *
     * We want to map out our cart lines like this so we can
     * add some validation rules and make them editable.
     *
     * @return void
     */
    public function mapLines()
    {
        CartPriceGuard::pruneCurrentCartLinesWithoutCurrencyPrices();

        $this->lines = $this->cartLines->map(function ($line) {
            return [
                'id' => $line->id,
                'identifier' => $line->purchasable->getIdentifier(),
                'quantity' => $line->quantity,
                'description' => $line->purchasable->getDescription(),
                'thumbnail' => '',//$line->purchasable->getThumbnail()->getUrl(),
                'option' => $line->purchasable->getOption(),
                'options' => $line->purchasable->getOptions()->implode(' / '),
                'sub_total' => $line->subTotal->formatted(),
                'unit_price' => $line->unitPrice->formatted(),
                'total' => $line->total->formatted(),
                'tax_amount' => $line->taxAmount->formatted(),
                'product_id' => $line->purchasable->id,
                'product_type_id' => $line->purchasable->getProductType(),
            ];
        })->toArray();
    }

    public function handleAddToCart($aa)
    {
        $this->test = $aa;
        $this->mapLines();
        $this->linesVisible = true;

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

        CartSession::current()->setBillingAddress($address);
        CartSession::current()->setShippingAddress($address);
        
       // $option = $this->shippingOptions->first(fn ($option) => $option->getIdentifier() == $this->chosenShipping);

       // $this->cart->setShippingOption($option);
    }

    public function render()
    {       
        return view('livewire.components.cart', ['test' => $this->test]);
    }
}
