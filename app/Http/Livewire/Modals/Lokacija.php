<?php

namespace App\Http\Livewire\Modals;

use App\Support\BookingLocation;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Lokacija extends Component
{
    public $modal_title = 'Select Service Centre';
    public $zatvori = false;
    public $lokacija = '';
    protected $lokacija_data;

    public function mount(BookingLocation $bookingLocation): void
    {
        $selected = session()->get(env('LOKACIJA_KUKI', 'lokacija'));
        $this->lokacija = (string) data_get($selected, 'slug', '');
        $this->lokacija_data = $this->lokacija !== '' ? $bookingLocation->find($this->lokacija) : null;
    }

    protected function rules(): array
    {
        return [
            'lokacija' => ['required', Rule::in(array_column(config('garages', []), 'slug'))],
        ];
    }

    public function selekt(){
        $this->validate();
        $this->lokacija_data = app(BookingLocation::class)->select($this->lokacija);
        $this->emit('lokacijaDodana');
        $this->zatvori = true;
        $this->dispatchBrowserEvent('booking-modal-saved', ['modalId' => 'lokacijaModal']);
    }

    public function render()
    {
        $bookingLocation = app(BookingLocation::class);
        $lokacije = $bookingLocation->all();
        $this->lokacija_data = $this->lokacija !== '' ? $bookingLocation->find($this->lokacija) : null;

        return view('livewire.modals.lokacija', ['lokacije' => $lokacije, 'data' => $this->lokacija_data]);
    }
}
