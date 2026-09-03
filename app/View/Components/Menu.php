<?php

namespace App\View\Components;

use App\Http\Controllers\PageDisplayController;
use App\Models\MenuLink;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $header)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $links = MenuLink::published()->orderBy('position', 'asc')->get()->toTree();
        $tmp = new PageDisplayController;
        return view('components.menu', ['links' => $links, 'chunker' => $tmp->dajChunker()]);
    }
}
