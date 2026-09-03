<?php
namespace App\Http\Livewire\Components;

use Livewire\Component;
use Lunar\Base\Purchasable;


class GetService extends Component
{

     /**
     * The purchasable model we want to add to the cart.
     *
     * @var Purchasable
     */
    public ?Purchasable $purchasable = null;

    /**
     * The quantity to add to cart.
     *
     * @var int
     */
    public $quantity = 1;

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            'quantity' => 'required|numeric|min:1|max:10000',
        ];
    }

    public function addToCart()
    {
        return redirect()->to('/booking/order');
       // $this->emit('add-to-cart');
    }

    public function qtyPlus()
    {
        $this->quantity++;
        //echo $this->quantity;
    }
    public function qtyMinus()
    {
        if($this->quantity > 1)
            $this->quantity--;
        //echo $this->quantity;
    }
    public function render()
    {
        return view('livewire.components.get-service');
    }
}
