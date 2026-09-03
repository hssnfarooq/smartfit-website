<?php

namespace App\View\Components;

use App\Http\Controllers\PageDisplayController;
use App\Models\MenuLink;
use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
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
        $links = MenuLink::published()->orderBy('position', 'asc')->get()->toTree();
        $services = Page::published()->where('parent_id', 3)->orderBy('position', 'asc')->get();
        $tmp = new PageDisplayController;
        return view('components.footer', ['links' => $links, 'chunker' => $tmp->dajChunker(), 'services' => $services]);
    }
}
