<?php

namespace App\Http\Livewire\Components\Filter;

use Livewire\Component;
use Lunar\Models\Product;

class RollingResistance extends Component
{
    public $name;
    
    public function render()
    {
        // 'season', 'width', 'ratio', 'dia', 'manufacturer', 'rolling_res', 'wet_grip', 'noise_performance', 'load_spd'
        $polje = env('IMPORT_PARTNER') == 'stapletons' ? 'rolling_res' : 'rolling_resistance';
        $values = Product::select('t_import_json->'.$polje.' as vrijednost')
        ->groupBy('vrijednost')
        ->orderByRaw('CONVERT(vrijednost, SIGNED) asc')
        ->get();
        return view('livewire.components.filter.rolling-resistance', ['dd' => $values]);
    }
}
