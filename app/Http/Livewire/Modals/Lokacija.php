<?php

namespace App\Http\Livewire\Modals;

use App\Models\Location;
use Livewire\Component;

class Lokacija extends Component
{
    public $modal_title = 'Select Service Centre';
    public $zatvori = false;
    public $lokacija = 0;
    public $lokacija_data;
    
    public function selekt(){
        request()->session()->put(env('LOKACIJA_KUKI'), $this->lokacija_data);
        $this->emit('lokacijaDodana');
        $this->reset();
        $this->zatvori = true;
    }

    public function render()
    {
        $lokacije = Location::where('published', true)->get();
        $this->lokacija_data = $this->lokacija > 0 ? Location::findOrFail($this->lokacija) : [];
        return view('livewire.modals.lokacija', ['lokacije' => $lokacije, 'data' => $this->lokacija_data]);
    }
}
