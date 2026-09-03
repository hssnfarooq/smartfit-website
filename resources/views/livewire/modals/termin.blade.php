<div class="modal fade" id="terminModal" tabindex="-1" aria-labelledby="terminModalLabel" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="terminModalLabel">{{$this->modal_title}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           
            

            <div class="input-group mb-3">
                <label>Date one</label>
                <input type="date" class="form-control" wire:model="date1" required>
            
                <select class="form-select" wire:model="doba_dana1">
                    <option value="Morning">Morning</option>
                    <option value="Afternoon">Afternoon</option>
                </select>
            </div>
            @error('date1')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="input-group mb-3">
                <label>Date two</label>
                <input type="date" class="form-control" wire:model="date2" required>
            
                <select class="form-select" wire:model="doba_dana2">
                    <option value="Morning">Morning</option>
                    <option value="Afternoon">Afternoon</option>
                </select>
            </div>
            @error('date2')
                <span class="text-danger">{{$message}}</span>
            @enderror

            @if ($this->zatvori)
              <div class="alert alert-success" role="alert" style="margin-top:50px">
                You have successfuly updated preferred appointments
              </div>
            @endif

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          @if (!empty($this->date1) && !empty($this->date2))
              <button type="button" class="btn btn-primary" wire:click.prevent="selekt">Save</button>
          @endif          
        </div>
      </div>
    </div>
</div>