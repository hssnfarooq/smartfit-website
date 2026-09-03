<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProizvodBoxIkone extends Component
{
    public $tjson;

    /**
     * Create a new component instance.
     */
    public function __construct($json = null, $view = null)
    {
        $this->tjson = $json;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.proizvod-box-ikone');
    }
}
