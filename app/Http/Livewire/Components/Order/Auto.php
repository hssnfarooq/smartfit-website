<?php
namespace App\Http\Livewire\Components\Order;

use Livewire\Component;

class Auto extends Component
{
    protected $auto;

    protected $listeners = [
        'autoDodan' => 'render',
    ];


    public function render()
    {
       // var_dump(request()->session()->get(env('AUTO_KUKI')));
       // die();
        if (request()->session()->exists(env('AUTO_KUKI'))) 
            $this->auto = request()->session()->get(env('AUTO_KUKI'));
        else
            $this->auto = '';
        return view('livewire.components.order.auto');
    }
}
