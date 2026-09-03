<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use Lunar\Facades\CartSession;

class Termin extends Component
{
    public $zatvori = false;
    public $modal_title = 'Select preferred appointments';
    public $date1, $date2;
    public $doba_dana1 = 'Morning', $doba_dana2 = 'Morning';

    protected $rules = [
        'date1' => 'required',
        'date2' => 'required',
    ];

    public function selekt(){
        $this->validate();

        $tmp[] = array($this->date1, $this->doba_dana1);
        $tmp[] = array($this->date2, $this->doba_dana2);


        request()->session()->put(env('TERMIN_KUKI'),  $tmp);
        
        CartSession::current()->update([
            'meta' => array('preferred_appointments' => ['date1' => "$this->date1, $this->doba_dana1", 'date2' => "$this->date2 $this->doba_dana2"]),
        ]);

        $this->emit('terminDodan');
        $this->reset();
        $this->zatvori = true;
    }

    public function render()
    {
        return view('livewire.modals.termin');
    }
}
