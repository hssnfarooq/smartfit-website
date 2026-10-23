@php($homeGarages = \App\Support\GarageCatalog::all())

<section class="home-garages py-5 bg-white" aria-labelledby="home-garages-title">
    <div class="container py-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-4 position-relative">
                <div class="home-garages__intro">
                    <h2 id="home-garages-title" class="display-4 fw-extrabold text-dark mb-3">OUR GARAGES</h2>
                    <p class="text-secondary fs-5 mb-4">
                        Visit one of our local centres for MOTs, servicing, repairs and tyres.
                    </p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row mx-1">
                    @foreach($homeGarages as $garage)
                        <div class="col-md-4 border home-garages__card" data-garage-card="{{ $garage['slug'] }}">
                            <div class="text-uppercase fw-bold text-muted mb-1 home-garages__area">{{ $garage['area'] }}</div>
                            <h3 class="fw-extrabold text-dark mb-1 home-garages__name">{{ $garage['name'] }}</h3>
                            <address class="text-secondary mb-0 home-garages__address">{{ $garage['address'] }}</address>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.home-garages__intro {
    border-right: 2px solid #111;
}
.home-garages__intro h2 {
    font-family: Montserrat, sans-serif;
    font-weight: 800;
    text-transform: uppercase;
}
.home-garages__intro p {
    font-family: Mulish, sans-serif;
    font-weight: 400;
    text-align: left !important;
}
.home-garages__card {
    min-height: 145px;
    padding: 20px 16px;
    border-color: #e5e7eb !important;
}
.home-garages__area {
    font-size: 10px;
    letter-spacing: 0.08em;
}
.home-garages__name {
    font-family: Montserrat, sans-serif;
    font-size: 18px !important;
    font-weight: 800 !important;
    line-height: 1.35 !important;
}
.home-garages__address {
    color: #666;
    font-family: Mulish, sans-serif;
    font-size: 12px !important;
    font-style: normal;
    line-height: 1.45 !important;
    text-align: left !important;
}
@media (max-width: 991.98px) {
    .home-garages__intro {
        border-right: 0;
    }
}
</style>
