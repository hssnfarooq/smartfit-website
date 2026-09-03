<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use Lunar\Facades\CartSession;
use Lunar\Models\ProductType;

class BookingStranica extends Component
{

    public $ispis = null;
    public $grupa;

    public function getServisiGrupeProperty()
    {
        return ProductType::where('id', '>', 1)->get();
    }

    public function dajServisGrupu($id)
    {
        return ProductType::find($id);
    }

    public function render()
    {
        //request()->session()->flush();
        return view('livewire.booking-stranica');
    }
}
