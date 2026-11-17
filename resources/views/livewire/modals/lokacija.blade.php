<div class="modal fade" id="lokacijaModal" tabindex="-1" aria-labelledby="lokacijaModalLabel" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="lokacijaModalLabel">{{$this->modal_title}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           
            <fieldset class="service-centre-picker mb-3">
                <legend class="service-centre-picker__legend">Select service location</legend>

                <div class="service-centre-picker__options" role="radiogroup" aria-label="Select service location">
                    @foreach ($lokacije as $item)
                        <label class="service-centre-option" wire:key="service-centre-{{ $item['slug'] }}">
                            <input
                                class="service-centre-option__input"
                                type="radio"
                                name="service-centre"
                                value="{{ $item['slug'] }}"
                                wire:model="lokacija"
                            >
                            <span class="service-centre-option__card">
                                <span class="service-centre-option__icon" aria-hidden="true">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
                                <span class="service-centre-option__copy">
                                    <strong>{{ $item['name'] }}</strong>
                                    <span>{{ $item['address'] }}</span>
                                </span>
                                <span class="service-centre-option__selected" aria-hidden="true">
                                    <i class="fa-solid fa-circle-check"></i>
                                </span>
                            </span>
                        </label>
                    @endforeach
                </div>
            </fieldset>
            @error('lokacija')
                <span class="text-danger">{{$message}}</span>
            @enderror


            @if (!empty($data))
                <x-modals.lokacija.info :data="$data"/>
            @endif

            @if ($this->zatvori)
              <div class="alert alert-success" role="alert" style="margin-top:50px">
                You have successfuly updated service location
              </div>
            @endif

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          @if (!empty($data))
              <button type="button" class="btn btn-primary" wire:click.prevent="selekt">Save</button>
          @endif          
        </div>
      </div>
    </div>
</div>
