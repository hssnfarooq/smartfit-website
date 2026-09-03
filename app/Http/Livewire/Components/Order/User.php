<?php

namespace App\Http\Livewire\Components\Order;

use Livewire\Component;

class User extends Component
{

    protected $listeners = [
        'infoDodan' => 'render'
    ];

    public function render()
    {
        if (request()->session()->exists(env('INFO_KUKI'))){
            $user_info = request()->session()->get(env('INFO_KUKI'));
        }else $user_info = [];

        return view('livewire.components.order.user', ['user_info' => $user_info]);
    }
}
