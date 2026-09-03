<label>
    @php($price = $servis->prices->first())

    <input type="radio" name="product{{$grupa}}" class="card-input-element" wire:click="{{$checked ? 'makniServis' : 'addToCart'}}"{{$checked ? ' checked' : ''}} />

    <div class="card card-default card-input">
        <div class="card-header">{{$servis->translateAttribute('name')}}</div>
        <div class="card-body">
        
            {!!html_entity_decode($servis->translateAttribute('description'))!!} 
            
        </div>
        <div class="card-footer">
            @if ($price)
                {{$price->priceIncTax()->formatted()}}
            @else
                Price on request
            @endif
        </div>
    </div>
</label> 
