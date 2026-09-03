<?php

namespace App\View\Components;

use App\Models\MenuLink;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Podmeni extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $links = MenuLink::published()->where('tree', 1)->orderBy('position', 'asc')->get()->toTree();
        //$tmp = new PageDisplayController;
        
        return view('components.podmeni', ['links' => $links]);//, 'chunker' => $tmp->dajChunker()
    }
}
