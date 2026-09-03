@php
    $i = $grupa->id;
    $currencyId = App\Support\CartPriceGuard::currentCurrencyId();

    $servisi = Lunar\Models\Product::query()
        ->where('product_type_id', $i)
        ->where('status', 'published')
        ->whereHas('variants.prices', function ($query) use ($currencyId) {
            $query->where('currency_id', $currencyId)
                ->where('price', '>', 0);
        })
        ->with([
            'prices' => function ($query) use ($currencyId) {
                $query->where('currency_id', $currencyId)
                    ->where('price', '>', 0);
            },
            'variants' => function ($query) use ($currencyId) {
                $query->whereHas('prices', function ($priceQuery) use ($currencyId) {
                    $priceQuery->where('currency_id', $currencyId)
                        ->where('price', '>', 0);
                })->with(['prices' => function ($priceQuery) use ($currencyId) {
                    $priceQuery->where('currency_id', $currencyId)
                        ->where('price', '>', 0);
                }]);
            },
        ])
        ->get();
    
@endphp
<div class="accordion" id="faq_accordion{{$i}}" style="margin-bottom: 30px">
    <div class="accordion-item">
      <div class="accordion-header" id="headingOne{{$i}}">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$i}}" aria-expanded="true" aria-controls="collapseOne{{$i}}" style="font-size:24px">
          {{$grupa->name}}
        </button>
      </div>
      <div id="collapseOne{{$i}}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faq_accordion{{$i}}">
        <div class="accordion-body pt-0 harmonika_bodi">
            <div class="row">
@php
    /*@if ($ispis == 'radio')
                <livewire:components.servis.add-to-cart :grupa="$i" :ispis="$ispis">
              @endif  */
@endphp
              

              @foreach ($servisi as $servis)
                @php($variant = $servis->variants->first())

                @if ($variant)
                  <livewire:components.servis.add-to-cart :purchasable="$variant" :wire:key="$variant->id" :ispis="$ispis" :servis="$servis" :grupa="$i">
                @endif
              @endforeach
             
            </div>
        </div>
      </div>
    </div>   
</div>
