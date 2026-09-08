<div>
    @if (isset($this->auto_json->registration))
    <h1 class="text-white fw-bold display-4 text-uppercase mb-3" style="letter-spacing: 1px;">
        Your car
    </h1>
    <p class="text-white fs-5 mb-4" style="max-width: 600px;">
        Check these details relate to your vehicle. If they’re incorrect, press ‘Not my vehicle’ to re-enter your information.
    </p>   
    @else
        <div class="sf-home-hero__layout">
            <div class="sf-home-hero__copy">
                <h1 class="sf-home-hero__title text-white text-uppercase">
                    {!! $this->naslov ? $this->naslov : "<span class='sf-home-hero__line'>LET'S GET YOU</span><span class='sf-home-hero__line sf-home-hero__accent'>ON THE ROAD</span>" !!}
                </h1>
            </div>
            <div class="sf-home-hero__search">
                <form wire:submit.prevent="searchReg" class="sf-home-hero__form">
                    <input type="search" name="registration" wire:model="registration" class="form-control smartfit_light_input sf-home-hero__registration text-center text-uppercase fw-bold" placeholder="Enter Registration" aria-label="Enter vehicle registration" autocomplete="off" spellcheck="false">
                    <button type="submit" class="btn btn-danger w-100 fw-bold text-uppercase sf-cta sf-cta--primary sf-home-hero__submit">
                        <span>GET A QUOTE</span>
                        <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
        @error('registration')
            <span class="sf-home-hero__error mt-2 d-block fw-bold">{{$message}}</span>
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
            <button type="button" class="btn btn-success sf-cta sf-cta--primary" wire:click.prevent="selekt">Select</button>
            <button type="button" class="btn btn-danger sf-cta sf-cta--outline-dark" wire:click.prevent="ponovno">Not my vehicle</button>
        </div>
    </div>
    @endif
</div>
