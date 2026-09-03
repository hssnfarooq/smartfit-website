<div class="modal fade" id="autoModal" tabindex="-1" aria-labelledby="autoModalLabel" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="autoModalLabel">{{$this->modal_title}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
   
            <form class="subscribe_form_inline">
                <input type="text"  wire:model="registration" placeholder="Car registration" required>                
                <button type="button" class="btn btn-primary" wire:click="searchReg">
                    <span class="btn_text">Search</span>
                </button>
            </form>
            @error('registracija')
                <span class="text-danger">{{$message}}</span>
            @enderror
            @if ($this->zatvori)
              <div class="alert alert-success" role="alert" style="margin-top:30px">
                You have successfuly updated your vehicle.
              </div>
            @endif

            @if (!empty($this->auto_json))
              @if (isset($this->auto_json->errorMessage))
                <div class="alert alert-danger" role="alert" style="margin-top:30px">
                  {{$this->auto_json->errorMessage}}
                </div>                  
              @else                
                <x-modals.auto.auto-info :auto="$this->auto_json" />
              @endif
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          @if (isset($this->auto_json->registration))
              <button type="button" class="btn btn-primary" wire:click.prevent="selekt">Save</button>
          @endif
          
        </div>
      </div>
    </div>
</div>