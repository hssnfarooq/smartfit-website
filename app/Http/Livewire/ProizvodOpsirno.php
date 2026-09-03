<?php

namespace App\Http\Livewire;

use App\Traits\FetchesUrls;
use Livewire\Component;
use Livewire\ComponentConcerns\PerformsRedirects;
use Lunar\Models\Product;

class ProizvodOpsirno extends Component
{
    use FetchesUrls, PerformsRedirects;

    public $selectedOptionValues = [];

    public function mount($slug)
    {
        $this->url = $this->fetchUrl(
            $slug,
            Product::class,
            [
                'element.media',
                'element.variants.basePrices.currency',
                'element.variants.basePrices.priceable',
                'element.variants.values.option',
            ]
        );

        $product = $this->url?->element;

        if (
            ! $product
            || $product->product_type_id !== 1
            || $product->status !== 'published'
            || empty($product->t_import_json)
            || ! $product->brand
            || ! $product->variants->first()
        ) {
            abort(404);
        }

        /*$this->selectedOptionValues = $this->productOptions->mapWithKeys(function ($data) {
            return [$data['option']->id => $data['values']->first()->id];
        })->toArray();

        if (! $this->variant) {
            abort(404);
        }*/
    }

    /**
     * Computed property to get variant.
     *
     * @return \Lunar\Models\ProductVariant
     */
    public function getVariantProperty()
    {
        $matchedVariant = $this->product->variants->first(function ($variant) {
            return ! $variant->values->pluck('id')
                ->diff(
                    collect($this->selectedOptionValues)->values()
                )->count();
        });

        return $matchedVariant ?: $this->product->variants->first();
    }

    /**
     * Computed property to return product.
     *
     * @return \Lunar\Models\Product
     */
    public function getProductProperty()
    {
        return $this->url->element;
    }

    public function render()
    {
        return view('livewire.proizvod-opsirno');
    }
}
