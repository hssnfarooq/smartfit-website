@php
    $offers = [
        [
            'title' => 'MAINTENANCE',
            'desc' => 'Regular checkups to maintain your car\'s high performance.',
            'image' => asset('assets/images/home/service-maintenance.webp'),
            'url' => '/services/maintenance'
        ],
        [
            'title' => 'REPAIR',
            'desc' => 'Quality service that guarantees smooth and safe rides.',
            'image' => asset('assets/images/home/service-repair.webp'),
            'url' => '/services/repairs'
        ],
        [
            'title' => 'PARTS SOURCING',
            'desc' => 'Access to trusted suppliers for genuine and high-quality aftermarket parts.',
            'image' => asset('assets/images/home/service-parts-sourcing.webp'),
            'url' => '/services/parts-sourcing'
        ],
        [
            'title' => 'FLEET & CONTRACT WORK',
            'desc' => 'Reliable maintenance and repair services for business and fleet vehicles.',
            'image' => asset('assets/images/home/service-fleet.webp'),
            'url' => '/services/fleet'
        ],
        [
            'title' => 'SERVICING',
            'desc' => 'Regular vehicle servicing to keep your car running smoothly and efficiently.',
            'image' => asset('assets/images/home/service-servicing.webp'),
            'url' => '/services/servicing'
        ],
        [
            'title' => 'VEHICLE RECOVERY',
            'desc' => 'Fast and reliable recovery services whenever you need assistance.',
            'image' => asset('assets/images/home/vehicle-recovery.webp'),
            'url' => '/services/vehicle-recovery'
        ],
    ];
@endphp

<section class="our_services_section py-5" style="background-color: #1e1e1e;">
    <div class="container py-4">
        <div class="section_heading text-center mb-5">
            <h2 class="display-5 fw-extrabold text-uppercase text-white mb-0" style="font-weight: 900; letter-spacing: 1px;">WHAT WE OFFER</h2>
        </div>

        <div class="row g-4">
            @foreach ($offers as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 rounded-3 overflow-hidden shadow-sm" style="background-color: #2b2b2b;">
                        <div style="height: 220px; overflow: hidden;">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-100 h-100 object-fit-cover" loading="lazy" decoding="async">
                        </div>
                        <div class="p-3 text-center" style="background-color: #ED1E24;">
                            <h4 class="fw-bold text-uppercase text-white mb-0 fs-5" style="letter-spacing: 0.5px;">{{ $item['title'] }}</h4>
                        </div>
                        <div class="p-3 text-center flex-grow-1 d-flex align-items-center justify-content-center" style="background-color: #ED1E24;">
                            <p class="text-white-50 mb-0 small" style="font-size: 13px; line-height: 1.4; color: rgba(255,255,255,0.85) !important;">
                                {{ $item['desc'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
