<div>
    @if (isset($this->auto_json->registration))
    <h1 class="text-white fw-bold display-4 text-uppercase mb-3" style="letter-spacing: 1px;">
        Your car
    </h1>
    <p class="text-white fs-5 mb-4" style="max-width: 600px;">
        Check these details relate to your vehicle. If they’re incorrect, press ‘Not my vehicle’ to re-enter your information.
    </p>   
    @else
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="text-white fw-extrabold display-3 text-uppercase lh-1 mb-0" style="font-weight: 900; letter-spacing: 1px;">
                    {!! $this->naslov ? $this->naslov : "LET'S GET YOU <br><span style='color:#ED1E24;'>ON THE ROAD</span>" !!}
                </h1>
            </div>
            <div class="col-lg-5 mt-4 mt-lg-0">
                <div class="bg-white p-4 rounded-4 shadow-lg text-center" style="max-width: 380px; margin-left: auto;">
                    <div class="mb-3">
                        <input type="search" name="registration" wire:model="registration" class="form-control smartfit_light_input form-control-lg border-secondary-subtle rounded-3 text-center text-uppercase fw-bold" placeholder="Enter Registration" style="height: 54px; font-size: 18px; letter-spacing: 1px;">
                    </div>
                    <button type="submit" class="btn btn-danger w-100 py-3 rounded-pill fw-bold text-uppercase d-flex align-items-center justify-content-center gap-2" wire:click="searchReg" style="background-color: #ED1E24; border-color: #ED1E24; font-size: 15px; letter-spacing: 0.5px; height: 50px;">
                        <span>GET A QUOTE</span>
                        <i class="fa-solid fa-arrow-right fs-6"></i>
                    </button>
                </div>
            </div>
        </div>
        @error('registracija')
            <span class="text-danger mt-2 d-block fw-bold">{{$message}}</span>
        @enderror
    @endif
    
    @if (!empty($this->auto_json))
        @if (isset($this->auto_json->errorMessage))
        <div class="alert alert-danger mt-4" role="alert">
            {{$this->auto_json->errorMessage}}
        </div>    
        @endif
    @endif

    @if (isset($this->auto_json->registration))
    <div class="bg-white p-4 rounded-3 mt-4 text-dark shadow">
        <x-modals.auto.auto-info :auto="$this->auto_json" />
        <div class="mt-4 d-flex gap-2">
            <button type="button" class="btn btn-success px-4 py-2" wire:click.prevent="selekt">Select</button>
            <button type="button" class="btn btn-danger px-4 py-2" wire:click.prevent="ponovno" style="background-color: #ED1E24;">Not my vehicle</button>
        </div>
    </div>
    @endif
</div>
