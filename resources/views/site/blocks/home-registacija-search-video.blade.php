<section class="hero_section position-relative" style="background-image: url('{{ asset('assets/images/home/hero-range-rover.webp') }}'); background-size: cover; background-position: center center; padding: 120px 0 160px; min-height: 560px; display: flex; align-items: center;">
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.5); z-index: 1;"></div>
    <div class="container position-relative" style="z-index: 2;">
        <div class="row">
            <div class="col-lg-12">
                <livewire:components.home.auto-search naslov="LET'S GET YOU <span style='color:#ED1E24'>ON THE ROAD</span>" :kratki="$block->input('description')">
            </div>
        </div>
    </div>
</section>
