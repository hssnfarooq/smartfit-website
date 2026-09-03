<?php

namespace App\Http\Livewire\Components\Filter;

use Livewire\Component;
use Lunar\Models\Product;

class NoisePerformance extends Component
{
    public $name;
    
    public function render()
    {
        // 'season', 'width', 'ratio', 'dia', 'manufacturer', 'rolling_res', 'wet_grip', 'noise_performance', 'load_spd'
        $polje = env('IMPORT_PARTNER') == 'stapletons' ? 'noise_performance' : 'noise_performance';
        $values = Product::select('t_import_json->'.$polje.' as vrijednost')
        ->groupBy('vrijednost')
        ->orderByRaw('CONVERT(vrijednost, SIGNED) asc')
        ->get();
        return view('livewire.components.filter.noise-performance', ['dd' => $values]);
    }
}
