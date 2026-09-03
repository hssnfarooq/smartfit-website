<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Lunar\Models\Collection;
use Lunar\Models\Url;
use Lunar\Models\Brand;

class ShowBrands extends Component
{
    public $sectionTitle;

    public function getBrandsProperty()
    {
        return /*Brand::all()*/Brand::whereIn('id', [1, 4, 5, 6, 8, 10, 11, 14, 19, 26])->get();
    }

    public function render()
    {
        return view('livewire.show-brands');
    }
}
