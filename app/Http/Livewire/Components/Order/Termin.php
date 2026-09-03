<?php

namespace App\Http\Livewire\Components\Order;

use Livewire\Component;

class Termin extends Component
{
    protected $termin;

    protected $listeners = [
        'terminDodan' => 'render',
    ];

    public function render()
    {
        if (request()->session()->exists(env('TERMIN_KUKI'))) 
            $this->termin = request()->session()->get(env('TERMIN_KUKI'));
        else
            $this->termin = array();
        return view('livewire.components.order.termin');
    }
}
