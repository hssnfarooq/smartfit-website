<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Lunar\Models\Brand;
use Lunar\Models\Product;

class HomeProducts extends Component
{
    public function getRandomProizvodiProperty()
    {        
       //return Product::inRandomOrder()->limit(8)->get();
        $brand = Brand::find(11);

        if (! $brand) {
            return collect();
        }

        return $brand->products()
            ->where('product_type_id', 1)
            ->where('status', 'published')
            ->whereNotNull('t_import_json')
            ->whereHas('defaultUrl')
            ->whereHas('variants')
            ->with(['defaultUrl', 'brand', 'variants.prices'])
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.home-products');
    }
}
