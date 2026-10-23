@php
    $i = $grupa->id;
    $isBrakeGroup = (int) $i === 5;
    $servisi = App\Support\BookingServiceOptions::forGroup((int) $i);
    
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
            <div class="row{{ in_array((int) $i, [2, 3], true) ? ' booking-compact-options' : '' }}{{ $i === 3 ? ' booking-mot-options' : '' }}{{ $i === 2 ? ' booking-servicing-options' : '' }}{{ $isBrakeGroup ? ' booking-checkbox-options booking-brake-options' : '' }}">
@php
    /*@if ($ispis == 'radio')
                <livewire:components.servis.add-to-cart :grupa="$i" :ispis="$ispis">
              @endif  */
@endphp
              

              @foreach ($servisi as $servis)
                <livewire:components.servis.add-to-cart
                  :purchasable-id="$servis['variant_id']"
                  :servis-id="$servis['product_id']"
                  :servis-name="$servis['name']"
                  :servis-description="$servis['description']"
                  :price-label="$servis['price_label']"
                  :price-value="$servis['price_value']"
                  :wire:key="$servis['variant_id']"
                  :ispis="$ispis"
                  :grupa="$i"
                />
              @endforeach
             
            </div>
        </div>
      </div>
    </div>   
</div>
