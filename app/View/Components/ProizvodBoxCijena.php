<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Lunar\Facades\Pricing;
use Lunar\Models\Price;
use Throwable;

class ProizvodBoxCijena extends Component
{
    public ?Price $cijena = null;

    /**
     * Create a new component instance.
     */
    public function __construct($proizvod = null, $view = null)
    {
        $variant = $proizvod?->variants?->first();

        if (! $variant) {
            return;
        }

        try {
            $this->cijena = Pricing::for($variant)->get()->matched;
        } catch (Throwable $exception) {
            $this->cijena = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.proizvod-box-cijena');
    }
}
