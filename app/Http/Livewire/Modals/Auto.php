<?php

namespace App\Http\Livewire\Modals;

use App\Helpers\Dvsa;
use Livewire\Component;

class Auto extends Component
{
    public $registration;

    public $modal_title = 'Add Vehicled';

    protected $auto_json = [];

    public $zatvori = false;

    protected $rules = [
        'registration' => 'required',
    ];

    public function mount(): void
    {
        $registration = request()->query('registration');

        if (! is_string($registration)) {
            return;
        }

        $registration = strtoupper(preg_replace('/\s+/', ' ', trim($registration)) ?? '');

        if (preg_match('/^[A-Z0-9 ]{2,10}$/', $registration) === 1) {
            $this->registration = $registration;
        }
    }

    public function searchReg()
    {
        $this->validate();
        $dvsa = new Dvsa();
        $this->auto_json = json_decode($dvsa->dohvatiAutoPodatke($this->registration));
        request()->session()->put(env('AUTO_KUKI').'_tmp', $this->auto_json);
        //die($dvsa->dohvatiAutoPodatke($this->registracija));
    }

    public function selekt()
    {
        request()->session()->put(env('AUTO_KUKI'), request()->session()->pull(env('AUTO_KUKI').'_tmp'));
        $this->emit('autoDodan');
        $this->reset();
        $this->zatvori = true;
    }

    public function render()
    {
        if (request()->session()->exists(env('AUTO_KUKI'))) {
            $this->modal_title = 'Change Vehicle';
        }

        return view('livewire.modals.auto');
    }
}
