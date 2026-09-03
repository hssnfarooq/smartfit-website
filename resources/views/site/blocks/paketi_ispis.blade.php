@php
    $packages = [
        [
            'title' => 'MAJOR SERVICE',
            'image' => asset('storage/home/image (10).png'),
            'price' => '£194.95',
            'features' => ['Engine oil & oil filter', 'Air filter & cabin filter', 'Fuel filter / spark plugs', '144-point inspection']
        ],
        [
            'title' => 'FULL SERVICE',
            'image' => asset('storage/home/image (11).png'),
            'price' => '£159.95',
            'features' => ['Engine oil & oil filter', '144-point inspection']
        ],
        [
            'title' => 'INTERIM SERVICE',
            'image' => asset('storage/home/image (12).png'),
            'price' => '£94.95',
            'features' => ['Engine oil replacement', 'Oil Filter']
        ],
    ];
@endphp

<section class="py-5" style="background-color: #f4f5f7;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-extrabold text-uppercase mb-0" style="color: #ED1E24; font-weight: 900; letter-spacing: 1px;">
                SERVICES PACKAGES
            </h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach ($packages as $pkg)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 p-4 text-center bg-transparent">
                        <div class="mb-3 d-flex align-items-center justify-content-center" style="height: 160px;">
                            <img src="{{ $pkg['image'] }}" alt="{{ $pkg['title'] }}" class="img-fluid object-fit-contain" style="max-height: 140px;">
                        </div>
                        <h4 class="fw-extrabold text-uppercase text-dark mb-1" style="font-weight: 900; font-size: 18px; letter-spacing: 0.5px;">
                            {{ $pkg['title'] }}
                        </h4>
                        <div class="text-uppercase fw-bold text-muted small mb-3" style="font-size: 11px; letter-spacing: 0.5px;">WHAT IS INCLUDED</div>
                        
                        <div class="d-flex justify-content-center">
                            <ul class="list-unstyled text-start mb-4 px-2 d-inline-block" style="font-size: 14px; color: #222;">
                                @foreach ($pkg['features'] as $feat)
                                    <li class="mb-1 d-flex align-items-center gap-1 justify-content-start">
                                        <span class="rounded-circle d-inline-block" style="width: 4px; height: 4px; background-color: #ED1E24; margin-right: 2px;"></span>
                                        <span style="font-weight: 500;">{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-auto pt-3">
                            <hr style="width: 60px; margin: 0 auto 15px auto; border-top: 2px solid #ED1E24; opacity: 1;">
                            <div class="text-uppercase fw-bold mb-1" style="font-size: 12px; color: #000;">FROM</div>
                            <div class="fw-extrabold mb-3" style="font-size: 22px; font-weight: 900; color: #ED1E24 !important;">
                                {{ $pkg['price'] }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="/booking/order" class="btn btn-danger rounded-pill px-5 py-3 fw-bold text-uppercase d-inline-flex align-items-center gap-2" style="background-color: #ED1E24; border-color: #ED1E24; font-size: 14px; letter-spacing: 0.5px;">
                <span>BOOK A SERVICE</span>
                <i class="fa-solid fa-arrow-right fs-6"></i>
            </a>
        </div>
    </div>
</section>
