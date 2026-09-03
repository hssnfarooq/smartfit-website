<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="display-4 fw-extrabold text-uppercase text-dark mb-4" style="font-weight: 900; letter-spacing: 0.5px;">
                    FIND A GARAGE NEAR YOU
                </h2>
                <p class="text-secondary fs-6 mb-4 fw-bold" style="color: #444 !important;">
                    Enter your registration number and postcode to find out what car servicing is available near you.
                </p>
                <form action="/booking/order" method="GET">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-uppercase fw-bold text-muted small mb-1" style="font-size: 11px; letter-spacing: 0.5px;">REGISTRATION NUMBER</label>
                            <input type="text" name="reg" class="form-control form-control-lg bg-light border-0 text-uppercase fw-bold" placeholder="AB12 CDE" style="height: 48px; font-size: 15px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-uppercase fw-bold text-muted small mb-1" style="font-size: 11px; letter-spacing: 0.5px;">POSTCODE / LOCATION</label>
                            <input type="text" name="postcode" class="form-control form-control-lg bg-light border-0 text-uppercase fw-bold" placeholder="PE1 3SA" style="height: 48px; font-size: 15px;">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-danger rounded-pill px-4 py-3 fw-bold text-uppercase d-inline-flex align-items-center gap-2" style="background-color: #ED1E24; border-color: #ED1E24; font-size: 13px; letter-spacing: 0.5px;">
                            <span>SEARCH GARAGES</span>
                            <i class="fa-solid fa-plus fs-6"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                <div class="overflow-hidden rounded-3 shadow-sm">
                    <img src="{{ asset('storage/home/image (9).png') }}" alt="Garage Interior" class="img-fluid w-100 object-fit-cover" style="height: 320px; border-radius: 8px;">
                </div>
            </div>
        </div>
    </div>
</section>
