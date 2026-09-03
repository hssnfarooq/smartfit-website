<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true" data-bs-backdrop="static" wire:ignore.self>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="userModalLabel">{{$this->modal_title}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Title*</label>
                <select name="title" wire:model="title" class="form-select" required="">
                    <option value="">-- please select --</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Ms">Ms</option>
                    <option value="Miss">Miss</option>
                    <option value="Mx">Mx</option>
                    <option value="Other">Other</option>
                </select>
                @error('title')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name">First Name*</label>
                <input type="text" class="form-control txt_f_modal" name="name" wire:model="name" value="" required="">
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name">Last Name*</label>
                <input type="text" class="form-control txt_f_modal" name="last_name" wire:model="last_name" value="" required="">
                @error('last_name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email">E-mail*</label>
                <input type="text" class="form-control txt_f_modal" name="email" wire:model="email" value="" required="">
                @error('email')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="telephone">Telephone*</label>
                <input type="text" class="form-control txt_f_modal" name="telephone" wire:model="telephone" value="" required="">
                @error('telephone')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="mb-3 form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="gdpr" wire:model="gdpr" id="a_gdpr" value="1" required>
                <label class="form-check-label" for="a_gdpr">I understand that {{env('PDF_ORDER_NAME')}} will store the above information in order to fulfil the service and that collected data is periodically removed.*</label>
            </div>
            @error('gdpr')
                <span class="text-danger">{{$message}}</span>
            @enderror

            <hr>

            <div class="mb-3 form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="future_communications" wire:model="future_communications" id="a_future_communications" value="1" >
                <label class="form-check-label" for="a_future_communications">I would like to receive future communications from {{env('PDF_ORDER_NAME')}}</label>
            </div>

            <hr>

            <div class="mb-3 form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="terms" value="1" id="a_terms" wire:model="terms" required>
                <label class="form-check-label" for="a_terms">I accept the <a href="/terms-and-conditions" target="_blank">terms &amp; conditions</a>*</label>
            </div>
            @error('terms')
                <span class="text-danger">{{$message}}</span>
            @enderror

            @if ($this->zatvori)
                <div class="alert alert-success" role="alert" style="margin-top:50px">
                You have successfuly entered your informations. Close this and proceed to payement.
                </div>
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" wire:click.prevent="sejv">Save</button>
        </div>
      </div>
    </div>
</div>