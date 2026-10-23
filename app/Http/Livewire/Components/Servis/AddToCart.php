<?php

namespace App\Http\Livewire\Components\Servis;

use App\Support\CartPriceGuard;
use Livewire\Component;
use Lunar\Exceptions\MissingCurrencyPriceException;
use Lunar\Facades\CartSession;
use Lunar\Models\ProductVariant;

class AddToCart extends Component
{
    public int $purchasableId;
    public int $servisId;
    public string $servisName;
    public string $servisDescription = '';
    public ?string $priceLabel = null;
    public ?int $priceValue = null;
    public $quantity = 1;
    public $ispis = null;
    public $grupa;
    public $obrisan_proizvod = 0;
    public $checked = false;

    //ovo je za dodavanje van košarice -> pa da redirekta na booking
    public $redirekt = false;

    protected $listeners = [
        'obrisanRed',
    ];

    public function mount(
        int $purchasableId,
        int $servisId,
        string $servisName,
        string $servisDescription = '',
        ?string $priceLabel = null,
        ?int $priceValue = null
    ): void {
        $this->purchasableId = $purchasableId;
        $this->servisId = $servisId;
        $this->servisName = $servisName;
        $this->servisDescription = $servisDescription;
        $this->priceLabel = $priceLabel;
        $this->priceValue = $priceValue;
    }

    private function resolvePurchasable()
    {
        return ProductVariant::find($this->purchasableId);
    }
    
    public function obrisanRed($proizvod){
        $this->obrisan_proizvod = $proizvod;

        foreach(session()->all() as $key => $value){
            if(str_contains($key, 'grupa_')){
                if($proizvod == $value)
                    request()->session()->forget($key);
            }
        }
    }

    public function makniServis(){
        CartPriceGuard::pruneCurrentCartLinesWithoutCurrencyPrices();

        if (! $cart = CartSession::current()) {
            return;
        }

        foreach($cart->lines as $line)
            if($line->purchasable_id == $this->purchasableId){
                $this->emit('remove-line', $line->id, $this->purchasableId);
                break;
            }
    }

    //to je za ili ili opciju - radio btn
    public function makniStari(){
        $tmp = request()->session()->get('grupa_'.$this->grupa);
        CartPriceGuard::pruneCurrentCartLinesWithoutCurrencyPrices();

        if (! $cart = CartSession::current()) {
            request()->session()->put('grupa_'.$this->grupa, $this->purchasableId);
            return;
        }

        foreach($cart->lines as $line)
            if($line->purchasable_id == $tmp)
                CartSession::remove($line->id);//return $line->id;
        request()->session()->put('grupa_'.$this->grupa, $this->purchasable->id);
    }
    
    public function addToCart()
    {
        CartPriceGuard::pruneCurrentCartLinesWithoutCurrencyPrices();
        $purchasable = $this->resolvePurchasable();

        if (! CartPriceGuard::purchasableHasCurrencyPrice($purchasable)) {
            request()->session()->forget('grupa_'.$this->grupa);
            return;
        }

        if($this->ispis == 'radio')
            if (request()->session()->exists('grupa_'.$this->grupa)) {
                $this->makniStari();
            }else{
                request()->session()->put('grupa_'.$this->grupa, $this->purchasable->id);
            }

        try {
            CartSession::manager()->add($purchasable, $this->quantity);
        } catch (MissingCurrencyPriceException) {
            CartPriceGuard::pruneCurrentCartLinesWithoutCurrencyPrices();
            request()->session()->forget('grupa_'.$this->grupa);
            return;
        }

        //$this->emitTo('order.summary', 'test');
        if(!$this->redirekt)
            $this->emit('add-to-cart', $this->purchasableId);
        else
            redirect()->to('/booking/order');
    }

    private function chkBoxCheck(){
        CartPriceGuard::pruneCurrentCartLinesWithoutCurrencyPrices();

        if($cart = CartSession::current()){
            foreach($cart->lines as $line)
                if($line->purchasable_id == $this->purchasableId){
                    return true;
                }
            return false;
        }else return false;
    }

    public function render()
    {        
        if($this->ispis == 'radio')
            $this->checked = $this->purchasableId == request()->session()->get('grupa_'.$this->grupa) ? true : false;
        else
            $this->checked = $this->chkBoxCheck();
        
        return view('livewire.components.servis.add-to-cart');
    }
}
