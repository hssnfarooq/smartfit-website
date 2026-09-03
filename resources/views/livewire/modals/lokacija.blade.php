<div class="modal fade" id="lokacijaModal" tabindex="-1" aria-labelledby="lokacijaModalLabel" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="lokacijaModalLabel">{{$this->modal_title}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           
            <div class="input-group mb-3">
                <label>Select service location</label>
            
                <select class="form-select" wire:model="lokacija">
                   <option value="0">-- please select --</option>
                    @foreach ($lokacije as $item)
                        <option value="{{$item->id}}">{{$item->title}}</option>
                    @endforeach
                </select>
            </div>
            @error('date1')
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