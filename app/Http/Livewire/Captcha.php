<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Captcha extends Component
{

    public $plholder;

    public function render()
    {
        return view('livewire.captcha');
    }
}
