<label>
    @php
        $isMotOption = (int) $grupa === 3;
        $isServicingOption = (int) $grupa === 2;
        $isCompactBookingOption = $isMotOption || $isServicingOption;
        $motOptions = [
            2 => [
                'name' => 'MOT Class 4',
                'description' => 'Most cars, taxis, ambulances, motor caravans and small vans up to 3,000kg',
                'price' => '£35',
            ],
            5 => [
                'name' => 'MOT Class 7',
                'description' => 'Goods vehicles/vans over 3,000kg and up to 3,500kg',
                'price' => '£55',
            ],
        ];
        $servicingOptions = [
            140 => [
                'name' => 'Interim Service',
                'description' => 'Our interim service is recommended for high mileage drivers who want peace of mind between annual services.',
                'price' => '£94.95',
            ],
            20 => [
                'name' => 'Full Service',
                'description' => 'A full service is a thorough inspection of your vehicle with a 53 point check covering everything from essential fluids under the bonnet to brake discs and pads.',
                'price' => '£159.95',
            ],
            110 => [
                'name' => 'Major Service',
                'description' => 'A major service is a thorough inspection of your vehicle with a check covering everything from fuel filter, spark plugs and pads.',
                'price' => '£194.95',
            ],
        ];
        $motOption = $isMotOption ? ($motOptions[$servisId] ?? null) : null;
        $servicingOption = $isServicingOption ? ($servicingOptions[$servisId] ?? null) : null;
        $bookingOption = $motOption ?? $servicingOption;
    @endphp

    <input type="radio" name="product{{$grupa}}" class="card-input-element" wire:click="{{$checked ? 'makniServis' : 'addToCart'}}"{{$checked ? ' checked' : ''}} />

    <div class="card card-default card-input{{ $isCompactBookingOption ? ' booking-compact-card' : '' }}{{ $isMotOption ? ' booking-mot-card' : '' }}{{ $isServicingOption ? ' booking-servicing-card' : '' }}">
        <div class="card-header">{{ $bookingOption['name'] ?? $servisName }}</div>
        <div class="card-body">
            @if ($bookingOption)
                <p>{{ $bookingOption['description'] }}</p>
            @else
                {!!html_entity_decode($servisDescription)!!}
            @endif
        </div>
        <div class="card-footer">
            @if ($bookingOption)
                {{ $bookingOption['price'] }}
            @elseif ($priceLabel)
                {{$priceLabel}}
            @else
                Price on request
            @endif
        </div>
    </div>
</label> 
