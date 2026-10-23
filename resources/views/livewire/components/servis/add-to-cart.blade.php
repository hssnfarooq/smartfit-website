@if ($this->ispis == 'radio')

    @php($isCompactBookingOption = in_array((int) $this->grupa, [2, 3], true))
    <div class="{{ $isCompactBookingOption ? 'col-md-4 booking-compact-option' : 'col-sm-6' }}{{ (int) $this->grupa === 3 ? ' booking-mot-option' : '' }}{{ (int) $this->grupa === 2 ? ' booking-servicing-option' : '' }}">
        <x-servis-item-radio
            :servis-id="$this->servisId"
            :servis-name="$this->servisName"
            :servis-description="$this->servisDescription"
            :price-label="$this->priceLabel"
            :grupa="$this->grupa"
            :checked="$this->checked"
        />
    </div>

@else
    <x-servis-item-chkbox
        :servis-id="$this->servisId"
        :servis-name="$this->servisName"
        :servis-description="$this->servisDescription"
        :price-label="$this->priceLabel"
        :price-value="$this->priceValue"
        :grupa="$this->grupa"
        :checked="$this->checked"
    />
@endif
