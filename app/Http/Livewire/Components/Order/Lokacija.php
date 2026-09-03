<?php

namespace App\Http\Livewire\Components\Order;

use Livewire\Component;

class Lokacija extends Component
{
    protected $lokacija;

    protected $listeners = [
        'lokacijaDodana' => 'render'
    ];

    public function render()
    {
        if (request()->session()->exists(env('LOKACIJA_KUKI'))) 
            $this->lokacija = request()->session()->get(env('LOKACIJA_KUKI'));
        else
            $this->lokacija = array();
        return view('livewire.components.order.lokacija');
    }
}
