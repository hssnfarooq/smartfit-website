<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">

{!! SEO::generate() !!}
@include('frontend.inc.meta')

<style>
H1 {font-family: Montserrat !important; font-weight: 800; font-size: 60px;}
H2 {font-family: Montserrat !important; font-weight: 800;}
H3 {font-family: Montserrat !important; font-weight: 700;}
H4 {font-family: Montserrat !important; font-weight: 700;}
H5 {font-family: Montserrat !important; font-weight: 600;}
H6 {font-family: Montserrat !important; font-weight: 600;}
p {
    font-family: Mulish !important;font-weight: 400;vertical-align: middle !important;
}
.fm-hero-title{font-size:clamp(2.2rem,3.8vw,3.6rem);font-weight:900;line-height:1.06;letter-spacing:-.8px;text-transform:uppercase;color:#fff;margin-bottom:20px}
.fs-5 {font-size: 18px !important;}
@media(max-width:767px){
    H1 {font-size: 40px;}
.fm-hero-title{font-size:2rem;font-weight: 800;line-height: 121%;letter-spacing: -0.42px;}
.fs-5 {font-size: 16px !important;}
}
</style>
</head>
<body>
@include('frontend.inc.odrzavanje')

<div class="page_wrapper">

@include('frontend.inc.backtotop')

@include('frontend.inc.header')

<!-- Main Body - Start
================================================== -->
<main class="page_content">

@if (isset($item))
@php $currentSlug = $item->slug ?? ''; @endphp

@if($currentSlug === 'home-page' || $currentSlug === '' || $currentSlug === 'home')
{{-- ============================================================
HOME PAGE — Sequence matching provided design
1. Hero: Let's Get You On The Road
2. Brand Logos Row
3. Reputation 35 Years
4. What We Offer (6 Cards)
5. Find a Garage Near You
6. Services Packages (3 Packages)
7. Banner CTA: Reliable repair & maintenance
8. Our Garages (6 locations)
9. What Our Customers Say (Testimonials)
10. Why Choose Us (4 Feature Cards)
11. Get In Touch (Contact Grid)
============================================================ --}}

{{-- 1. HERO SECTION --}}
<style>
@media (max-width: 768px){
.hero_section {
    padding: 60px 0 60px !important;
    min-height: 500px !important;
}
}
</style>
<section class="hero_section position-relative" style="background-image: url('{{ asset('storage/home/image.webp') }}'); background-size: cover; background-position: center center; padding: 100px 0 140px; min-height: 840px; display: flex; align-items: center;">
<div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0); z-index: 1;"></div>
<div class="container position-relative" style="z-index: 2;">
<livewire:components.home.auto-search naslov="LET'S GET YOU <br><span style='color:#ED1E24'>ON THE ROAD</span>" />
</div>
</section>

{{-- 2. BRAND LOGOS ROW (AUTOMATIC SLIDER) --}}
<section class="brand_bar py-4 bg-white" style="border-bottom: none !important; border-top: none !important;">
<div class="container">
<div class="home_brand_slider_wrap position-relative">
    <div class="home_brand_carousel">
        <div class="brand_slide_px px-2">
            <a href="/tyres?manufacturer=Continental" class="brand_slide_card d-flex align-items-center justify-content-center text-decoration-none">
                <img src="{{ asset('assets/images/brands/continental.svg') }}" alt="Continental" style="max-height: 38px; max-width: 85%; object-fit: contain;">
            </a>
        </div>
        <div class="brand_slide_px px-2">
            <a href="/tyres?manufacturer=Goodyear" class="brand_slide_card d-flex align-items-center justify-content-center text-decoration-none">
                <img src="{{ asset('assets/images/brands/goodyear.svg') }}" alt="Goodyear" style="max-height: 42px; max-width: 85%; object-fit: contain;">
            </a>
        </div>
        <div class="brand_slide_px px-2">
            <a href="/tyres?manufacturer=Nexen" class="brand_slide_card d-flex align-items-center justify-content-center text-decoration-none">
                <img src="{{ asset('assets/images/brands/nexen.svg') }}" alt="Nexen Tire" style="max-height: 36px; max-width: 85%; object-fit: contain;">
            </a>
        </div>
        <div class="brand_slide_px px-2">
            <a href="/tyres?manufacturer=Bridgestone" class="brand_slide_card d-flex align-items-center justify-content-center text-decoration-none">
                <img src="{{ asset('assets/images/brands/bridgestone.svg') }}" alt="Bridgestone" style="max-height: 36px; max-width: 85%; object-fit: contain;">
            </a>
        </div>
        <div class="brand_slide_px px-2">
            <a href="/tyres?manufacturer=Pirelli" class="brand_slide_card d-flex align-items-center justify-content-center text-decoration-none">
                <img src="{{ asset('assets/images/brands/pirelli.svg') }}" alt="Pirelli" style="max-height: 44px; max-width: 85%; object-fit: contain;">
            </a>
        </div>
        <div class="brand_slide_px px-2">
            <a href="/tyres?manufacturer=Michelin" class="brand_slide_card d-flex align-items-center justify-content-center text-decoration-none">
                <svg viewBox="0 0 230 50" style="max-height: 40px; width: 100%; max-width: 170px;" xmlns="http://www.w3.org/2000/svg">
                  <rect width="230" height="50" rx="4" fill="#002244"/>
                  <text x="115" y="33" font-family="'Arial Black', sans-serif" font-weight="900" font-style="italic" font-size="21" fill="#FFFFFF" text-anchor="middle" letter-spacing="1">MICHELIN</text>
                  <rect x="25" y="40" width="180" height="3" fill="#FFE500"/>
                </svg>
            </a>
        </div>
        <div class="brand_slide_px px-2">
            <a href="/tyres?manufacturer=Dunlop" class="brand_slide_card d-flex align-items-center justify-content-center text-decoration-none">
                <svg viewBox="0 0 210 50" style="max-height: 38px; width: 100%; max-width: 170px;" xmlns="http://www.w3.org/2000/svg">
                  <g transform="translate(10, 10)">
                    <circle cx="15" cy="15" r="14" fill="#ED1E24"/>
                    <text x="15" y="22" font-family="'Arial Black', sans-serif" font-weight="900" font-size="18" fill="#FFFFFF" text-anchor="middle">D</text>
                  </g>
                  <text x="50" y="34" font-family="'Arial Black', sans-serif" font-weight="900" font-style="italic" font-size="24" fill="#111111" letter-spacing="1">DUNLOP</text>
                </svg>
            </a>
        </div>
        <div class="brand_slide_px px-2">
            <a href="/tyres?manufacturer=Hankook" class="brand_slide_card d-flex align-items-center justify-content-center text-decoration-none">
                <svg viewBox="0 0 220 50" style="max-height: 38px; width: 100%; max-width: 170px;" xmlns="http://www.w3.org/2000/svg">
                  <g transform="translate(8, 12)">
                    <polygon points="0,26 14,0 28,26" fill="#FF5500"/>
                    <polygon points="6,26 14,8 22,26" fill="#FFFFFF"/>
                  </g>
                  <text x="46" y="34" font-family="'Arial Black', sans-serif" font-weight="900" font-style="italic" font-size="21" fill="#111111" letter-spacing="0.5">HANKOOK</text>
                </svg>
            </a>
        </div>
    </div>
</div>
</div>
</section>

<style>
.home_brand_slider_wrap {
padding-bottom: 0;
}
.brand_slide_card {
background: #ffffff;
border: 1px solid #e5e7eb;
border-radius: 6px;
min-height: 105px;
height: 105px;
padding: 12px 18px;
transition: all 0.25s ease;
box-shadow: 0 1px 3px rgba(0,0,0,0.02);
}
.brand_slide_card:hover {
border-color: #ED1E24;
box-shadow: 0 4px 14px rgba(237, 30, 36, 0.12);
transform: translateY(-2px);
}
</style>

<script>
(function() {
function initHomeBrandSlider() {
if (window.jQuery && jQuery.fn.slick && jQuery('.home_brand_carousel').length) {
    if (!jQuery('.home_brand_carousel').hasClass('slick-initialized')) {
        jQuery('.home_brand_carousel').slick({
            dots: false,
            arrows: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 1800,
            speed: 600,
            slidesToShow: 5,
            slidesToScroll: 1,
            pauseOnHover: true,
            pauseOnFocus: false,
            swipeToSlide: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
}
}

if (document.readyState === 'complete' || document.readyState === 'interactive') {
setTimeout(initHomeBrandSlider, 100);
} else {
document.addEventListener('DOMContentLoaded', initHomeBrandSlider);
}
window.addEventListener('load', initHomeBrandSlider);
})();
</script>

{{-- 3. A REPUTATION 35 YEARS IN THE MAKING --}}
<section class="about_section py-5 bg-white">
<div class="container py-4">
<div class="row align-items-center g-5">
    <div class="col-lg-5">
        <h2 class="display-4 fw-extrabold text-dark mb-5" style=" font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
            A REPUTATION 35 YEARS IN THE MAKING
        </h2>
        <div class="mt-4 overflow-hidden rounded-3 shadow-sm">
            <img src="{{ asset('storage/home/image (2).png') }}" alt="Mercedes AMG Coupe" class="img-fluid w-100 object-fit-cover" style="height: 320px; border-radius: 8px;">
        </div>
    </div>
    <div class="col-lg-1 d-lg-block d-none"></div>
    <div class="col-lg-6">
        <div class="mb-4 overflow-hidden rounded-3 shadow-sm">
            <img src="{{ asset('storage/home/image (1).png') }}" alt="Car Cockpit Interior" class="img-fluid w-100 object-fit-cover" style="height: 340px; border-radius: 8px;">
        </div>
        <p class="text-secondary fs-5 mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
            For over 35 years, Smartfit Autos has provided trusted MOTs, servicing, repairs and tyres across the UK. Built on honest advice, reliable workmanship and experienced technicians.
        </p>
        <div>
            <a class="btn btn-danger rounded-pill px-4 py-3 fw-bold text-uppercase d-inline-flex align-items-center gap-2" href="/about-us" style="background-color: #ED1E24; border-color: #ED1E24; font-size: 14px; letter-spacing: 0.5px;">
                <span>FIND OUT MORE</span>
                <i class="fa-solid fa-arrow-right fs-6"></i>
            </a>
        </div>
    </div>
</div>
</div>
</section>

{{-- 4. WHAT WE OFFER (6 CARDS) --}}
@php
$hmOffers = [
[
    'title' => 'MAINTENANCE',
    'desc' => 'Regular checkups to maintain your car\'s high performance.',
    'image' => asset('storage/home/image (3).png'),
    'url' => '/services/maintenance'
],
[
    'title' => 'REPAIR',
    'desc' => 'Quality service that guarantees smooth and safe rides.',
    'image' => asset('storage/home/image (4).png'),
    'url' => '/services/repairs'
],
[
    'title' => 'PARTS SOURCING',
    'desc' => 'Access to trusted suppliers for genuine and high-quality aftermarket parts.',
    'image' => asset('storage/home/image (5).png'),
    'url' => '/services/parts-sourcing'
],
[
    'title' => 'FLEET & CONTRACT WORK',
    'desc' => 'Reliable maintenance and repair services for business and fleet vehicles.',
    'image' => asset('storage/home/image (6).png'),
    'url' => '/services/fleet'
],
[
    'title' => 'SERVICING',
    'desc' => 'Regular vehicle servicing to keep your car running smoothly and efficiently.',
    'image' => asset('storage/home/image (7).png'),
    'url' => '/services/servicing'
],
[
    'title' => 'VEHICLE RECOVERY',
    'desc' => 'Fast and reliable recovery services whenever you need assistance.',
    'image' => asset('storage/home/image (8).png'),
    'url' => '/services/vehicle-recovery'
],
];
@endphp
<section class="our_services_section py-5" style="background-color: #1e1e1e;">
<div class="container py-4">
<div class="section_heading text-center mb-5">
    <h2 class="display-4 fw-extrabold mb-0 text-white" style=" font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
        WHAT WE OFFER
    </h2>
</div>

<div class="row g-4">
    @foreach ($hmOffers as $hmo)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 rounded-3 overflow-hidden shadow-sm" style="background-color: #2b2b2b;">
                <div style="height: 220px; overflow: hidden;">
                    <img src="{{ $hmo['image'] }}" alt="{{ $hmo['title'] }}" class="w-100 h-100 object-fit-cover">
                </div>
                <div class="p-3 text-center pb-0" style="background-color: #ED1E24;">
                    <h3 class="fw-bold text-white mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;text-align: center;vertical-align: middle;text-transform: uppercase !important;">
                        {{ $hmo['title'] }}
                    </h3>
                </div>
                <div class="p-3 text-center flex-grow-1 d-flex align-items-center justify-content-center" style="background-color: #ED1E24;">
                    <p class="mb-0 fs-5" style="color: #fff !important;font-family: Mulish;font-weight: 400;font-size: 18px;vertical-align: middle;text-align: left !important;">
                        {{ $hmo['desc'] }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
</section>

{{-- 5. FIND A GARAGE NEAR YOU --}}
<section class="py-5 bg-white">
<div class="container py-4">
<div class="row align-items-center g-5">
    <div class="col-lg-12 mt-0 text-center">
        <h2 class="display-4 fw-extrabold text-dark mb-0" style=" font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
            FIND A GARAGE NEAR YOU
        </h2>
    </div>
    <div class="col-lg-6 mt-0 mt-lg-5">
        <p class="text-dark fs-5 mb-4 fw-bold" style="font-family: Mulish;font-weight: 700;vertical-align: middle;text-align: left !important;">
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
                    <i class="fa-solid fa-arrow-right fs-6"></i>
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

{{-- 6. SERVICES PACKAGES --}}
@php
$hmPackages = [
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
<div class="text-center mb-0">
    <h2 class="display-4 fw-extrabold mb-0" style="color: #ED1E24;font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
        SERVICES PACKAGES
    </h2>
</div>

<div class="row g-4 justify-content-center">
    @foreach ($hmPackages as $pkg)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 p-4 text-center bg-transparent">
                <div class="mb-3 d-flex align-items-center justify-content-center" style="height: 160px;">
                    <img src="{{ $pkg['image'] }}" alt="{{ $pkg['title'] }}" class="img-fluid object-fit-contain" style="max-height: 140px;">
                </div>
                <h3 class="fw-bold text-dark mb-1" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;text-align: center;vertical-align: middle;text-transform: uppercase !important;">
                    {{ $pkg['title'] }}
                </h4>
                <div class="text-uppercase fw-bold text-muted small mb-3" style="font-size: 11px; letter-spacing: 0.5px;">WHAT IS INCLUDED</div>
                
                <div class="d-flex justify-content-center">
                    <ul class="list-unstyled text-left mb-4 px-2 d-inline-block" style="font-size: 18px; color: #222;">
                        @foreach ($pkg['features'] as $feat)
                            <li class="mb-1 d-flex align-items-center gap-1 justify-content-center">
                                <span class="rounded-circle d-inline-block" style="width: 4px; height: 4px; background-color: #ED1E24; margin-right: 2px;"></span>
                                <span style="font-weight: 500;">{{ $feat }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-auto pt-3">
                    <hr style="width: 100px; margin: 0 auto 15px auto; border-top: 2px solid #ED1E24; opacity: 1;">
                    <div class="text-uppercase fw-bold mb-1" style=" color: #000;font-family: Mulish;font-weight: 800 !important;font-size: 16px;line-height: 30.4px;letter-spacing: -0.19px;text-align: center;vertical-align: middle;">
                        FROM
                    </div>
                    <div class="fw-extrabold mb-3" style="font-family: Mulish;font-size: 22px; font-weight: 900; color: #ED1E24 !important;">
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

{{-- 7. BANNER CTA: RELIABLE AUTOMOTIVE REPAIR --}}
<section class="position-relative text-white text-center py-5" style="background-image: url('{{ asset('storage/home/image (14).jpg') }}'); background-size: cover; background-position: center; min-height: 500px; display: flex; align-items: center;">
<div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.65); z-index: 1;"></div>
<div class="container position-relative py-4" style="z-index: 2;">
<div class="row justify-content-center">
    <div class="col-lg-8">
        <p class="display-5 fw-extrabold text-white mb-4" style="font-weight: 800; line-height: 1.3;">
            Reliable automotive repair and maintenance you can count on.
        </p>
        <div>
            <a href="/booking/order" class="btn btn-danger rounded-pill px-4 py-3 fw-bold text-uppercase d-inline-flex align-items-center gap-2" style="background-color: #ED1E24; border-color: #ED1E24; font-size: 14px; letter-spacing: 0.5px;">
                <span>BOOK AN APPOINTMENT</span>
                <i class="fa-solid fa-arrow-right fs-6"></i>
            </a>
        </div>
    </div>
</div>
</div>
</section>

{{-- 8. OUR GARAGES --}}
<section class="py-5 bg-white">
<div class="container py-4">
<div class="row align-items-center g-4">
    <div class="col-lg-4 position-relative">
        <div class="" style="border-right: 2px solid #111;">
            <h2 class="display-4 fw-extrabold text-dark mb-3" style=" font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
                OUR GARAGES
            </h2>
            <p class="text-secondary fs-5 mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
                Visit one of our local centres for MOTs, servicing, repairs and tyres.
            </p>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="row mx-1">
            <div class="col-md-4 border" style="border-color: #e5e7eb !important;">
                <div class="text-uppercase fw-bold text-muted mb-1" style="font-size: 10px; letter-spacing: 0.8px;">PETERBOROUGH</div>
                <p class="fw-extrabold text-dark mb-1" style=" font-family: Montserrat;font-weight: 800;font-size: 20px;line-height: 28.25px;letter-spacing: -0.18px;vertical-align: middle;">
                    Smartfit Auto Centre
                </p>
                <div class="text-secondary" style="font-size: 12px; line-height: 1.4; color: #666;">
                    39 Northfield Rd,<br>Peterborough, PE1 3QQ
                </div>
            </div>
           <div class="col-md-4 border" style="border-color: #e5e7eb !important;">
                <div class="text-uppercase fw-bold text-muted mb-1" style="font-size: 10px; letter-spacing: 0.8px;">PETERBOROUGH</div>
                <p class="fw-extrabold text-dark mb-1" style=" font-family: Montserrat;font-weight: 800;font-size: 20px;line-height: 28.25px;letter-spacing: -0.18px;vertical-align: middle;">
                    Smartfit Auto Centre
                </p>
                <div class="text-secondary" style="font-size: 12px; line-height: 1.4; color: #666;">
                    419 Lincoln Rd,<br>Peterborough, PE1 2PF
                </div>
            </div>
            <div class="col-md-4 border" style="border-color: #e5e7eb !important;">
                <div class="text-uppercase fw-bold text-muted mb-1" style="font-size: 10px; letter-spacing: 0.8px;">PETERBOROUGH</div>
                <p class="fw-extrabold text-dark mb-1" style=" font-family: Montserrat;font-weight: 800;font-size: 20px;line-height: 28.25px;letter-spacing: -0.18px;vertical-align: middle;">
                    Kennings Auto Centre
                </p>
                <div class="text-secondary" style="font-size: 12px; line-height: 1.4; color: #666;">
                    343 Eastfield Rd,<br>Peterborough, PE1 4RA
                </div>
            </div>
            <div class="col-md-4 border" style="border-color: #e5e7eb !important;">
                <div class="text-uppercase fw-bold text-muted mb-1" style="font-size: 10px; letter-spacing: 0.8px;">DOGSTHORPE</div>
                <p class="fw-extrabold text-dark mb-1" style=" font-family: Montserrat;font-weight: 800;font-size: 20px;line-height: 28.25px;letter-spacing: -0.18px;vertical-align: middle;">
                    HiQ Tyres & Autocare
                </p>
                <div class="text-secondary" style="font-size: 12px; line-height: 1.4; color: #666;">
                    7 Welland Rd, Dogsthorpe,<br>Peterborough, PE1 3SA
                </div>
            </div>
            <div class="col-md-4 border" style="border-color: #e5e7eb !important;">
                <div class="text-uppercase fw-bold text-muted mb-1" style="font-size: 10px; letter-spacing: 0.8px;">PETERBOROUGH</div>
                <p class="fw-extrabold text-dark mb-1" style=" font-family: Montserrat;font-weight: 800;font-size: 20px;line-height: 28.25px;letter-spacing: -0.18px;vertical-align: middle;">
                    HiQ Tyres & Autocare
                </p>
                <div class="text-secondary" style="font-size: 12px; line-height: 1.4; color: #666;">
                    Unit 1 Maskew Avenue,<br>Peterborough, PE1 2AS
                </div>
            </div>
            <div class="col-md-4 border" style="border-color: #e5e7eb !important;">
                <div class="text-uppercase fw-bold text-muted mb-1" style="font-size: 10px; letter-spacing: 0.8px;">HUNTINGDON</div>
                <p class="fw-extrabold text-dark mb-1" style=" font-family: Montserrat;font-weight: 800;font-size: 20px;line-height: 28.25px;letter-spacing: -0.18px;vertical-align: middle;">
                    HiQ Tyres & Autocare
                </p>
                <div class="text-secondary" style="font-size: 12px; line-height: 1.4; color: #666;">
                    Nursery Rd,<br>Huntingdon, PE29 3RJ
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>

{{-- 9. WHAT OUR CUSTOMERS SAY (SLIDER) --}}
<section class="py-5" style="background: #F2F2F4 !important;">
<div class="container py-4">
<div class="text-center mb-5">
    <h2 class="display-4 fw-extrabold text-dark mb-0" style="font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
        WHAT OUR CUSTOMERS SAY
    </h2>
</div>

<div class="home_reviews_slider_wrap position-relative">
    <div class="home_reviews_carousel">
        {{-- Review 1 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Fantastic work on my BMW. Needed an MOT and they fitted me in the same day. Got my car back within 2 hours after they sorted the tyres, so I was good to go.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    AMINATOU SMART
                </div>
            </div>
        </div>

        {{-- Review 2 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    They're always so polite, professional and honest about their ability to help. They've even done small favours that have gone above and beyond what I would have expected.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    ABE THOMAS
                </div>
            </div>
        </div>

        {{-- Review 3 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Took my car in for an MOT, they were very accommodating and efficient with their work. Good prices and an overall top service.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    ALEX GRIFFIN
                </div>
            </div>
        </div>

        {{-- Review 4 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Excellent service from the team at Smartfit Autos. Booked full servicing and MOT online. Fast turnaround, transparent pricing, and polite staff.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    DAVID MILLER
                </div>
            </div>
        </div>

        {{-- Review 5 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Brilliant garage! Had brake repair and disc replacements completed on the same day without any hassle. Highly recommend their experienced technicians.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    SARAH JENKINS
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <button type="button" class="btn btn-light rounded-circle d-flex align-items-center justify-content-center p-0 reviews_arrow_left" style="width: 42px; height: 42px; border: 1px solid #ddd; background: #fff; cursor: pointer; transition: all 0.2s ease;">
        <i class="fa-solid fa-arrow-left text-dark small"></i>
    </button>
    <button type="button" class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center p-0 reviews_arrow_right" style="width: 42px; height: 42px; background-color: #ED1E24; border-color: #ED1E24; cursor: pointer; transition: all 0.2s ease;">
        <i class="fa-solid fa-arrow-right text-white small"></i>
    </button>
</div>
</div>
</section>

<style>
.home_reviews_carousel .slick-track {
display: flex !important;
}
.home_reviews_carousel .slick-slide {
height: inherit !important;
display: flex !important;
}
.home_reviews_carousel .slick-slide > div {
display: flex;
width: 100%;
}
.reviews_arrow_left:hover {
background: #f0f0f0 !important;
border-color: #bbb !important;
}
.reviews_arrow_right:hover {
background: #c41019 !important;
border-color: #c41019 !important;
}
</style>

<script>
(function() {
function initReviewsSlider() {
if (window.jQuery && jQuery.fn.slick && jQuery('.home_reviews_carousel').length) {
    if (!jQuery('.home_reviews_carousel').hasClass('slick-initialized')) {
        jQuery('.home_reviews_carousel').slick({
            dots: false,
            arrows: true,
            prevArrow: '.reviews_arrow_left',
            nextArrow: '.reviews_arrow_right',
            infinite: true,
            autoplay: true,
            autoplaySpeed: 3500,
            speed: 600,
            slidesToShow: 3,
            slidesToScroll: 1,
            pauseOnHover: true,
            pauseOnFocus: false,
            swipeToSlide: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
}
}

if (document.readyState === 'complete' || document.readyState === 'interactive') {
setTimeout(initReviewsSlider, 100);
} else {
document.addEventListener('DOMContentLoaded', initReviewsSlider);
}
window.addEventListener('load', initReviewsSlider);
})();
</script>

{{-- 10. WHY CHOOSE US --}}
<section class="py-5 bg-white">
<div class="container py-4">
<div class="text-center mb-5">
    <h2 class="display-4 fw-extrabold text-dark mb-0" style=" font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
        WHY CHOOSE US
    </h2>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="p-4 rounded-3 h-100" style="background-color: #EEF2F6;">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="fw-extrabold" style="color: #ED1E24; font-size: 20px; font-weight: 900;">01</span>
                <h3 class="fw-bold text-dark mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;text-align: center;vertical-align: middle;text-transform: uppercase !important;">
                    FAST TURNAROUND
                </h3>
            </div>
            <p class="text-secondary fs-5 mb-0" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
                We take immense pride in providing services with absolutely no delays.
            </p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-4 rounded-3 h-100" style="background-color: #EEF2F6;">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="fw-extrabold" style="color: #ED1E24; font-size: 20px; font-weight: 900;">02</span>
                <h3 class="fw-bold text-dark mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;text-align: center;vertical-align: middle;text-transform: uppercase !important;">
                    HIGH QUALITY
                </h3>
            </div>
            <p class="text-secondary fs-5 mb-0" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
                At Kennings Central vehicle service centre, we believe that excellence is not an option; it's a standard.
            </p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-4 rounded-3 h-100" style="background-color: #EEF2F6;">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="fw-extrabold" style="color: #ED1E24; font-size: 20px; font-weight: 900;">03</span>
                <h3 class="fw-bold text-dark mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;text-align: center;vertical-align: middle;text-transform: uppercase !important;">
                    PREMIUM SUPPORT
                </h3>
            </div>
            <p class="text-secondary fs-5 mb-0" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
                Our dedication to providing exceptional service goes beyond the ordinary.
            </p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-4 rounded-3 h-100" style="background-color: #EEF2F6;">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="fw-extrabold" style="color: #ED1E24; font-size: 15px; font-weight: 900;">04</span>
                <h3 class="fw-bold text-dark mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;text-align: center;vertical-align: middle;text-transform: uppercase !important;">
                    AFFORDABLE RATES
                </h3>
            </div>
            <p class="text-secondary fs-5 mb-0" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
                Our goal is to offer competitive pricing without compromising on the quality of our offerings.
            </p>
        </div>
    </div>
</div>
</div>
</section>

{{-- 11. GET IN TOUCH --}}
<section class="position-relative text-white py-5" style="background-image: url('{{ asset('storage/home/image (13).jpg') }}'); background-size: cover; background-position: center; min-height: 500px; display: flex; align-items: center;">
<div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.8); z-index: 1;"></div>
<div class="container position-relative py-4" style="z-index: 2;">
<div class="text-center mb-5">
    <p class="display-5 fw-extrabold text-uppercase text-white mb-0" style="font-weight: 900; letter-spacing: 1px;">
        GET IN TOUCH
    </p>
</div>

<div class="row g-4 justify-content-center text-start">
    <div class="col-md-3 d-none d-lg-block"></div>
    <div class="col-md-3 mt-0 mt-lg-5">
        <div class="mb-0">
            <p style="color: #ED1E24;  font-family: Mulish;font-weight: 900 !important;font-size: 20px;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;" class="fw-bold mb-1">
                Mailing Address
            </p>
            <p class="text-white mb-0 fs-6" style="font-weight: 500;">7 Welland Road, Dogsthorpe , PE1 3SA</p>
        </div>
    </div>
    <div class="col-md-1 d-none d-lg-block"></div>
    <div class="col-md-2 mt-0 mt-lg-5">
        <div class="mb-0">
            <p style="color: #ED1E24;  font-family: Mulish;font-weight: 900 !important;font-size: 20px;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;" class="fw-bold mb-1">
                Email Address
            </p>
            <p class="text-white mb-0 fs-6" style="font-weight: 500;">info@smartfitautos.co.uk</p>
        </div>
    </div>
    <div class="col-md-3 d-none d-lg-block"></div>
    <div class="col-md-3 d-none d-lg-block"></div>
    <div class="col-md-3 mt-0 mt-lg-5">
        <div class="mb-0">
            <p style="color: #ED1E24;  font-family: Mulish;font-weight: 900 !important;font-size: 20px;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;" class="fw-bold mb-1">
                Phone Number
            </p>
            <p class="text-white mb-0 fs-6" style="font-weight: 500;">01733 569998</p>
        </div>
    </div>
    <div class="col-md-1 d-none d-lg-block"></div>
    <div class="col-md-2 mt-0 mt-lg-5">
        <div class="mb-0">
            <p style="color: #ED1E24;  font-family: Mulish;font-weight: 900 !important;font-size: 20px;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;" class="fw-bold mb-1">
                Socials
            </p>
            <p class="text-white mb-0 fs-6" style="font-weight: 500;">@reallygreatsite</p>
        </div>
    </div>
    <div class="col-md-3 d-none d-lg-block"></div>
</div>
</div>
</section>

@elseif($currentSlug === 'fleet-and-contract-work')
{{-- ============================================================
FLEET MAIN PAGE — full inline redesign
No new file, no new route, no new controller.
This is the existing frontend/index.blade.php modified.
============================================================ --}}
@php
$fmTestimonials = App\Models\Testimonial::where('published', 1)->take(3)->get();
$fmImg1 = asset('storage/Fleet/0179c8049ba4733b22e6ce3cd53adf804165c9cb.jpg');
$fmImg2 = asset('storage/Fleet/5175e0526323fdbfadee58853c910616464d8f19.jpg');
$fmImg3 = asset('storage/Fleet/8111bdcf3c9f2cbdbba1c5d1a667b22b527f71a0.jpg');
$fmMap  = asset('storage/Fleet/3677237b4ad144fd1f5ffaa1482464466f659bc0.png');
@endphp

<style>
/* ============================================================
FLEET PAGE — SCOPED STYLES (prefix fm-)
============================================================ */
/* BUTTONS */
.fm-btn-red, .fm-btn-outline, .fm-btn-dk{position:relative!important;box-shadow:none!important;outline:none!important;-webkit-clip-path:none!important;clip-path:none!important}
.fm-btn-red::before,.fm-btn-red::after,
.fm-btn-outline::before,.fm-btn-outline::after,
.fm-btn-dk::before,.fm-btn-dk::after{display:none!important;content:none!important;opacity:0!important}

.fm-btn-red{background-color:#ED1E24!important;border:1.5px solid #ED1E24!important;color:#fff!important;border-radius:100px!important;padding:20px 28px!important;font-size:13px!important;font-weight:800!important;letter-spacing:.5px!important;transition:all .2s ease!important}
.fm-btn-red:hover{background-color:#c41019!important;border-color:#c41019!important;color:#fff!important}
.fm-btn-outline{background:transparent!important;border:1.5px solid rgba(255,255,255,.4)!important;color:#fff!important;border-radius:100px!important;padding:20px 24px!important;font-size:13px!important;font-weight:700!important;letter-spacing:.5px!important;transition:all .2s ease!important}
.fm-btn-outline:hover{border-color:#fff!important;background:rgba(255,255,255,.1)!important;color:#fff!important}
.fm-btn-dk{background:transparent!important;border:2px solid #222!important;color:#222!important;transition:all .2s}
.fm-btn-dk:hover{background:#222!important;color:#fff!important;border-color:#222!important}

/* HERO */
.fm-hero{background:#0d0d0f;background:linear-gradient(135deg,#070708 0%,#111114 50%,#1b0d10 100%);min-height: 600px;display:flex;align-items:center;padding:50px 0;position:relative;overflow:hidden}
.fm-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 82% 50%,rgba(237,30,36,.22) 0%,rgba(237,30,36,.04) 45%,transparent 70%);pointer-events:none}
.fm-hero-title{font-size:clamp(2.2rem,3.8vw,3.6rem);font-weight:900;line-height:1.06;letter-spacing:-.8px;text-transform:uppercase;color:#fff;margin-bottom:20px}
.fm-hero-desc{color:rgba(255,255,255,.76);font-size:14.5px;line-height:1.72;max-width:580px;margin-bottom:28px}
.fm-hero-feats{display:flex;gap:32px;flex-wrap:wrap;margin-top:24px}
.fm-hero-feats span{color:rgba(255,255,255,.88);font-weight:700;font-size:12px;letter-spacing:1px;text-transform:uppercase;display:flex;align-items:center;gap:8px}
.fm-hero-feats span i{color:#ED1E24;font-size:14px}

/* HEALTH CARD */
.fm-health-wrap{position:relative;display:inline-flex;justify-content:center;align-items:center}
.fm-health-wrap::before{content:'';position:absolute;width:420px;height:420px;border-radius:50%;border:1px dashed rgba(255,255,255,.14);top:50%;left:50%;transform:translate(-50%,-50%);pointer-events:none}
.fm-card-health{background:#1b1b1b;border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:26px 24px;position:relative;z-index:1;width:320px;text-align:left;box-shadow:0 20px 40px rgba(0,0,0,.7)}
.fm-card-health::before{content:'';position:absolute;top:-35px;right:-35px;width:120px;height:120px;background:radial-gradient(circle,rgba(237,30,36,.15) 0%,transparent 70%);border-radius:50%}
.fm-hlabel{font-size:9.5px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.38)}
.fm-hlive{display:inline-flex;align-items:center;gap:5px;font-size:9.5px;font-weight:700;color:#4caf50;letter-spacing:1px;text-transform:uppercase}
.fm-hlive::before{content:'';width:7px;height:7px;border-radius:50%;background:#4caf50;display:inline-block;animation:fmPulse 1.5s infinite}
@keyframes fmPulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.45;transform:scale(1.35)}}
.fm-radial{position:relative;width:112px;height:112px;margin:0 auto}
.fm-radial svg{transform:rotate(-90deg)}
.fm-radial-inner{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center}
.fm-radial-pct{font-size:27px;font-weight:900;color:#fff;line-height:1}
.fm-radial-sub{font-size:8.5px;color:rgba(255,255,255,.45);letter-spacing:1px;text-transform:uppercase}
.fm-hrow{display:flex;justify-content:space-between;align-items:center;border-top:1px solid rgba(255,255,255,.06);padding:9px 0;font-size:12px}
.fm-hrow span:first-child{color:rgba(255,255,255,.58)}
.fm-pass{color:#4caf50;font-weight:700;font-size:11px}
.fm-flag{color:#ff9800;font-weight:700;font-size:11px}

/* TOP BAR */
.fm-topbar{height:4px;background:linear-gradient(90deg,#ED1E24,#ff6b6b)}

/* SERVICES */
.fm-services{background:#fff;padding:82px 0}
.fm-scard{border:1px solid #e4e4e4;border-radius:10px;padding:30px 26px;height:100%;background:#fff;transition:box-shadow .25s}
/*.fm-scard:hover{box-shadow:0 8px 32px rgba(0,0,0,.08)}*/
.fm-scard-title{font-size:17px;font-weight:900;text-transform:uppercase;letter-spacing:.4px;color:#111;margin-bottom:0;line-height:1.2}
.fm-sdiv{height:3px;background:#ED1E24;border-radius:2px;margin:14px 0 20px}
.fm-scard ul{list-style:none;padding:0;margin:0}
.fm-scard ul li, .fm-bcard ul li{display:flex;align-items:flex-start;gap:10px;padding:6px 0;font-size:18px !important;color:#444;border-bottom:1px solid #f4f4f4}
.fm-scard ul li:last-child{border-bottom:none}
.fm-scard ul li i{
color: #ED1E24;
font-size: 10px;
margin-top: 3px;
flex-shrink: 0;
background: #E31E261A;
width: 20px;
height: 20px;
line-height: 20px;
text-align: center;
border-radius: 50%;
}

/* HOW IT WORKS */
.fm-how{background:#f6f6f6;padding:82px 0}
.fm-stepnum{width:42px;height:42px;border-radius:50%;border:2px solid #ED1E24;color:#ED1E24;font-weight:800;font-size:15px;display:flex;align-items:center;justify-content:center;margin-bottom:16px}
.fm-steptitle{font-size:15.5px;font-weight:800;text-transform:uppercase;letter-spacing:.3px;margin-bottom:9px;color:#111}
.fm-stepdesc{font-size:13px;color:#666;line-height:1.65}
.fm-hcta{background:#fff;border:1px solid #e4e4e4;border-radius:10px;padding:22px 28px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:18px;margin-top:50px}
.fm-hcta-icon{width:44px;height:44px;border-radius:50%;background:rgba(237,30,36,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.fm-hcta-icon i{color:#ED1E24;font-size:17px}

/* DARK CTA */
.fm-dcta{position:relative;background:#111;padding:100px 0;overflow:hidden}
.fm-dcta-bg{position:absolute;inset:0;background-size:cover;background-position:center;opacity:.33}
.fm-dcta-inner{position:relative;z-index:2;text-align:center}
.fm-dcta-title{font-size:clamp(1.9rem,4vw,3.1rem);font-weight:900;text-transform:uppercase;color:#fff;line-height:1.08;margin-bottom:18px}
.fm-dcta-desc{color:rgba(255,255,255,.72);font-size:16px;margin-bottom:36px;font-weight:500}

/* RELIABLE */
.fm-reliable{background:#fff;padding:82px 0}
.fm-rel-title{font-size:clamp(1.65rem,3.5vw,2.55rem);font-weight:900;text-transform:uppercase;letter-spacing:-.3px;text-align:center;color:#111;margin-bottom:46px;line-height:1.08}
.fm-rel-text p{font-size:14px;color:#555;line-height:1.82;margin-bottom:17px}
.fm-rel-img{border-radius:12px;overflow:hidden;height:340px}
.fm-rel-img img{width:100%;height:100%;object-fit:cover}

/* BENEFITS */
.fm-benefits{background:#f6f6f6;padding:82px 0}
.fm-bcard{background:#fff;border:1px solid #e4e4e4;border-radius:12px;padding:30px 26px;height:100%}
.fm-bcard-title{font-size:14.5px;font-weight:800;text-transform:uppercase;letter-spacing:.5px;margin-bottom:18px;color:#111}
.fm-bcard ul{list-style:none;padding:0;margin:0}
.fm-bcard ul li{display:flex;align-items:flex-start;gap:12px;padding:9px 0;font-size:14px;color:#444;border-bottom:1px solid #f0f0f0}
.fm-bcard ul li:last-child{border-bottom:none}
.fm-bcard ul li::before{content:'—';color:#ED1E24;font-weight:700;flex-shrink:0}

/* WHICH BIZ */
.fm-biz{background:#fff;padding:82px 0}
.fm-bizcard{border:1px solid #e6e6e6;border-radius:10px;padding:20px 16px;background:#fff;transition:box-shadow .2s,transform .2s;height:100%}
.fm-bizcard:hover{box-shadow:0 6px 22px rgba(0,0,0,.09);transform:translateY(-2px)}
.fm-bizicon{width:46px;height:46px;background:rgba(237,30,36,.09);border-radius:8px;display:flex;align-items:center;justify-content:center;margin-bottom:13px}
.fm-bizicon i{color:#ED1E24;font-size:19px}
.fm-bizcard-title{font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.3px;color:#111}

/* WHY CHOOSE */
.fm-why{background:#fff;padding:60px 0}
.fm-wcard{background:#EEF2F6;border-radius:8px;padding:18px 22px;height:100%;border:none;transition:transform .2s}
.fm-wcard:hover{transform:translateY(-2px)}
.fm-wheader{display:flex;align-items:center;gap:8px;margin-bottom:6px}
.fm-wnum{font-size:13.5px;font-weight:800;color:#ED1E24}
.fm-wtitle{font-size:13.5px;font-weight:800;text-transform:uppercase;letter-spacing:.3px;color:#111;margin:0}
.fm-wdesc{font-size:12.5px;color:#555;line-height:1.6;margin:0}

/* AREAS */
.fm-areas{background:#fff;padding:82px 0}
.fm-abtn{display:inline-block;padding:7px 16px;border:1.5px solid #ddd;border-radius:6px;font-size:13px;font-weight:600;color:#444!important;background:#fff!important;cursor:pointer;transition:all .2s;text-decoration:none;outline:none;-webkit-appearance:none;appearance:none;line-height:1.4}
.fm-abtn:hover,.fm-abtn.active{background:#ED1E24!important;border-color:#ED1E24!important;color:#fff!important}
.fm-abtn:focus{outline:none;box-shadow:none}
/* Leaflet map — override Bootstrap dark theme so tiles render correctly */
#fmAreaMap{background:#e8e0d8!important;color-scheme:light}
#fmAreaMap img,#fmAreaMap canvas{filter:none!important;max-width:none!important}
#fmAreaMap .leaflet-tile-container img{filter:none!important;display:block!important}
#fmAreaMap .leaflet-pane{z-index:auto!important}
.fm-map-pin svg{display:block}


/* TESTIMONIALS */
.fm-testi{background:#f6f6f6;padding:82px 0}
.fm-tcard{background:#fff;border:1px solid #e6e6e6;border-radius:12px;padding:26px;height:100%;display:flex;flex-direction:column}
.fm-stars{color:#f5a623;font-size:13px;margin-bottom:13px}
.fm-ttext{font-size:14px;color:#555;line-height:1.7;flex-grow:1;font-style:italic;margin-bottom:16px}
.fm-tauthor{font-size:11.5px;font-weight:800;text-transform:uppercase;letter-spacing:.5px;color:#111}

/* FAQ */
.fm-faq{background:#fff;padding:82px 0}
.fm-fitem{border-bottom:1px solid #e6e6e6}
.fm-fitem:first-child{border-top:1px solid #e6e6e6}
.fm-fq{display:flex;justify-content:space-between;align-items:center;padding:20px 0;cursor:pointer;font-size:16.5px;font-weight:700;color:#111;user-select:none;gap:16px;transition:color .2s;text-transform:none !important}
.fm-fq:hover{color:#ED1E24}
.fm-ficon{width:32px;height:32px;border:1.5px solid #ddd;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px;line-height:1;color:#666;transition:all .25s ease;font-weight:400;user-select:none}
.fm-fq:hover .fm-ficon{border-color:#ED1E24;color:#ED1E24}
.fm-ficon::before{content:'+';display:block;line-height:1}
.fm-fitem.open .fm-ficon{background:#ED1E24 !important;border-color:#ED1E24 !important;color:#fff !important;transform:none !important}
.fm-fitem.open .fm-ficon::before{content:'−' !important;font-size:22px;font-weight:700}
.fm-fa{display:none;padding:0 40px 22px 0;font-size:14.5px;color:#666;line-height:1.7}
.fm-fitem.open .fm-fa{display:block}

/* FINAL CTA */
.fm-fcta{position:relative;background:#111;padding:100px 0;overflow:hidden}
.fm-fcta-bg{position:absolute;inset:0;background-size:cover;background-position:center;opacity:.28}
.fm-fcta-inner{position:relative;z-index:2;text-align:center}

/* SHARED */
.fm-sec-title{font-size:clamp(1.75rem,3.5vw,2.65rem);font-weight:900;text-transform:uppercase;letter-spacing:-.3px;color:#111;line-height:1.08}
.fm-sec-sub{font-size:15px;color:#666;max-width:680px;margin:14px auto 0;line-height:1.72}

@media(max-width:991px){
.fm-hero{padding:40px 0;min-height:auto}
.fm-card-health{margin-top:28px}
.fm-hcta{flex-direction:column;text-align:center}
.fm-rel-img{height:250px}
.fm-dcta,.fm-fcta{padding:72px 0}
}
@media(max-width:767px){
.fm-hero{min-height:auto;padding:44px 0}
.fm-hero-title{font-size:2rem;font-weight: 800;line-height: 121%;letter-spacing: -0.42px;}
.fm-dcta-title,.fm-fcta .fm-dcta-title{font-size:1.6rem}
.fs-5 {font-size: 18px !important;}
}
</style>

{{-- ================================================
SECTION 1 — FLEET HERO
================================================ --}}
<section class="fm-hero">
<div class="container position-relative" style="z-index:2">
<div class="row align-items-center g-4">
<div class="col-lg-8">
<h1 class="fm-hero-title">FLEET VEHICLE SERVICING AND MAINTENANCE</h1>
<p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Keep your business vehicles running efficiently with expert fleet servicing, maintenance, and repairs. From routine checks to complex repairs, our experienced technicians help reduce downtime, improve reliability, and keep your cars, vans, and commercial vehicles safe and road-ready.</p>
<div class="d-flex flex-wrap align-items-center gap-3 mb-4">
  <a href="tel:01733569998" class="btn fm-btn-red text-uppercase">CALL NOW 01733 569998</a>
  <a href="/booking/order" class="btn fm-btn-outline text-uppercase">BOOK FLEET SERVICING &rarr;</a>
</div>
<div class="fm-hero-feats">
  <span class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;"><i class="fa-solid fa-check"></i>ALL MAKES &amp; MODELS</span>
  <span class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;"><i class="fa-solid fa-check"></i>PRIORITY FLEET SCHEDULING</span>
</div>
</div>
<div class="col-lg-4 text-center">
<div class="fm-health-wrap">
  <div class="fm-card-health">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <span class="fm-hlabel">Fleet Vehicle Health</span>
      <span class="fm-hlive">LIVE</span>
    </div>
    <div class="fm-radial mb-3">
      <svg width="112" height="112" viewBox="0 0 112 112">
        <circle cx="56" cy="56" r="48" fill="none" stroke="rgba(255,255,255,0.07)" stroke-width="9"/>
        <circle cx="56" cy="56" r="48" fill="none" stroke="#ED1E24" stroke-width="9"
          stroke-dasharray="301.59" stroke-dashoffset="39.21" stroke-linecap="round"/>
      </svg>
      <div class="fm-radial-inner">
        <div class="fm-radial-pct">87%</div>
        <div class="fm-radial-sub">Fleet Ready</div>
      </div>
    </div>
    <div>
      <div class="fm-hrow"><span>Engine &amp; Fluids</span><span class="fm-pass">Passed</span></div>
      <div class="fm-hrow"><span>Brakes &amp; Tyres</span><span class="fm-pass">Passed</span></div>
      <div class="fm-hrow"><span>Diagnostics</span><span class="fm-flag">Flagged</span></div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</section>



{{-- ================================================
SECTION 2 — OUR FLEET VEHICLE SERVICES
================================================ --}}
<section class="fm-services">
<div class="container">
<div class="text-center mb-5">
<h2 class="display-4 fw-extrabold text-dark" style=" font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
  OUR FLEET VEHICLE SERVICES
</h2>
<p class="text-secondary fs-5 mb-4 w-75 fm-sec-sub" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;text-align:center;max-width:100%;">
    From routine maintenance to specialist repairs, we provide complete fleet servicing solutions to keep your business vehicles safe, reliable, and road-ready.
</p>
</div>
<div class="row g-4">
<div class="col-lg-4 col-md-6">
<div class="fm-scard">
    <h3 class="fw-bold mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;text-transform: uppercase !important;">
        Fleet Servicing
    </h3>
  <div class="fm-sdiv"></div>
  <ul style="font-size: 18px !important;">
    <li><i class="fa-solid fa-check"></i>Interim Vehicle Servicing</li>
    <li><i class="fa-solid fa-check"></i>Full Vehicle Servicing</li>
    <li><i class="fa-solid fa-check"></i>Manufacturer Scheduled Servicing</li>
    <li><i class="fa-solid fa-check"></i>Oil &amp; Filter Changes</li>
    <li><i class="fa-solid fa-check"></i>Fluid Level Checks &amp; Top-Ups</li>
    <li><i class="fa-solid fa-check"></i>Vehicle Health Inspections</li>
    <li><i class="fa-solid fa-check"></i>Engine &amp; Vehicle Diagnostics</li>
    <li><i class="fa-solid fa-check"></i>Battery Health Checks</li>
    <li><i class="fa-solid fa-check"></i>Tyre Pressure Checks</li>
    <li><i class="fa-solid fa-check"></i>Wheel Alignment Checks</li>
    <li><i class="fa-solid fa-check"></i>Preventative Maintenance</li>
  </ul>
</div>
</div>
<div class="col-lg-4 col-md-6">
<div class="fm-scard">
    <h3 class="fw-bold mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;text-transform: uppercase !important;">
      Fleet Vehicle Repairs
    </h3>
  <div class="fm-sdiv"></div>
  <ul>
    <li><i class="fa-solid fa-check"></i>Engine Repairs</li>
    <li><i class="fa-solid fa-check"></i>Brake Repairs</li>
    <li><i class="fa-solid fa-check"></i>Clutch Repairs</li>
    <li><i class="fa-solid fa-check"></i>Suspension Repairs</li>
    <li><i class="fa-solid fa-check"></i>Electrical System Repairs</li>
    <li><i class="fa-solid fa-check"></i>Exhaust Repairs</li>
    <li><i class="fa-solid fa-check"></i>Steering Repairs</li>
    <li><i class="fa-solid fa-check"></i>Battery Replacement</li>
    <li><i class="fa-solid fa-check"></i>Tyre Replacement &amp; Puncture Repairs</li>
    <li><i class="fa-solid fa-check"></i>Warning Light Diagnostics</li>
    <li><i class="fa-solid fa-check"></i>General Mechanical Repairs</li>
  </ul>
</div>
</div>
<div class="col-lg-4 col-md-6">
<div class="fm-scard">
    <h3 class="fw-bold mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;text-transform: uppercase !important;">
        MOT Testing &amp; Preparation
    </h3>
  <div class="fm-sdiv"></div>
  <ul>
    <li><i class="fa-solid fa-check"></i>Pre-MOT Inspections</li>
    <li><i class="fa-solid fa-check"></i>MOT Preparation Checks</li>
    <li><i class="fa-solid fa-check"></i>Vehicle Safety Inspections</li>
    <li><i class="fa-solid fa-check"></i>MOT Failure Repairs</li>
    <li><i class="fa-solid fa-check"></i>Emissions Checks</li>
    <li><i class="fa-solid fa-check"></i>Brake &amp; Suspension Checks</li>
    <li><i class="fa-solid fa-check"></i>Lighting &amp; Electrical Checks</li>
    <li><i class="fa-solid fa-check"></i>Tyre &amp; Wheel Inspections</li>
    <li><i class="fa-solid fa-check"></i>Compliance Checks</li>
    <li><i class="fa-solid fa-check"></i>Maintenance Recommendations</li>
  </ul>
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 3 — HOW FLEET ACCOUNTS WORK
================================================ --}}
<section class="fm-how">
<div class="container">
<div class="text-center mb-5">
<h2 class="display-4 fw-extrabold text-dark mb-5" style=" font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
  HOW FLEET ACCOUNTS WORK
</h2>
</div>
<div class="row g-4">
<div class="col-lg-3 col-md-6">
<div class="fm-stepnum">01</div>
<h3 class="fw-bold mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;text-transform: uppercase !important;">
    Open Your Fleet Account
</h3>
<p class="text-secondary fs-5 mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
    Set up a dedicated fleet account with our team for fast bookings, streamlined servicing, and ongoing vehicle support.
</p>
</div>
<div class="col-lg-3 col-md-6">
<div class="fm-stepnum">02</div>
<h3 class="fw-bold mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;text-transform: uppercase !important;">
    Book Your Vehicles
</h3>
<p class="text-secondary fs-5 mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
    Schedule servicing, MOTs, maintenance, or repairs at times that minimise disruption to your daily business operations.
</p>
</div>
<div class="col-lg-3 col-md-6">
<div class="fm-stepnum">03</div>
<h3 class="fw-bold mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;text-transform: uppercase !important;">
    We Service &amp; Maintain Fleet
</h3>
<p class="text-secondary fs-5 mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
    Our technicians carry out professional servicing, inspections, diagnostics, and repairs to keep every vehicle road-ready.
</p>
</div>
<div class="col-lg-3 col-md-6">
<div class="fm-stepnum">04</div>
<h3 class="fw-bold mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;text-transform: uppercase !important;">
    Get Back On The Road
</h3>
<p class="text-secondary fs-5 mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
    Your vehicles are returned promptly with completed work, service records, and support for future maintenance needs.
</p>
</div>
</div>
<div class="fm-hcta">
<div class="d-flex align-items-center gap-3">
<div class="fm-hcta-icon"><i class="fa-solid fa-phone"></i></div>
<div>
  <div style="font-weight:800;font-size:15px;color:#111">Ready when you are</div>
  <div style="font-size:13px;color:#888">Speak to the Peterborough team directly.</div>
</div>
</div>
<div class="d-flex flex-wrap gap-3">
<a href="tel:01733569998" class="btn fm-btn-dk rounded-pill px-4 py-2 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.5px">CALL NOW  01733 569998</a>
<a href="/booking/order" class="btn fm-btn-red rounded-pill px-4 py-2 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.5px">BOOK YOUR CAR SERVICE</a>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 4 — DARK FLEET CTA
================================================ --}}
<section class="fm-dcta">
<div class="fm-dcta-bg" style="background-image:url('{{ $fmImg2 }}')"></div>
<div class="container">
<div class="fm-dcta-inner text-center w-100">
<p class="display-4 fw-extrabold text-white opacity-1" style="opacity: 1 !important;font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
  Keep Your Fleet Safe, <br>Compliant, And On The Road
</p>
<p class="text-secondary fs-5 mb-4 text-white opacity-1" style="opacity: 1 !important;font-family: Mulish;font-weight: 400;vertical-align: middle;">Trusted by local businesses to look after the vehicles they rely on every day.</p>
<div class="d-flex flex-wrap justify-content-center gap-3">
<a href="/contact-us" class="btn fm-btn-red rounded-pill px-5 py-3 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.8px">TALK TO OUR TEAM &rarr;</a>
<a href="tel:01733569998" class="btn fm-btn-wh rounded-pill px-5 py-3 fw-bold text-uppercase border-white" style="font-size:13px;letter-spacing:.8px">CALL NOW 01733 569998 &rarr;</a>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 5 — RELIABLE FLEET MAINTENANCE
================================================ --}}
<section class="fm-reliable">
<div class="container">
<div class="text-center mb-5 d-flex justify-content-center">
<h2 class="display-4 fw-extrabold text-dark w-75" style=" font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
    Reliable Fleet Maintenance Services For Businesses
</h2>
</div>
<div class="row align-items-center g-5">
<div class="col-lg-6">
<div class="fm-rel-text">
    <p class="text-secondary fs-5 mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
      Managing a fleet requires regular maintenance, quick repairs, and a trusted garage partner who understands your business needs.
    </p>
    <p class="text-secondary fs-5 mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
      Our fleet servicing and maintenance solutions are designed to help businesses maintain their vehicles efficiently while reducing unexpected breakdowns and costly downtime.
    </p>
    <p class="text-secondary fs-5 mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;">
      We work with businesses across different industries, providing scheduled servicing, repairs, inspections, and maintenance support for company cars, vans, and commercial vehicles.
    </p>
</div>
</div>
<div class="col-lg-6">
<div class="fm-rel-img">
  <img src="{{ $fmImg1 }}" alt="Fleet vehicle maintenance at Smartfit Autos">
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 6 — THE BENEFITS
================================================ --}}
<section class="fm-benefits">
    <div class="container">
        <div class="text-center">
            <h2 class="display-4 fw-extrabold text-dark mx-lg-3 mx-0" style=" font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
                The Benefits Of Our Fleet Maintenance Solutions
            </h2>
            <p class="text-secondary fs-5 mb-4 w-75 fm-sec-sub" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important;text-align:center;max-width:100%;">
                Keep your fleet running efficiently with a service designed to save time, reduce costs, and simplify
                vehicle maintenance for both your business and your drivers.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="fm-bcard">
                    <h3 class="fw-bold mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;text-transform: uppercase !important;">
                        For Your Business
                    </h3>
                    <ul>
                        <li>Reduced vehicle downtime</li>
                        <li>Predictable, controlled maintenance costs</li>
                        <li>One garage handling your whole fleet</li>
                        <li>Full service history &amp; compliance records kept on file</li>
                        <li>No admin hassle — we manage the scheduling</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="fm-bcard">
                    <h3 class="fw-bold mb-0" style="font-family: Mulish;font-weight: 800 !important;font-size: 25px !important;line-height: 30.4px;letter-spacing: -0.19px;vertical-align: middle;text-transform: uppercase !important;">
                        For Your Drivers
                    </h3>
                    <ul>
                        <li>Reliable, safe vehicles</li>
                        <li>Fast turnaround on repairs</li>
                        <li>Straightforward booking process</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================================================
SECTION 7 — WHICH BUSINESSES
================================================ --}}
<section class="fm-biz">
<div class="container">
<div class="text-center mb-5">
<h2 class="">Which Businesses Need Fleet<br>Maintenance?</h2>
</div>
<div class="row g-3">
<div class="col-lg-3 col-md-12 col-12">
<div class="fm-bizcard">
  <div class="fm-bizicon"><i class="fa-solid fa-truck"></i></div>
  <h3 class="fm-bizcard-title">Transport &amp; Logistics</h3>
  <p>Keep delivery vans, HGVs, and commercial vehicles road-ready with scheduled servicing, preventative maintenance, and prompt repairs.</p>
</div>
</div>
<div class="col-lg-3 col-md-12 col-12">
<div class="fm-bizcard">
  <div class="fm-bizicon"><i class="fa-solid fa-box"></i></div>
  <h3 class="fm-bizcard-title">Delivery &amp; Courier Services</h3>
  <p>Minimise unexpected breakdowns and maintain reliable deliveries with regular servicing and fast vehicle repairs.</p>
</div>
</div>
<div class="col-lg-3 col-md-12 col-12">
<div class="fm-bizcard">
  <div class="fm-bizicon"><i class="fa-solid fa-wrench"></i></div>
  <h3 class="fm-bizcard-title">Trades &amp; Contractors</h3>
  <p>Support your plumbers, electricians, builders, and other trade vehicles with dependable maintenance that keeps your team working efficiently.</p>
</div>
</div>
<div class="col-lg-3 col-md-12 col-12">
<div class="fm-bizcard">
  <div class="fm-bizicon"><i class="fa-solid fa-building"></i></div>
  <h3 class="fm-bizcard-title">Construction &amp; Engineering Businesses</h3>
  <p>Maintain vans, pickups, and commercial vehicles used on construction sites with professional servicing and repair solutions.</p>
</div>
</div>
<div class="col-lg-3 col-md-12 col-12">
<div class="fm-bizcard">
  <div class="fm-bizicon"><i class="fa-solid fa-house"></i></div>
  <h3 class="fm-bizcard-title">Property &amp; Facilities Management</h3>
  <p>Keep vehicles used for maintenance, inspections, and property services operating safely and reliably throughout the year.</p>
</div>
</div>
<div class="col-lg-3 col-md-12 col-12">
<div class="fm-bizcard">
  <div class="fm-bizicon"><i class="fa-solid fa-briefcase"></i></div>
  <h3 class="fm-bizcard-title">Sales &amp; Field Service Teams</h3>
  <p>Ensure company cars and service vehicles remain dependable for employees travelling to customer appointments and job sites.</p>
</div>
</div>
<div class="col-lg-3 col-md-12 col-12">
<div class="fm-bizcard">
  <div class="fm-bizicon"><i class="fa-solid fa-car"></i></div>
  <h3 class="fm-bizcard-title">Car Rental &amp; Vehicle Hire Companies</h3>
  <p>Regular servicing and preventative maintenance help keep rental vehicles safe, compliant, and ready for customers.</p>
</div>
</div>
<div class="col-lg-3 col-md-12 col-12">
<div class="fm-bizcard">
  <div class="fm-bizicon"><i class="fa-solid fa-store"></i></div>
  <h3 class="fm-bizcard-title">Local Businesses &amp; SMEs</h3>
  <p>Whether you have two vehicles or an entire fleet, we provide flexible maintenance solutions tailored to your business needs.</p>
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 8 — WHY CHOOSE SMARTFIT AUTOS
================================================ --}}
<section class="fm-why">
<div class="container">
<div class="text-center mb-5">
<h2 class="">WHY CHOOSE SMARTFIT AUTOS FOR<br>FLEET VEHICLE SERVICING?</h2>
</div>
<div class="row g-3">
<div class="col-md-6">
<div class="fm-wcard">
  <div class="fm-wheader">
    <span class="fm-wnum" style="color: #ED1E24; font-size: 20px; font-weight: 900;">01</span>
    <h3 class="fm-wtitle">EXPERIENCED VEHICLE TECHNICIANS</h3>
  </div>
  <p class="fm-wdesc">Our qualified technicians service and repair all types of cars, vans, and commercial vehicles using industry best practices and quality parts.</p>
</div>
</div>
<div class="col-md-6">
<div class="fm-wcard">
  <div class="fm-wheader">
    <span class="fm-wnum" style="color: #ED1E24; font-size: 20px; font-weight: 900;">02</span>
    <h3 class="fm-wtitle">REDUCED VEHICLE DOWNTIME</h3>
  </div>
  <p class="fm-wdesc">Fast diagnostics, efficient repairs, and scheduled maintenance help keep your fleet on the road and your business operating without unnecessary delays.</p>
</div>
</div>
<div class="col-md-6">
<div class="fm-wcard">
  <div class="fm-wheader">
    <span class="fm-wnum" style="color: #ED1E24; font-size: 20px; font-weight: 900;">03</span>
    <h3 class="fm-wtitle">FLEXIBLE FLEET SOLUTIONS</h3>
  </div>
  <p class="fm-wdesc">Whether you manage two vehicles or an entire fleet, we tailor servicing and maintenance plans to suit your business requirements.</p>
</div>
</div>
<div class="col-md-6">
<div class="fm-wcard">
  <div class="fm-wheader">
    <span class="fm-wnum" style="color: #ED1E24; font-size: 20px; font-weight: 900;">04</span>
    <h3 class="fm-wtitle">TRANSPARENT PRICING</h3>
  </div>
  <p class="fm-wdesc">Receive clear, upfront quotations with no hidden costs, along with honest advice before any servicing or repair work begins.</p>
</div>
</div>
<div class="col-md-6">
<div class="fm-wcard">
  <div class="fm-wheader">
    <span class="fm-wnum" style="color: #ED1E24; font-size: 20px; font-weight: 900;">05</span>
    <h3 class="fm-wtitle">PRIORITY FLEET SCHEDULING</h3>
  </div>
  <p class="fm-wdesc">Fleet customers benefit from priority booking to minimise disruption and keep vehicles serviced and returned to operation quickly.</p>
</div>
</div>
<div class="col-md-6">
<div class="fm-wcard">
  <div class="fm-wheader">
    <span class="fm-wnum" style="color: #ED1E24; font-size: 20px; font-weight: 900;">06</span>
    <h3 class="fm-wtitle">RELIABLE BUSINESS PARTNER</h3>
  </div>
  <p class="fm-wdesc">Build a long-term partnership with a trusted garage committed to keeping your fleet safe, compliant, and performing at its best.</p>
</div>
</div>
</div>
</div>
</section>
{{-- Load Leaflet from jsDelivr (reliable CDN) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css">

{{-- ================================================
SECTION 9 — AREAS (Leaflet interactive map)
================================================ --}}
<section class="fm-areas" style="background: #F2F2F4;">
<div class="container">
<div class="text-center mb-5">
<h2 class="">Fleet Vehicle Servicing Across<br>Peterborough &amp; Surrounding Areas</h2>
</div>
<div style="">
<div class="row g-5 align-items-center">
<div class="col-lg-6">
<p style="font-size:18px;color:#555;line-height:1.82;margin-bottom:26px">We provide professional fleet vehicle servicing and maintenance services across Peterborough and the surrounding areas. Whether you manage a small fleet or multiple commercial vehicles, our experienced team delivers reliable servicing, repairs, and maintenance to keep your business moving.</p>
<div class="d-flex flex-wrap gap-2">
  @php
  $mapAreas = [
      ['Peterborough', 52.5695, -0.2405],
      ['Stamford',     52.6510, -0.4810],
      ['Whittlesey',   52.5574, -0.1315],
      ['Crowland',     52.6756, -0.1661],
      ['Bourne',       52.7686, -0.3770],
      ['Huntingdon',   52.3304, -0.1867],
      ['Oundle',       52.4820, -0.4700],
      ['Sawtry',       52.4370, -0.2830],
      ['Ramsey',       52.4490, -0.1060],
      ['St Ives',      52.3270, -0.0760]
  ];
  @endphp
  @foreach($mapAreas as $idx => [$name, $lat, $lng])
  <button type="button" class="fm-abtn {{ $idx === 0 ? 'active' : '' }}" onclick="fmGoTo({{ $idx }}, this)">{{ $name }}</button>
  @endforeach
</div>
</div>
<div class="col-lg-6">
{{-- Map container: data-bs-theme="light" prevents Bootstrap dark mode from hiding tiles --}}
<div id="fmAreaMap" data-bs-theme="light"
  style="height:380px;border-radius:12px;overflow:hidden;border:1px solid #e4e4e4;">
</div>
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 10 — TESTIMONIALS
================================================ --}}
<section class="py-5" style="background: #F2F2F4 !important;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-extrabold text-dark mb-0" style="font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
                WHAT OUR CUSTOMERS SAY
            </h2>
        </div>

        <div class="home_reviews_slider_wrap position-relative">
            <div class="home_reviews_carousel">
                {{-- Review 1 --}}
                <div class="px-2 h-100">
                    <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column"
                        style="min-height: 270px; border-color: #e5e7eb !important;">
                        <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary fs-5 mb-4 flex-grow-1"
                            style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                            Fantastic work on my BMW. Needed an MOT and they fitted me in the same day. Got my car back
                            within 2 hours after they sorted the tyres, so I was good to go.
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark mt-auto"
                            style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                            AMINATOU SMART
                        </div>
                    </div>
                </div>

                {{-- Review 2 --}}
                <div class="px-2 h-100">
                    <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column"
                        style="min-height: 270px; border-color: #e5e7eb !important;">
                        <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary fs-5 mb-4 flex-grow-1"
                            style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                            They're always so polite, professional and honest about their ability to help. They've even
                            done small favours that have gone above and beyond what I would have expected.
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark mt-auto"
                            style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                            ABE THOMAS
                        </div>
                    </div>
                </div>

                {{-- Review 3 --}}
                <div class="px-2 h-100">
                    <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column"
                        style="min-height: 270px; border-color: #e5e7eb !important;">
                        <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary fs-5 mb-4 flex-grow-1"
                            style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                            Took my car in for an MOT, they were very accommodating and efficient with their work. Good
                            prices and an overall top service.
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark mt-auto"
                            style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                            ALEX GRIFFIN
                        </div>
                    </div>
                </div>

                {{-- Review 4 --}}
                <div class="px-2 h-100">
                    <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column"
                        style="min-height: 270px; border-color: #e5e7eb !important;">
                        <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary fs-5 mb-4 flex-grow-1"
                            style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                            Excellent service from the team at Smartfit Autos. Booked full servicing and MOT online.
                            Fast turnaround, transparent pricing, and polite staff.
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark mt-auto"
                            style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                            DAVID MILLER
                        </div>
                    </div>
                </div>

                {{-- Review 5 --}}
                <div class="px-2 h-100">
                    <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column"
                        style="min-height: 270px; border-color: #e5e7eb !important;">
                        <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary fs-5 mb-4 flex-grow-1"
                            style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                            Brilliant garage! Had brake repair and disc replacements completed on the same day without
                            any hassle. Highly recommend their experienced technicians.
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark mt-auto"
                            style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                            SARAH JENKINS
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button"
                class="btn btn-light rounded-circle d-flex align-items-center justify-content-center p-0 reviews_arrow_left"
                style="width: 42px; height: 42px; border: 1px solid #ddd; background: #fff; cursor: pointer; transition: all 0.2s ease;">
                <i class="fa-solid fa-arrow-left text-dark small"></i>
            </button>
            <button type="button"
                class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center p-0 reviews_arrow_right"
                style="width: 42px; height: 42px; background-color: #ED1E24; border-color: #ED1E24; cursor: pointer; transition: all 0.2s ease;">
                <i class="fa-solid fa-arrow-right text-white small"></i>
            </button>
        </div>
    </div>
</section>

<style>
    .home_reviews_carousel .slick-track {
        display: flex !important;
    }

    .home_reviews_carousel .slick-slide {
        height: inherit !important;
        display: flex !important;
    }

    .home_reviews_carousel .slick-slide>div {
        display: flex;
        width: 100%;
    }

    .reviews_arrow_left:hover {
        background: #f0f0f0 !important;
        border-color: #bbb !important;
    }

    .reviews_arrow_right:hover {
        background: #c41019 !important;
        border-color: #c41019 !important;
    }
</style>

<script>
    (function () {
        function initReviewsSlider() {
            if (window.jQuery && jQuery.fn.slick && jQuery('.home_reviews_carousel').length) {
                if (!jQuery('.home_reviews_carousel').hasClass('slick-initialized')) {
                    jQuery('.home_reviews_carousel').slick({
                        dots: false,
                        arrows: true,
                        prevArrow: '.reviews_arrow_left',
                        nextArrow: '.reviews_arrow_right',
                        infinite: true,
                        autoplay: true,
                        autoplaySpeed: 3500,
                        speed: 600,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        pauseOnHover: true,
                        pauseOnFocus: false,
                        swipeToSlide: true,
                        responsive: [
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            }
                        ]
                    });
                }
            }
        }

        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(initReviewsSlider, 100);
        } else {
            document.addEventListener('DOMContentLoaded', initReviewsSlider);
        }
        window.addEventListener('load', initReviewsSlider);
    })();
</script>

{{-- ================================================
SECTION 11 — FAQ
================================================ --}}
<section class="fm-faq">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="text-center mb-5">
                  <h2 class="fm-sec-title">FREQUENTLY ASKED QUESTIONS</h2>
                </div>
                <div class="fm-fitem open" id="fmF1">
                  <h3 class="fm-fq" onclick="fmFaq('fmF1')" style="text-transform: none !important;"><span>What is fleet vehicle servicing?</span><div class="fm-ficon"></div></h3>
                  <div class="fm-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Fleet vehicle servicing involves maintaining multiple business vehicles through regular servicing, inspections, repairs, and preventative maintenance to keep vehicles reliable and roadworthy.</p></div>
                </div>
                <div class="fm-fitem" id="fmF2">
                  <h3 class="fm-fq" onclick="fmFaq('fmF2')" style="text-transform: none !important;"><span>Do you service small business fleets?</span><div class="fm-ficon"></div></h3>
                  <div class="fm-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Yes, we provide fleet servicing and maintenance support for businesses with small and growing vehicle fleets.</p></div>
                </div>
                <div class="fm-fitem" id="fmF3">
                  <h3 class="fm-fq" onclick="fmFaq('fmF3')" style="text-transform: none !important;"><span>What vehicles can you maintain?</span><div class="fm-ficon"></div></h3>
                  <div class="fm-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We service cars, vans, and commercial vehicles used by businesses across different industries.</p></div>
                </div>
                <div class="fm-fitem" id="fmF4">
                  <h3 class="fm-fq" onclick="fmFaq('fmF4')" style="text-transform: none !important;"><span>How often should fleet vehicles be serviced?</span><div class="fm-ficon"></div></h3>
                  <div class="fm-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Fleet vehicles should generally follow manufacturer servicing intervals, although frequency may vary depending on mileage, vehicle usage, and operating conditions.</p></div>
                </div>
                <div class="fm-fitem" id="fmF5">
                  <h3 class="fm-fq" onclick="fmFaq('fmF5')" style="text-transform: none !important;"><span>Can you help reduce fleet downtime?</span><div class="fm-ficon"></div></h3>
                  <div class="fm-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Yes. Regular maintenance and early identification of issues can help reduce unexpected breakdowns and keep vehicles available for business use.</p></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================================================
SECTION 12 — FINAL CTA
================================================ --}}
<section class="fm-fcta">
<div class="fm-fcta-bg" style="background-image:url('{{ $fmImg3 }}')"></div>
<div class="container">
<div class="fm-fcta-inner">
<p class="display-4 fw-extrabold text-white opacity-1" style="opacity: 1 !important;font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">Looking For A Trusted Fleet<br>Maintenance Partner?</h2>
<p class="text-secondary mb-4 text-white opacity-1" style="opacity: 1 !important;font-family: Mulish;font-weight: 400;vertical-align: middle; font-size: 18px;">Reduce downtime, simplify vehicle maintenance, and keep your fleet operating efficiently with expert garage services.</p>
<div class="d-flex flex-wrap justify-content-center gap-3">
<a href="/contact-us" class="btn fm-btn-red rounded-pill px-5 py-3 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.8px">CONTACT OUR FLEET TEAM</a>
<a href="tel:01733569998" class="btn fm-btn-wh rounded-pill px-5 py-3 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.8px">CALL NOW 01733 569998</a>
</div>
</div>
</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>
<script>
/* ---- Fleet FAQ accordion ---- */
function fmFaq(id){
var el=document.getElementById(id);
var was=el.classList.contains('open');
document.querySelectorAll('.fm-fitem').forEach(function(i){i.classList.remove('open')});
if(!was) el.classList.add('open');
}

/* ---- Fleet interactive map: Leaflet + CartoDB Voyager tiles ---- */
(function(){
var locs = [
{name:"Peterborough", lat:52.5695, lng:-0.2405},
{name:"Stamford",     lat:52.6510, lng:-0.4810},
{name:"Whittlesey",   lat:52.5574, lng:-0.1315},
{name:"Crowland",     lat:52.6756, lng:-0.1661},
{name:"Bourne",       lat:52.7686, lng:-0.3770},
{name:"Huntingdon",   lat:52.3304, lng:-0.1867},
{name:"Oundle",       lat:52.4820, lng:-0.4700},
{name:"Sawtry",       lat:52.4370, lng:-0.2830},
{name:"Ramsey",       lat:52.4490, lng:-0.1060},
{name:"St Ives",      lat:52.3270, lng:-0.0760}
];
var map, markers = [];
function initFleetMap(){
var el = document.getElementById('fmAreaMap');
if(!el || el._leaflet_id || typeof L === 'undefined') return;
map = L.map('fmAreaMap', {scrollWheelZoom: false, zoomControl: true}).setView([52.5695, -0.2405], 10);
L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/">CARTO</a>',
subdomains: 'abcd',
maxZoom: 19
}).addTo(map);
var redPin = L.divIcon({
className: 'fm-map-pin',
html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 42" width="28" height="42"><path d="M14 0C8.48 0 4 4.48 4 10c0 7.5 10 26 10 26s10-18.5 10-26C24 4.48 19.52 0 14 0z" fill="#ED1E24"/><circle cx="14" cy="10" r="5.5" fill="#fff"/></svg>',
iconSize:   [28, 42],
iconAnchor: [14, 42],
popupAnchor:[0, -42]
});
locs.forEach(function(l, i){
var m = L.marker([l.lat, l.lng], {icon: redPin}).addTo(map)
       .bindPopup('<b style="color:#ED1E24;font-size:15px;">'+l.name+'</b><br><small style="color:#555;">Smartfit Autos Fleet Servicing Area</small>');
m.on('click', function(){
var btns = document.querySelectorAll('.fm-abtn');
btns.forEach(function(b){ b.classList.remove('active'); });
if(btns[i]) btns[i].classList.add('active');
});
markers.push(m);
});
setTimeout(function(){ if(map) map.invalidateSize(); }, 300);
}
window.fmGoTo = function(idx, btn) {
document.querySelectorAll('.fm-abtn').forEach(function(b){ b.classList.remove('active'); });
if(btn) btn.classList.add('active');
if(map && locs[idx]){
map.flyTo([locs[idx].lat, locs[idx].lng], 12, {animate: true, duration: 0.8});
if(markers[idx]) markers[idx].openPopup();
}
};
if(document.readyState==='complete'){ setTimeout(initFleetMap, 150); }
else { window.addEventListener('load', function(){ setTimeout(initFleetMap, 150); }); }
window.addEventListener('resize', function(){ if(map) map.invalidateSize(); });
})();
</script>

@elseif($currentSlug === 'repairs')
{{-- ============================================================
REPAIRS MAIN PAGE — full inline redesign
No new file, no new route, no new controller.
This is the existing frontend/index.blade.php modified.
============================================================ --}}
@php
$rpTestimonials = App\Models\Testimonial::where('published', 1)->take(3)->get();
$rpDiagImg   = asset('storage/repair/' . rawurlencode('Background+Border.png'));
$rpMechImg   = asset('storage/repair/b161eb4f5993b807a68dd8e899924f385ea13077.jpg');
$rpCtaImg    = asset('storage/repair/d9886cc318b94eadc9e27dbd5525be95502f6d5e.jpg');
$rpFinalImg  = asset('storage/repair/ee6f981542aa7ecce9e74ca858dffea7eeeda777.jpg');
@endphp

<style>
/* ============================================================
REPAIRS PAGE — SCOPED STYLES (prefix rp-)
============================================================ */
.rp-btn-red,.rp-btn-wh,.rp-btn-dk{-webkit-clip-path:none!important;clip-path:none!important}
.rp-btn-red{background-color:#ED1E24!important;border:2px solid #ED1E24!important;color:#fff!important;transition:all .2s}
.rp-btn-red:hover{background-color:#c41019!important;border-color:#c41019!important;color:#fff!important}
.rp-btn-wh{background:transparent!important;border:2px solid #fff!important;color:#fff!important;transition:all .2s}
.rp-btn-wh:hover{background:#fff!important;color:#111!important;border-color:#fff!important}
.rp-btn-dk{background:transparent!important;border:2px solid #222!important;color:#222!important;transition:all .2s}
.rp-btn-dk:hover{background:#222!important;color:#fff!important;border-color:#222!important}

/* HERO */
.rp-hero{background:#0a0a0a;background:linear-gradient(135deg,#050505 0%,#111 50%,#1a0e10 100%);min-height:auto;display:flex;align-items:center;padding:56px 0;position:relative;overflow:hidden}
.rp-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 82% 50%,rgba(237,30,36,.18) 0%,rgba(237,30,36,.04) 45%,transparent 70%);pointer-events:none}
.rp-hero-title{font-size:clamp(2rem,3.2vw,3.4rem);font-weight:900;line-height:1.06;letter-spacing:-1px;text-transform:uppercase;color:#fff;margin-bottom:18px}
.rp-hero-desc{color:rgba(255,255,255,.75);font-size:14.5px;line-height:1.74;max-width:490px;margin-bottom:26px}
.rp-hero-feats{display:flex;gap:28px;flex-wrap:wrap;margin-top:22px}
.rp-hero-feats span{color:#ED1E24;font-weight:700;font-size:11.5px;letter-spacing:1px;text-transform:uppercase;display:flex;align-items:center;gap:6px}

/* DIAG CARD */
.rp-diag-wrap{position:relative;display:flex;justify-content:center;align-items:center}
.rp-diag-wrap::before{content:'';position:absolute;width:400px;height:400px;border-radius:50%;border:1px dashed rgba(255,255,255,.14);top:50%;left:50%;transform:translate(-50%,-50%);pointer-events:none}
.rp-diag-wrap img{max-width:360px;width:100%;height:auto;display:block;position:relative;z-index:1;filter:drop-shadow(0 15px 35px rgba(0,0,0,.6))}

/* SERVICES */
.rp-services{background:#fff;padding:80px 0}
.rp-sec-title{font-size:clamp(1.8rem,3.6vw,2.75rem);font-weight:900;text-transform:uppercase;letter-spacing:-.3px;color:#111;line-height:1.06}
.rp-sec-sub{font-size:15px;color:#666;max-width:700px;margin:14px auto 0;line-height:1.74}
.rp-sgrid{display:grid;grid-template-columns:repeat(3,1fr);border-top:1px solid #e5e7eb;border-left:1px solid #e5e7eb;border-radius:4px;overflow:hidden}
.rp-scard{display:flex;align-items:center;gap:16px;padding:22px 24px;background:#fff;border-right:1px solid #e5e7eb;border-bottom:1px solid #e5e7eb;min-height:92px;transition:background-color .2s}
.rp-scard:hover{background:#fafafa}
.rp-scard-check{width:32px;height:32px;border-radius:50%;background:#FDE8E8;color:#ED1E24;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0;font-weight:700}
.rp-scard-title{font-size:14.5px;font-weight:700;color:#1a1a1a;margin:0;line-height:1.4}
@media(max-width:991px){.rp-sgrid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:575px){.rp-sgrid{grid-template-columns:1fr}}

/* HOW IT WORKS */
.rp-how{background:#f8f8f8;padding:88px 0}
.rp-stepwrap{position:relative;padding-left:0}
.rp-stepnum{width:52px;height:52px;border-radius:50%;border:2px solid #ED1E24;color:#ED1E24;font-weight:900;font-size:17px;display:flex;align-items:center;justify-content:center;margin-bottom:18px;flex-shrink:0;background:#fff}
.rp-steptitle{font-size:15.5px;font-weight:800;text-transform:uppercase;letter-spacing:.3px;margin-bottom:10px;color:#111}
.rp-stepdesc{font-size:13.5px;color:#666;line-height:1.68}
.rp-hcta{background:#fff;border:1px solid #e4e4e4;border-radius:12px;padding:24px 30px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:18px;margin-top:56px}
.rp-hcta-icon{width:46px;height:46px;border-radius:50%;background:rgba(237,30,36,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.rp-hcta-icon i{color:#ED1E24;font-size:18px}
.rp-hcta-phone{font-size:17px;font-weight:900;color:#111}

/* EMERGENCY */
.rp-emergency{background:#141416;padding:80px 0;position:relative;overflow:hidden}
.rp-emg-title{font-size:clamp(1.8rem,3.2vw,2.8rem);font-weight:900;text-transform:uppercase;color:#fff;line-height:1.08;margin-bottom:20px}
.rp-emg-desc{color:rgba(255,255,255,.7);font-size:14.5px;line-height:1.76;margin-bottom:18px;max-width:500px}
.rp-emg-list{display:flex;flex-direction:column}
.rp-emg-item{display:flex;align-items:center;gap:18px;padding:26px 0;border-bottom:1px solid rgba(255,255,255,.08)}
.rp-emg-item:first-child{padding-top:10px}
.rp-emg-item:last-child{border-bottom:none}
.rp-emg-icon{width:36px;height:36px;border-radius:50%;background:rgba(237,30,36,.12);color:#ED1E24;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0}
.rp-emg-item-title{font-size:16.5px;font-weight:800;color:#fff;margin:0;letter-spacing:.2px}

/* LOCAL EXPERTS */
.rp-local{background:#fff;padding:88px 0}
.rp-local-img{border-radius:12px;overflow:hidden;height:420px}
.rp-local-img img{width:100%;height:100%;object-fit:cover}
.rp-local-text p{font-size:14.5px;color:#555;line-height:1.82;margin-bottom:16px}

/* BOOK CTA */
.rp-bookcta{position:relative;background:#111;padding:110px 0;overflow:hidden}
.rp-bookcta-bg{position:absolute;inset:0;background-size:cover;background-position:center;opacity:.32}
.rp-bookcta-inner{position:relative;z-index:2;text-align:center}
.rp-bookcta-title{font-size:clamp(2rem,4vw,3.2rem);font-weight:900;text-transform:uppercase;color:#fff;line-height:1.06;margin-bottom:18px}
.rp-bookcta-desc{color:rgba(255,255,255,.75);font-size:16px;margin-bottom:36px;font-weight:500}

/* WHY CHOOSE */
.rp-why{background:#fff;padding:60px 0}
.rp-wcard{background:#EEF2F6;border-radius:8px;padding:18px 22px;height:100%;border:none;transition:transform .2s}
.rp-wcard:hover{transform:translateY(-2px)}
.rp-wheader{display:flex;align-items:center;gap:8px;margin-bottom:6px}
.rp-wnum{font-size:13.5px;font-weight:800;color:#ED1E24}
.rp-wtitle{font-size:13.5px;font-weight:800;text-transform:uppercase;letter-spacing:.3px;color:#111;margin:0}
.rp-wdesc{font-size:12.5px;color:#555;line-height:1.6;margin:0}

/* AREAS */
.rp-areas{background:#fff;padding:88px 0}
.rp-abtn{display:inline-block;padding:7px 16px;border:1.5px solid #ddd;border-radius:6px;font-size:13px;font-weight:600;color:#444!important;background:#fff!important;cursor:pointer;transition:all .2s;text-decoration:none;outline:none;-webkit-appearance:none;appearance:none;line-height:1.4}
.rp-abtn:hover,.rp-abtn.active{background:#ED1E24!important;border-color:#ED1E24!important;color:#fff!important}
.rp-abtn:focus{outline:none;box-shadow:none}
#rpAreaMap{background:#e8e0d8!important;color-scheme:light}
#rpAreaMap img,#rpAreaMap canvas{filter:none!important;max-width:none!important}
#rpAreaMap .leaflet-tile-container img{filter:none!important;display:block!important}
#rpAreaMap .leaflet-pane{z-index:auto!important}

/* TESTIMONIALS */
.rp-testi{background:#f8f8f8;padding:88px 0;border-top:1px solid #efefef}
.rp-tcard{background:#fff;border:1px solid #e6e6e6;border-radius:12px;padding:28px;height:100%;display:flex;flex-direction:column}
.rp-stars{color:#f5a623;font-size:14px;margin-bottom:14px;letter-spacing:1px}
.rp-ttext{font-size:14px;color:#555;line-height:1.72;flex-grow:1;font-style:italic;margin-bottom:18px}
.rp-tauthor{font-size:11.5px;font-weight:800;text-transform:uppercase;letter-spacing:.6px;color:#111}
.rp-testi-nav{display:flex;gap:10px;justify-content:flex-end;margin-top:30px}
.rp-testi-nav button{width:36px;height:36px;border-radius:50%;border:1.5px solid #ddd;background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;color:#666}
.rp-testi-nav button:hover{background:#ED1E24;border-color:#ED1E24;color:#fff}

/* FAQ */
.rp-faq{background:#fff;padding:88px 0}
.rp-fitem{border-bottom:1px solid #e8e8e8}
.rp-fitem:first-child{border-top:1px solid #e8e8e8}
.rp-fq{display:flex;justify-content:space-between;align-items:center;padding:20px 0;cursor:pointer;font-size:16.5px;font-weight:700;color:#111;user-select:none;gap:16px;transition:color .2s;text-transform:none !important}
.rp-fq:hover{color:#ED1E24}
.rp-ficon{width:32px;height:32px;border:1.5px solid #ddd;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px;line-height:1;color:#666;transition:all .25s ease;font-weight:400;user-select:none}
.rp-fq:hover .rp-ficon{border-color:#ED1E24;color:#ED1E24}
.rp-ficon::before{content:'+';display:block;line-height:1}
.rp-fitem.open .rp-ficon{background:#ED1E24 !important;border-color:#ED1E24 !important;color:#fff !important;transform:none !important}
.rp-fitem.open .rp-ficon::before{content:'−' !important;font-size:22px;font-weight:700}
.rp-fa{display:none;padding:0 40px 22px 0;font-size:14.5px;color:#666;line-height:1.7}
.rp-fitem.open .rp-fa{display:block}

/* FINAL CTA */
.rp-fcta{position:relative;background:#111;padding:110px 0;overflow:hidden}
.rp-fcta-bg{position:absolute;inset:0;background-size:cover;background-position:center;opacity:.28}
.rp-fcta-inner{position:relative;z-index:2;text-align:center}

/* RESPONSIVE */
@media(max-width:991px){
.rp-hero{padding:44px 0;min-height:auto}
.rp-diag-card{margin-top:32px}
.rp-hcta{flex-direction:column;text-align:center}
.rp-local-img{height:300px;margin-top:30px}
.rp-bookcta,.rp-fcta{padding:80px 0}
.rp-emergency{padding:70px 0}
}
@media(max-width:767px){
.rp-hero{min-height:auto;padding:48px 0}
.rp-hero-title{font-size:2.1rem}
.rp-hero-feats{gap:16px}
.rp-local-img{height:240px}
}
@media(max-width:575px){
.rp-hero-title{font-size:1.75rem}
.rp-bookcta-title,.rp-fcta .rp-bookcta-title{font-size:1.7rem}
}
</style>

{{-- ================================================
SECTION 1 — HERO
================================================ --}}
<section class="rp-hero">
<div class="container position-relative" style="z-index:2">
<div class="row align-items-center g-5">
<div class="col-lg-6">
<h1 class="fm-hero-title">CAR REPAIR<br>PETERBOROUGH</h1>
<p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px; color:#C7C4C0;">Need expert car repair in Peterborough? Smartfit Autos provides affordable and professional repair services for all vehicles. From minor issues to complex mechanical work, our experienced team uses advanced diagnostics to ensure quick, precise, and accurate results.</p>
<div class="d-flex flex-wrap gap-3 mb-4">
  <a href="tel:01733569998" class="btn rp-btn-red rounded-pill px-4 py-2 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.5px"><i class="fa-solid fa-phone me-2"></i>CALL NOW 01733 569998</a>
  <a href="/booking/order" class="btn rp-btn-wh rounded-pill px-4 py-2 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.5px">BOOK MOT ONLINE &rarr;</a>
</div>
<div class="rp-hero-feats">
  <span><i class="fa-solid fa-check"></i>ADVANCED DIAGNOSTICS</span>
  <span><i class="fa-solid fa-check"></i>ALL MAKES &amp; MODELS</span>
  <span><i class="fa-solid fa-check"></i>SAME-DAY REPAIRS</span>
</div>
</div>
<div class="col-lg-5 offset-lg-1">
<div class="rp-diag-wrap">
  <img src="{{ $rpDiagImg }}" alt="Diagnostic Scan – Smartfit Autos Car Repair Peterborough">
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 2 — COMPLETE CAR REPAIR SOLUTIONS
================================================ --}}
<section class="rp-services">
<div class="container">
<div class="text-center mb-5">
<h2 class="">COMPLETE CAR REPAIR SOLUTIONS IN<br>PETERBOROUGH</h2>
<p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important; font-size: 18px; color:#000000;">At Smartfit Autos, we provide a complete range of car repair services to keep your vehicle safe, reliable, and running smoothly.</p>
</div>
<div class="rp-sgrid">
<div class="rp-scard">
<div class="rp-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="rp-scard-title">Engine Diagnostics and Repair</div>
</div>
<div class="rp-scard">
<div class="rp-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="rp-scard-title">Brake Repair, Replacement, and Brake Fluid Change</div>
</div>
<div class="rp-scard">
<div class="rp-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="rp-scard-title">Clutch and Gearbox Repairs</div>
</div>
<div class="rp-scard">
<div class="rp-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="rp-scard-title">Suspension and Steering Repairs</div>
</div>
<div class="rp-scard">
<div class="rp-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="rp-scard-title">Car Servicing (Interim &amp; Full)</div>
</div>
<div class="rp-scard">
<div class="rp-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="rp-scard-title">MOT Failure Repairs</div>
</div>
<div class="rp-scard">
<div class="rp-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="rp-scard-title">Air Conditioning Service, Repair &amp; Re-Gas</div>
</div>
<div class="rp-scard">
<div class="rp-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="rp-scard-title">Battery Testing &amp; Replacement</div>
</div>
<div class="rp-scard">
<div class="rp-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="rp-scard-title">Exhaust and Emissions Repairs</div>
</div>
<div class="rp-scard">
<div class="rp-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="rp-scard-title">Electrical Fault Diagnosis</div>
</div>
<div class="rp-scard">
<div class="rp-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="rp-scard-title">Tyre Services and Wheel Alignment</div>
</div>
<div class="rp-scard d-none d-lg-flex">
<!-- Empty grid cell to balance 3x4 grid structure -->
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 3 — HOW OUR REPAIR PROCESS WORKS
================================================ --}}
<section class="rp-how">
<div class="container">
<div class="text-center mb-5">
<h2 class="" style="color:#111">HOW OUR REPAIR PROCESS WORKS</h2>
</div>
<div class="row g-4">
<div class="col-lg-3 col-md-6">
<div class="rp-stepnum">01</div>
<h3 class="rp-steptitle">Book Your Appointment</h3>
<p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Call or book online easily to schedule your car repair at Smartfit Autos in Peterborough at a time that suits you.</p>
</div>
<div class="col-lg-3 col-md-6">
<div class="rp-stepnum">02</div>
<h3 class="rp-steptitle">Vehicle Inspection &amp; Diagnostics</h3>
<p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We carefully inspect your vehicle using advanced diagnostic tools to quickly identify faults and underlying issues.</p>
</div>
<div class="col-lg-3 col-md-6">
<div class="rp-stepnum">03</div>
<h3 class="rp-steptitle">Clear Quote &amp; Explanation</h3>
<p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We explain the problem in simple terms and provide a transparent, upfront repair quote before any work begins.</p>
</div>
<div class="col-lg-3 col-md-6">
<div class="rp-stepnum">04</div>
<h3 class="rp-steptitle">Professional Repair &amp; Handover</h3>
<p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Our skilled technicians complete all repairs with care and return your vehicle fully checked and ready for the road.</p>
</div>
</div>
<div class="rp-hcta">
<div class="d-flex align-items-center gap-3">
<div class="rp-hcta-icon"><i class="fa-solid fa-phone"></i></div>
<div>
  <div style="font-weight:800;font-size:15px;color:#111">Ready when you are</div>
  <div class="rp-hcta-phone">01733 569998</div>
</div>
</div>
<div class="d-flex flex-wrap gap-3">
<a href="tel:01733569998" class="btn rp-btn-dk rounded-pill px-4 py-2 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.5px">CALL NOW 01733 569998</a>
<a href="/booking/order" class="btn rp-btn-red rounded-pill px-4 py-2 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.5px">BOOK YOUR CAR REPAIR TODAY</a>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 4 — EMERGENCY & SAME DAY CAR REPAIRS
================================================ --}}
<section class="rp-emergency">
<div class="container position-relative" style="z-index:2">
<div class="row align-items-center g-5">
<div class="col-lg-6">
<h2 class="">EMERGENCY &amp; SAME<br>DAY CAR REPAIRS</h2>
<p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px; color:#B9B6B1;">When your vehicle breaks down unexpectedly, you need fast help you can trust. At Smartfit Autos, we provide same-day and urgent car repair services in Peterborough to get you back on the road as quickly as possible.</p>
<p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px; color:#B9B6B1;">From warning lights and engine issues to brake faults and electrical problems, our team prioritises urgent repairs with quick diagnostics and efficient solutions. We aim to reduce downtime and get your vehicle safely moving again without delay</p>
<a href="tel:01733569998" class="btn rp-btn-red rounded-pill px-4 py-2.5 fw-bold" style="font-size:13.5px">Call For Urgent Repair</a>
</div>
<div class="col-lg-5 offset-lg-1">
<div class="rp-emg-list">
  <div class="rp-emg-item">
    <div class="rp-emg-icon"><i class="fa-solid fa-bolt"></i></div>
    <h4 class="rp-emg-item-title">Fast Response</h4>
  </div>
  <div class="rp-emg-item">
    <div class="rp-emg-icon"><i class="fa-solid fa-desktop"></i></div>
    <h4 class="rp-emg-item-title">Quick Diagnostics</h4>
  </div>
  <div class="rp-emg-item">
    <div class="rp-emg-icon"><i class="fa-solid fa-check"></i></div>
    <h4 class="rp-emg-item-title">Reliable Repairs</h4>
  </div>
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 5 — LOCAL CAR REPAIR EXPERTS
================================================ --}}
<section class="rp-local">
<div class="container">
<div class="row align-items-center g-5">
<div class="col-lg-6">
<h2 class="" style="margin-bottom:24px">LOCAL CAR REPAIR<br>EXPERTS IN PETERBOROUGH</h2>
<div class="rp-local-text">
  <p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px; color:#101014;">At Smartfit Autos, we are a trusted local garage in Peterborough, dedicated to keeping drivers safely on the road. We understand the everyday needs of local motorists, from busy commuters and family cars to light commercial vehicles.</p>
  <p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px; color:#101014;">Our team delivers car repair solutions in Peterborough, providing fast, reliable service with minimal disruption to your routine.</p>
 <p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px; color:#101014;">For anyone looking for reliable car repair services in Peterborough, Smartfit Autos is your local choice for expert repairs, honest advice, and quality workmanship.</p>
</div>
<a href="/booking/order" class="btn rp-btn-red rounded-pill px-5 py-3 fw-bold text-uppercase mt-2" style="font-size:13px;letter-spacing:.6px">BOOK YOUR REPAIR TODAY</a>
</div>
<div class="col-lg-6">
<div class="rp-local-img">
  <img src="{{ $rpMechImg }}" alt="Local car repair experts in Peterborough – Smartfit Autos mechanic working on an engine">
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 6 — BOOK YOUR CAR REPAIR CTA
================================================ --}}
<section class="rp-bookcta">
<div class="rp-bookcta-bg" style="background-image:url('{{ $rpCtaImg }}')"></div>
<div class="container">
<div class="rp-bookcta-inner">
<p class="display-4 fw-extrabold text-white opacity-1" style="opacity: 1 !important;font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">NEED CAR REPAIR IN PETERBOROUGH?</p>
<p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important; font-size: 18px; color:#ffffff;">Book car repair in Peterborough with Smartfit Autos. Fast, affordable repairs by expert local mechanics you can trust.</p>
<div class="d-flex flex-wrap justify-content-center gap-3">
<a href="/booking/order" class="btn rp-btn-red rounded-pill px-5 py-3 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.8px">BOOK YOUR APPOINTMENT TODAY &rarr;</a>
<a href="tel:01733569998" class="btn rp-btn-wh rounded-pill px-5 py-3 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.8px">CALL NOW &rarr;</a>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 7 — WHY CHOOSE SMARTFIT AUTOS
================================================ --}}
<section class="rp-why">
<div class="container">
<div class="text-center mb-5">
<h2 class="" style="color:#111">WHY CHOOSE SMARTFIT AUTOS FOR<br>CAR REPAIRS IN PETERBOROUGH</h2>
</div>
<div class="row g-3">
<div class="col-lg-6">
<div class="rp-wcard">
  <div class="rp-wheader">
    <span class="rp-wnum">01</span>
    <h3 class="rp-wtitle">EXPERIENCED MECHANICS</h3>
  </div>
 <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Our skilled mechanics bring years of hands-on experience, handling all makes and models with precision, ensuring accurate diagnosis and high-quality repairs every time.</p>
</div>
</div>
<div class="col-lg-6">
<div class="rp-wcard">
  <div class="rp-wheader">
    <span class="rp-wnum">02</span>
    <h3 class="rp-wtitle">HONEST REPAIR ADVICE</h3>
  </div>
  <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We only recommend what your vehicle truly needs. No upselling or hidden extras, just clear explanations and honest guidance to keep your car safe and reliable.</p>
</div>
</div>
<div class="col-lg-6">
<div class="rp-wcard">
  <div class="rp-wheader">
    <span class="rp-wnum">03</span>
    <h3 class="rp-wtitle">TRANSPARENT PRICING</h3>
  </div>
  <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We offer fair, upfront pricing with no surprises. Every job is quoted clearly so you know exactly what you're paying for before any work begins.</p>
</div>
</div>
<div class="col-lg-6">
<div class="rp-wcard">
  <div class="rp-wheader">
    <span class="rp-wnum">04</span>
    <h3 class="rp-wtitle">FAST TURNAROUND TIMES</h3>
  </div>
  <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We understand the importance of your vehicle, so we aim to complete repairs quickly without compromising on quality, getting you back on the road sooner.</p>
</div>
</div>
<div class="col-lg-6">
<div class="rp-wcard">
  <div class="rp-wheader">
    <span class="rp-wnum">05</span>
    <h3 class="rp-wtitle">QUALITY PARTS</h3>
  </div>
  <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We use reliable, high-quality parts and follow industry standard repair practices to ensure long lasting performance and safety for your vehicle.</p>
</div>
</div>
<div class="col-lg-6">
<div class="rp-wcard">
  <div class="rp-wheader">
    <span class="rp-wnum">06</span>
    <h3 class="rp-wtitle">ADVANCED DIAGNOSTIC TECHNOLOGY</h3>
  </div>
 <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We use modern diagnostic equipment to quickly and accurately identify vehicle issues, helping reduce guesswork and ensure precise, efficient repairs.</p>
</div>
</div>
</div>
</div>
</section>

{{-- Load Leaflet from jsDelivr (shared with fleet page, safe to include again) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css">

{{-- ================================================
SECTION 8 — WE SERVE PETERBOROUGH & SURROUNDING AREAS
================================================ --}}
<section class="rp-areas">
<div class="container">
<div class="text-center mb-5">
<h2 class="" style="color:#111">WE SERVE PETERBOROUGH AND<br>SURROUNDING AREAS</h2>
</div>
<div class="row g-5 align-items-center">
<div class="col-lg-5">
<p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">At Smartfit Autos, we provide professional car repair services in Peterborough and nearby locations. Our local garage is trusted by drivers who need fast, reliable, and affordable vehicle repairs close to home.</p>
<div class="d-flex flex-wrap gap-2">
  @php
  $mapAreas = [
      ['Peterborough', 52.5695, -0.2405],
      ['Stamford',     52.6510, -0.4810],
      ['Whittlesey',   52.5574, -0.1315],
      ['Crowland',     52.6756, -0.1661],
      ['Bourne',       52.7686, -0.3770],
      ['Huntingdon',   52.3304, -0.1867],
      ['Oundle',       52.4820, -0.4700],
      ['Sawtry',       52.4370, -0.2830],
      ['Ramsey',       52.4490, -0.1060],
      ['St Ives',      52.3270, -0.0760]
  ];
  @endphp
  @foreach($mapAreas as $idx => [$name, $lat, $lng])
  <button type="button" class="rp-abtn {{ $idx === 0 ? 'active' : '' }}" onclick="rpGoTo({{ $idx }}, this)">{{ $name }}</button>
  @endforeach
</div>
</div>
<div class="col-lg-7">
<div id="rpAreaMap" data-bs-theme="light"
  style="height:380px;border-radius:12px;overflow:hidden;border:1px solid #e4e4e4;">
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 9 — CUSTOMER REVIEWS
================================================ --}}
<section class="py-5" style="background: #F2F2F4 !important;">
<div class="container py-4">
<div class="text-center mb-5">
    <h2 class="display-4 fw-extrabold text-dark mb-0" style="font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
        WHAT OUR CUSTOMERS SAY
    </h2>
</div>

<div class="home_reviews_slider_wrap position-relative">
    <div class="home_reviews_carousel">
        {{-- Review 1 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Fantastic work on my BMW. Needed an MOT and they fitted me in the same day. Got my car back within 2 hours after they sorted the tyres, so I was good to go.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    AMINATOU SMART
                </div>
            </div>
        </div>

        {{-- Review 2 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    They're always so polite, professional and honest about their ability to help. They've even done small favours that have gone above and beyond what I would have expected.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    ABE THOMAS
                </div>
            </div>
        </div>

        {{-- Review 3 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Took my car in for an MOT, they were very accommodating and efficient with their work. Good prices and an overall top service.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    ALEX GRIFFIN
                </div>
            </div>
        </div>

        {{-- Review 4 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Excellent service from the team at Smartfit Autos. Booked full servicing and MOT online. Fast turnaround, transparent pricing, and polite staff.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    DAVID MILLER
                </div>
            </div>
        </div>

        {{-- Review 5 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Brilliant garage! Had brake repair and disc replacements completed on the same day without any hassle. Highly recommend their experienced technicians.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    SARAH JENKINS
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <button type="button" class="btn btn-light rounded-circle d-flex align-items-center justify-content-center p-0 reviews_arrow_left" style="width: 42px; height: 42px; border: 1px solid #ddd; background: #fff; cursor: pointer; transition: all 0.2s ease;">
        <i class="fa-solid fa-arrow-left text-dark small"></i>
    </button>
    <button type="button" class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center p-0 reviews_arrow_right" style="width: 42px; height: 42px; background-color: #ED1E24; border-color: #ED1E24; cursor: pointer; transition: all 0.2s ease;">
        <i class="fa-solid fa-arrow-right text-white small"></i>
    </button>
</div>
</div>
</section>

<style>
.home_reviews_carousel .slick-track {
display: flex !important;
}
.home_reviews_carousel .slick-slide {
height: inherit !important;
display: flex !important;
}
.home_reviews_carousel .slick-slide > div {
display: flex;
width: 100%;
}
.reviews_arrow_left:hover {
background: #f0f0f0 !important;
border-color: #bbb !important;
}
.reviews_arrow_right:hover {
background: #c41019 !important;
border-color: #c41019 !important;
}
</style>

<script>
(function() {
function initReviewsSlider() {
if (window.jQuery && jQuery.fn.slick && jQuery('.home_reviews_carousel').length) {
    if (!jQuery('.home_reviews_carousel').hasClass('slick-initialized')) {
        jQuery('.home_reviews_carousel').slick({
            dots: false,
            arrows: true,
            prevArrow: '.reviews_arrow_left',
            nextArrow: '.reviews_arrow_right',
            infinite: true,
            autoplay: true,
            autoplaySpeed: 3500,
            speed: 600,
            slidesToShow: 3,
            slidesToScroll: 1,
            pauseOnHover: true,
            pauseOnFocus: false,
            swipeToSlide: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
}
}

if (document.readyState === 'complete' || document.readyState === 'interactive') {
setTimeout(initReviewsSlider, 100);
} else {
document.addEventListener('DOMContentLoaded', initReviewsSlider);
}
window.addEventListener('load', initReviewsSlider);
})();
</script>

{{-- ================================================
SECTION 10 — FREQUENTLY ASKED QUESTIONS
================================================ --}}
<section class="rp-faq">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-9">
<div class="text-center mb-5">
  <h2 class="rp-sec-title" style="color:#111">FREQUENTLY ASKED QUESTIONS</h2>
</div>
<div class="rp-fitem open" id="rpF1">
  <h3 class="rp-fq fm-fq" onclick="rpFaq('rpF1')"><span>What car repair services do you offer in Peterborough?</span><div class="rp-ficon"></div></h3>
  <div class="rp-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We provide a full range of car repair services in Peterborough, including engine diagnostics, brake repairs, clutch and gearbox work, suspension repairs, air conditioning service, electrical fault diagnosis, and more.</p></div>
</div>
<div class="rp-fitem" id="rpF2">
  <h3 class="rp-fq fm-fq" onclick="rpFaq('rpF2')"><span>Do you repair all makes and models?</span><div class="rp-ficon"></div></h3>
  <div class="rp-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Yes, Smartfit Autos works on all makes and models, including petrol, diesel, hybrid, and light commercial vehicles.</p></div>
</div>
<div class="rp-fitem" id="rpF3">
  <h3 class="rp-fq fm-fq" onclick="rpFaq('rpF3')"><span>Do you provide car diagnostics before repairs?</span><div class="rp-ficon"></div></h3>
  <div class="rp-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Yes, we use advanced diagnostic equipment to quickly identify issues and provide accurate repair solutions before any work begins.</p></div>
</div>
<div class="rp-fitem" id="rpF4">
  <h3 class="rp-fq fm-fq" onclick="rpFaq('rpF4')"><span>Are your car repair prices fixed or quoted?</span><div class="rp-ficon"></div></h3>
  <div class="rp-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We provide clear, upfront quotes before starting any work, so you always know the cost in advance with no hidden charges.</p></div>
</div>
<div class="rp-fitem" id="rpF5">
  <h3 class="rp-fq fm-fq" onclick="rpFaq('rpF5')"><span>How long do car repairs usually take?</span><div class="rp-ficon"></div></h3>
  <div class="rp-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Repair times depend on the issue, but we always aim to complete work as quickly as possible without compromising on quality.</p></div>
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 11 — FINAL CTA
================================================ --}}
<style>
.rp-fcta-bg{opacity:.45!important}
.rp-fcta .rp-bookcta-title{font-size:clamp(2.2rem,4.5vw,3.6rem);letter-spacing:-.5px}
.rp-fcta{padding:120px 0}
@media(max-width:991px){.rp-fcta{padding:90px 0}}
@media(max-width:575px){.rp-fcta .rp-bookcta-title{font-size:1.85rem}}
</style>
<section class="rp-fcta">
<div class="rp-fcta-bg" style="background-image:url('{{ $rpCtaImg }}')"></div>
<div class="container">
<div class="rp-fcta-inner">
<p class="display-4 fw-extrabold text-white opacity-1" style="opacity: 1 !important;font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">BOOK YOUR CAR REPAIR IN PETERBOROUGH TODAY</p>
<p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important; font-size: 18px; color:#ffffff;">Smartfit Autos offers fast, affordable car repair in Peterborough with expert local mechanics.</p>
<div class="d-flex flex-wrap justify-content-center gap-3">
<a href="/booking/order" class="btn rp-btn-red rounded-pill px-5 py-3 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.8px">BOOK YOUR CAR REPAIR TODAY &rarr;</a>
<a href="tel:01733569998" class="btn rp-btn-wh rounded-pill px-5 py-3 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.8px">CALL NOW 01733 569998 &rarr;</a>
</div>
</div>
</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>
<script>
/* ---- Repairs FAQ accordion ---- */
function rpFaq(id){
var el=document.getElementById(id);
var was=el.classList.contains('open');
document.querySelectorAll('.rp-fitem').forEach(function(i){i.classList.remove('open')});
if(!was) el.classList.add('open');
}

/* ---- Repairs interactive map: Leaflet + CartoDB Voyager tiles ---- */
(function(){
var locs = [
{name:"Peterborough", lat:52.5695, lng:-0.2405},
{name:"Stamford",     lat:52.6510, lng:-0.4810},
{name:"Whittlesey",   lat:52.5574, lng:-0.1315},
{name:"Crowland",     lat:52.6756, lng:-0.1661},
{name:"Bourne",       lat:52.7686, lng:-0.3770},
{name:"Huntingdon",   lat:52.3304, lng:-0.1867},
{name:"Oundle",       lat:52.4820, lng:-0.4700},
{name:"Sawtry",       lat:52.4370, lng:-0.2830},
{name:"Ramsey",       lat:52.4490, lng:-0.1060},
{name:"St Ives",      lat:52.3270, lng:-0.0760}
];
var map, markers = [];
function initRepairsMap(){
var el = document.getElementById('rpAreaMap');
if(!el || el._leaflet_id || typeof L === 'undefined') return;
map = L.map('rpAreaMap', {scrollWheelZoom: false, zoomControl: true}).setView([52.5695, -0.2405], 10);
L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/">CARTO</a>',
subdomains: 'abcd',
maxZoom: 19
}).addTo(map);
var redPin = L.divIcon({
className: 'rp-map-pin',
html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 42" width="28" height="42"><path d="M14 0C8.48 0 4 4.48 4 10c0 7.5 10 26 10 26s10-18.5 10-26C24 4.48 19.52 0 14 0z" fill="#ED1E24"/><circle cx="14" cy="10" r="5.5" fill="#fff"/></svg>',
iconSize:   [28, 42],
iconAnchor: [14, 42],
popupAnchor:[0, -42]
});
locs.forEach(function(l, i){
var m = L.marker([l.lat, l.lng], {icon: redPin}).addTo(map)
       .bindPopup('<b style="color:#ED1E24;font-size:15px;">'+l.name+'</b><br><small style="color:#555;">Smartfit Autos Car Repair Area</small>');
m.on('click', function(){
var btns = document.querySelectorAll('.rp-abtn');
btns.forEach(function(b){ b.classList.remove('active'); });
if(btns[i]) btns[i].classList.add('active');
});
markers.push(m);
});
setTimeout(function(){ if(map) map.invalidateSize(); }, 300);
}
window.rpGoTo = function(idx, btn) {
document.querySelectorAll('.rp-abtn').forEach(function(b){ b.classList.remove('active'); });
if(btn) btn.classList.add('active');
if(map && locs[idx]){
map.flyTo([locs[idx].lat, locs[idx].lng], 12, {animate: true, duration: 0.8});
if(markers[idx]) markers[idx].openPopup();
}
};
if(document.readyState==='complete'){ setTimeout(initRepairsMap, 150); }
else { window.addEventListener('load', function(){ setTimeout(initRepairsMap, 150); }); }
window.addEventListener('resize', function(){ if(map) map.invalidateSize(); });
})();
</script>

@elseif($currentSlug === 'car-servicing')
{{-- ============================================================
CAR SERVICING PAGE — full inline redesign
No new file, no new route, no new controller.
This is the existing frontend/index.blade.php modified.
============================================================ --}}
@php
$svTestimonials = App\Models\Testimonial::where('published', 1)->take(3)->get();
$svDiagImg   = asset('storage/service/' . rawurlencode('Background+Border.png'));
$svGarageImg = asset('storage/service/8e8df697ae5f04598f101ba689cbaaae747d70c2.jpg');
$svLiftImg   = asset('storage/service/cb8a706c777269b09c23c254f22d2a7a6c40235b.jpg');
$svBrakeImg  = asset('storage/service/abfbadac6dd966e725c80109b8bb66b0ec9c2d98.jpg');
@endphp

<style>
/* ============================================================
CAR SERVICING PAGE — SCOPED STYLES (prefix sv-)
============================================================ */
/* BUTTONS */
.sv-btn-red, .sv-btn-outline, .sv-btn-dk, .sv-btn-red-out,
.rp-btn-red, .rp-btn-wh, .rp-btn-dk{position:relative!important;box-shadow:none!important;outline:none!important;-webkit-clip-path:none!important;clip-path:none!important}
.sv-btn-red::before,.sv-btn-red::after,
.sv-btn-outline::before,.sv-btn-outline::after,
.sv-btn-dk::before,.sv-btn-dk::after,
.sv-btn-red-out::before,.sv-btn-red-out::after,
.rp-btn-red::before,.rp-btn-red::after,
.rp-btn-wh::before,.rp-btn-wh::after,
.rp-btn-dk::before,.rp-btn-dk::after{display:none!important;content:none!important;opacity:0!important}

.sv-btn-red{background-color:#ED1E24!important;border:1.5px solid #ED1E24!important;color:#fff!important;border-radius:100px!important;padding:11px 28px!important;font-size:13px!important;font-weight:800!important;letter-spacing:.5px!important;transition:all .2s ease!important}
.sv-btn-red:hover{background-color:#c41019!important;border-color:#c41019!important;color:#fff!important}
.sv-btn-outline{background:transparent!important;border:1.5px solid rgba(255,255,255,.45)!important;color:#fff!important;border-radius:100px!important;padding:11px 26px!important;font-size:13px!important;font-weight:700!important;letter-spacing:.5px!important;transition:all .2s ease!important}
.sv-btn-outline:hover{border-color:#fff!important;background:rgba(255,255,255,.12)!important;color:#fff!important}
.sv-btn-dk{background:transparent!important;border:2px solid #222!important;color:#222!important;transition:all .2s}
.sv-btn-dk:hover{background:#222!important;color:#fff!important;border-color:#222!important}

.sv-hero{background:#0d0d0f;background:linear-gradient(135deg,#070708 0%,#111114 50%,#1b0d10 100%);min-height:auto;display:flex;align-items:center;padding:50px 0;position:relative;overflow:hidden}
.sv-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(circle at 82% 50%,rgba(237,30,36,.22) 0%,rgba(237,30,36,.04) 45%,transparent 70%);pointer-events:none}
.sv-hero-title{font-size:clamp(1.6rem,2.8vw,2.8rem);font-weight:900;line-height:1.1;letter-spacing:-.8px;text-transform:uppercase;color:#fff;margin-bottom:20px;white-space:nowrap}
.sv-hero-desc{color:rgba(255,255,255,.76);font-size:14.5px;line-height:1.72;max-width:580px;margin-bottom:28px}
.sv-hero-feats{display:flex;gap:32px;flex-wrap:wrap;margin-top:24px}
.sv-hero-feats span{color:rgba(255,255,255,.88);font-weight:700;font-size:12px;letter-spacing:1px;text-transform:uppercase;display:flex;align-items:center;gap:8px}
.sv-hero-feats span i{color:#ED1E24;font-size:14px}

.sv-diag-wrap{position:relative;display:inline-flex;justify-content:center;align-items:center}
.sv-diag-wrap::before{content:'';position:absolute;width:420px;height:420px;border-radius:50%;border:1px dashed rgba(255,255,255,.14);top:50%;left:50%;transform:translate(-50%,-50%);pointer-events:none}
.sv-diag-wrap img{max-width:350px;width:100%;height:auto;display:block;position:relative;z-index:1;filter:drop-shadow(0 20px 40px rgba(0,0,0,.7))}

/* SERVICES GRID */
.sv-services{background:#fff;padding:80px 0}
.sv-sec-title{font-size:clamp(1.8rem,3.6vw,2.75rem);font-weight:900;text-transform:uppercase;letter-spacing:-.3px;color:#111;line-height:1.06}
.sv-sec-sub{font-size:15px;color:#666;max-width:700px;margin:14px auto 0;line-height:1.74}
.sv-sgrid{display:grid;grid-template-columns:repeat(3,1fr);border-top:1px solid #e5e7eb;border-left:1px solid #e5e7eb;border-radius:4px;overflow:hidden}
.sv-scard{display:flex;align-items:center;gap:16px;padding:22px 24px;background:#fff;border-right:1px solid #e5e7eb;border-bottom:1px solid #e5e7eb;min-height:92px;transition:background-color .2s}
.sv-scard:hover{background:#fafafa}
.sv-scard-check{width:32px;height:32px;border-radius:50%;background:#FDE8E8;color:#ED1E24;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0;font-weight:700}
.sv-scard-title{font-size:14.5px;font-weight:700;color:#1a1a1a;margin:0;line-height:1.4}
@media(max-width:991px){.sv-sgrid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:575px){.sv-sgrid{grid-template-columns:1fr}}

/* EASY STEPS */
.sv-how{background:#f8f8f8;padding:88px 0}
.sv-stepnum{width:52px;height:52px;border-radius:50%;border:2px solid #ED1E24;color:#ED1E24;font-weight:900;font-size:17px;display:flex;align-items:center;justify-content:center;margin-bottom:18px;flex-shrink:0;background:#fff}
.sv-steptitle{font-size:15.5px;font-weight:800;text-transform:uppercase;letter-spacing:.3px;margin-bottom:10px;color:#111}
.sv-stepdesc{font-size:13.5px;color:#666;line-height:1.68}
.sv-hcta{background:#fff;border:1px solid #e4e4e4;border-radius:12px;padding:24px 30px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:18px;margin-top:56px}
.sv-hcta-icon{width:46px;height:46px;border-radius:50%;background:rgba(237,30,36,.1);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sv-hcta-icon i{color:#ED1E24;font-size:18px}
.sv-hcta-phone{font-size:17px;font-weight:900;color:#111}

/* IMPORTANCE */
.sv-importance{background:#fff;padding:80px 0}
.sv-imp-item{display:flex;align-items:flex-start;gap:16px;margin-bottom:24px}
.sv-imp-item:last-child{margin-bottom:0}
.sv-imp-icon{width:40px;height:40px;border-radius:50%;background:#FDE8E8;color:#ED1E24;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0;margin-top:2px}
.sv-imp-title{font-size:16px;font-weight:800;color:#111;margin-bottom:4px}
.sv-imp-desc{font-size:13.5px;color:#666;line-height:1.6;margin:0}

/* LOCAL GARAGE */
.sv-local{background:#fff;padding:80px 0}
.sv-local-img{border-radius:12px;overflow:hidden;height:420px}
.sv-local-img img{width:100%;height:100%;object-fit:cover}
.sv-local-text p{font-size:14.5px;color:#555;line-height:1.82;margin-bottom:16px}

/* BOOK CTA */
.sv-bookcta{position:relative;background:#111;padding:110px 0;overflow:hidden}
.sv-bookcta-bg{position:absolute;inset:0;background-size:cover;background-position:center;opacity:.35}
.sv-bookcta-inner{position:relative;z-index:2;text-align:center}
.sv-bookcta-title{font-size:clamp(2rem,4vw,3.2rem);font-weight:900;text-transform:uppercase;color:#fff;line-height:1.06;margin-bottom:18px}
.sv-bookcta-desc{color:rgba(255,255,255,.75);font-size:16px;margin-bottom:36px;font-weight:500}

/* WHY CHOOSE */
.sv-why{background:#fff;padding:60px 0}
.sv-wcard{background:#EEF2F6;border-radius:8px;padding:18px 22px;height:100%;border:none;transition:transform .2s}
.sv-wcard:hover{transform:translateY(-2px)}
.sv-wheader{display:flex;align-items:center;gap:8px;margin-bottom:6px}
.sv-wnum{font-size:13.5px;font-weight:800;color:#ED1E24}
.sv-wtitle{font-size:13.5px;font-weight:800;text-transform:uppercase;letter-spacing:.3px;color:#111;margin:0}
.sv-wdesc{font-size:12.5px;color:#555;line-height:1.6;margin:0}

/* AREAS */
.sv-areas{background:#fff;padding:80px 0}
.sv-abtn{display:inline-block;padding:7px 16px;border:1.5px solid #ddd;border-radius:6px;font-size:13px;font-weight:600;color:#444!important;background:#fff!important;cursor:pointer;transition:all .2s;text-decoration:none;outline:none;-webkit-appearance:none;appearance:none;line-height:1.4}
.sv-abtn:hover,.sv-abtn.active{background:#ED1E24!important;border-color:#ED1E24!important;color:#fff!important}
.sv-abtn:focus{outline:none;box-shadow:none}
#svAreaMap{background:#e8e0d8!important;color-scheme:light}
#svAreaMap img,#svAreaMap canvas{filter:none!important;max-width:none!important}
#svAreaMap .leaflet-tile-container img{filter:none!important;display:block!important}
#svAreaMap .leaflet-pane{z-index:auto!important}

/* TESTIMONIALS */
.sv-testi{background:#f8f8f8;padding:88px 0;border-top:1px solid #efefef}
.sv-tcard{background:#fff;border:1px solid #e6e6e6;border-radius:12px;padding:28px;height:100%;display:flex;flex-direction:column}
.sv-stars{color:#f5a623;font-size:14px;margin-bottom:14px;letter-spacing:1px}
.sv-ttext{font-size:14px;color:#555;line-height:1.72;flex-grow:1;font-style:italic;margin-bottom:18px}
.sv-tauthor{font-size:11.5px;font-weight:800;text-transform:uppercase;letter-spacing:.6px;color:#111}
.sv-testi-nav{display:flex;gap:10px;justify-content:flex-end;margin-top:30px}
.sv-testi-nav button{width:36px;height:36px;border-radius:50%;border:1.5px solid #ddd;background:#fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;color:#666}
.sv-testi-nav button:hover{background:#ED1E24;border-color:#ED1E24;color:#fff}

/* FAQ */
.sv-faq{background:#fff;padding:88px 0}
.sv-fitem{border-bottom:1px solid #e8e8e8}
.sv-fitem:first-child{border-top:1px solid #e8e8e8}
.sv-fq{display:flex;justify-content:space-between;align-items:center;padding:20px 0;cursor:pointer;font-size:16.5px;font-weight:700;color:#111;user-select:none;gap:16px;transition:color .2s;text-transform:none !important}
.sv-fq:hover{color:#ED1E24}
.sv-ficon{width:32px;height:32px;border:1.5px solid #ddd;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px;line-height:1;color:#666;transition:all .25s ease;font-weight:400;user-select:none}
.sv-fq:hover .sv-ficon{border-color:#ED1E24;color:#ED1E24}
.sv-ficon::before{content:'+';display:block;line-height:1}
.sv-fitem.open .sv-ficon{background:#ED1E24 !important;border-color:#ED1E24 !important;color:#fff !important;transform:none !important}
.sv-fitem.open .sv-ficon::before{content:'−' !important;font-size:22px;font-weight:700}
.sv-fa{display:none;padding:0 40px 22px 0;font-size:14.5px;color:#666;line-height:1.7}
.sv-fitem.open .sv-fa{display:block}

/* FINAL CTA */
.sv-btn-red-out{background:transparent!important;border:2px solid #ED1E24!important;color:#fff!important;transition:all .2s}
.sv-btn-red-out:hover{background:#ED1E24!important;color:#fff!important}
.sv-fcta{position:relative;background:#111;padding:120px 0;overflow:hidden}
.sv-fcta-bg{position:absolute;inset:0;background-size:cover;background-position:center;opacity:.48!important}
.sv-fcta .sv-bookcta-title{font-size:clamp(2.2rem,4.5vw,3.6rem);letter-spacing:-.5px}
.sv-fcta-inner{position:relative;z-index:2;text-align:center}

/* RESPONSIVE */
@media(max-width:991px){
.sv-hero{padding:44px 0;min-height:auto}
.sv-diag-wrap{margin-top:32px}
.sv-hcta{flex-direction:column;text-align:center}
.sv-local-img{height:300px;margin-top:30px}
.sv-bookcta,.sv-fcta{padding:80px 0}
}
@media(max-width:767px){
.sv-hero{padding:44px 0}
.sv-hero-title{font-size:2.1rem}
.sv-hero-feats{gap:16px}
.sv-local-img{height:240px}
}
@media(max-width:575px){
.sv-hero-title{font-size:1.75rem}
.sv-bookcta-title,.sv-fcta .sv-bookcta-title{font-size:1.7rem}
}
</style>

{{-- ================================================
SECTION 1 — HERO
================================================ --}}
<section class="sv-hero">
<div class="container position-relative" style="z-index:2">
<div class="row align-items-center g-4">
<div class="col-lg-7">
<h1 class="fm-hero-title">CAR SERVICE PETERBOROUGH</h1>
 <p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px; color:#C7C4C0;">Keep your vehicle running at its best with Smartfit Autos in Peterborough. We offer reliable, affordable car servicing for all makes and models, delivered by skilled mechanics. From routine maintenance to full inspections, we ensure quality, safety, and performance you can trust.</p>
<div class="d-flex flex-wrap align-items-center gap-3 mb-4">
  <a href="tel:01733569998" class="btn sv-btn-red text-uppercase">CALL NOW 01733 569998</a>
  <a href="/booking/order" class="btn sv-btn-outline text-uppercase">BOOK YOUR CAR SERVICE &rarr;</a>
</div>
<div class="sv-hero-feats">
  <span><i class="fa-solid fa-check"></i>ALL MAKES &amp; MODELS</span>
  <span><i class="fa-solid fa-check"></i>QUICK TURNAROUND</span>
</div>
</div>
<div class="col-lg-5 text-center">
<div class="sv-diag-wrap">
  <img src="{{ $svDiagImg }}" alt="Car Servicing Health Inspection – Smartfit Autos Peterborough">
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 2 — OUR CAR SERVICING INCLUDES
================================================ --}}
<section class="sv-services">
<div class="container">
<div class="text-center mb-5">
<h2 class="">OUR CAR SERVICING INCLUDES</h2>
 <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important; font-size: 18px;">Complete car servicing in Peterborough covering full, interim, major service and all essential vehicle maintenance needs.</p>
</div>
<div class="sv-sgrid">
<div class="sv-scard">
<div class="sv-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="sv-scard-title">Full Car Service</div>
</div>
<div class="sv-scard">
<div class="sv-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="sv-scard-title">Interim Car Service</div>
</div>
<div class="sv-scard">
<div class="sv-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="sv-scard-title">Major Car Service</div>
</div>
<div class="sv-scard">
<div class="sv-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="sv-scard-title">Engine Oil &amp; Filter Change</div>
</div>
<div class="sv-scard">
<div class="sv-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="sv-scard-title">Brake Inspection &amp; Repair</div>
</div>
<div class="sv-scard">
<div class="sv-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="sv-scard-title">Suspension &amp; Steering Check</div>
</div>
<div class="sv-scard">
<div class="sv-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="sv-scard-title">Battery Testing</div>
</div>
<div class="sv-scard">
<div class="sv-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="sv-scard-title">Fluid Top-Ups</div>
</div>
<div class="sv-scard">
<div class="sv-scard-check"><i class="fa-solid fa-check"></i></div>
<div class="sv-scard-title">Diagnostic Checks</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 3 — EASY STEPS TO GET YOUR CAR SERVICED
================================================ --}}
<section class="sv-how">
<div class="container">
<div class="text-center mb-5">
<h2 class="" style="color:#111">EASY STEPS TO GET YOUR CAR SERVICED</h2>
</div>
<div class="row g-4">
<div class="col-lg-3 col-md-6">
<div class="sv-stepnum">01</div>
<h3 class="sv-steptitle">BOOK YOUR APPOINTMENT</h3>
 <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Easily book your car service online or by phone at a time that suits you with quick confirmation and hassle-free scheduling.</p>
</div>
<div class="col-lg-3 col-md-6">
<div class="sv-stepnum">02</div>
<h3 class="sv-steptitle">VEHICLE INSPECTION &amp; DIAGNOSTICS</h3>
 <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We perform a full vehicle inspection using advanced diagnostic tools to accurately identify any issues or maintenance needs.</p>
</div>
<div class="col-lg-3 col-md-6">
<div class="sv-stepnum">03</div>
<h3 class="sv-steptitle">SERVICE &amp; REPAIRS</h3>
 <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Our expert mechanics carry out all required servicing and repairs using high-quality parts to ensure optimal vehicle performance.</p>
</div>
<div class="col-lg-3 col-md-6">
<div class="sv-stepnum">04</div>
<h3 class="sv-steptitle">FINAL QUALITY CHECK</h3>
 <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Every vehicle goes through a detailed final quality and safety check to ensure it is fully road-ready and reliable.</p>
</div>
</div>
<div class="sv-hcta">
<div class="d-flex align-items-center gap-3">
<div class="sv-hcta-icon"><i class="fa-solid fa-phone"></i></div>
<div>
  <div style="font-weight:800;font-size:15px;color:#111">Ready when you are</div>
  <div style="font-size:13px;color:#666">Speak to the Peterborough team directly</div>
</div>
</div>
<div class="d-flex flex-wrap gap-3">
<a href="tel:01733569998" class="btn sv-btn-dk rounded-pill px-4 py-2 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.5px">CALL NOW 01733 569998</a>
<a href="/booking/order" class="btn sv-btn-red rounded-pill px-4 py-2 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.5px">BOOK YOUR CAR SERVICE</a>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 4 — IMPORTANCE OF SERVICING YOUR CAR
================================================ --}}
<section class="sv-importance">
<div class="container">
<div class="row align-items-center g-5">
<div class="col-lg-6">
<h2 class="" style="margin-bottom:24px">IMPORTANCE OF<br>SERVICING YOUR CAR</h2>
 <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Regular car servicing keeps your vehicle safe, reliable, and performing at its best. It helps detect issues early, reduces the risk of breakdowns, and prevents costly repairs in the future.</p>
 <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">With routine maintenance, you can improve fuel efficiency, extend the life of key components like brakes and tyres, and ensure your car remains roadworthy at all times. It also reduces unexpected failures, improves driving safety, and helps avoid major mechanical problems before they develop.</p>
</div>
<div class="col-lg-6">
<div class="ps-lg-4">
  <div class="sv-imp-item">
    <div class="sv-imp-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
    <div>
      <div class="sv-imp-title">Early Issue Detection</div>
      <p class="sv-imp-desc">Spot faults before they become costly repairs.</p>
    </div>
  </div>
  <div class="sv-imp-item">
    <div class="sv-imp-icon"><i class="fa-solid fa-gas-pump"></i></div>
    <div>
      <div class="sv-imp-title">Better Fuel Efficiency</div>
      <p class="sv-imp-desc">Well-maintained engines use less fuel.</p>
    </div>
  </div>
  <div class="sv-imp-item">
    <div class="sv-imp-icon"><i class="fa-solid fa-gauge-high"></i></div>
    <div>
      <div class="sv-imp-title">Longer Component Life</div>
      <p class="sv-imp-desc">Extends the life of brakes, tyres &amp; more.</p>
    </div>
  </div>
  <div class="sv-imp-item">
    <div class="sv-imp-icon"><i class="fa-solid fa-check"></i></div>
    <div>
      <div class="sv-imp-title">Fewer Breakdowns</div>
      <p class="sv-imp-desc">Reduces unexpected failures &amp; downtime.</p>
    </div>
  </div>
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 5 — TRUSTED LOCAL CAR GARAGE IN PETERBOROUGH
================================================ --}}
<section class="sv-local">
<div class="container">
<div class="row align-items-center g-5">
<div class="col-lg-6">
<h2 class="" style="margin-bottom:24px">TRUSTED LOCAL CAR GARAGE IN PETERBOROUGH</h2>
<div class="sv-local-text">
   <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Smartfit Autos is a trusted local car garage in Peterborough, known for delivering honest, reliable, and high-quality automotive care for all makes and models. Our skilled mechanics are committed to providing expert workmanship, fair pricing, and complete customer satisfaction, ensuring your vehicle always receives the best possible care.</p>
   <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Conveniently based in Peterborough, we make professional car servicing easy and accessible whenever you need it. Whether it's routine maintenance or detailed repairs, we focus on keeping your car safe, reliable, and road-ready with a service you can trust every time.</p>
</div>
</div>
<div class="col-lg-6">
<div class="sv-local-img">
  <img src="{{ $svGarageImg }}" alt="Trusted local car garage in Peterborough – Smartfit Autos workshop">
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 6 — BOOK YOUR CAR SERVICE IN PETERBOROUGH TODAY
================================================ --}}
<section class="sv-bookcta">
<div class="sv-bookcta-bg" style="background-image:url('{{ $svLiftImg }}')"></div>
<div class="container">
<div class="sv-bookcta-inner">
<p class="display-4 fw-extrabold text-white opacity-1" style="opacity: 1 !important;font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">BOOK YOUR CAR SERVICE IN PETERBOROUGH TODAY</p>
 <p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important; font-size: 18px; color: white;">Don't wait for small issues to turn into expensive repairs. Keep your vehicle in top condition with Smartfit Autos.</p>
<div class="d-flex flex-wrap justify-content-center gap-3">
<a href="/booking/order" class="btn sv-btn-red rounded-pill px-5 py-3 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.8px">SCHEDULE YOUR SERVICE TODAY &rarr;</a>
<a href="tel:01733569998" class="btn sv-btn-wh rounded-pill px-5 py-3 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.8px">CALL NOW 01733 569998 &rarr;</a>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 7 — WHY CHOOSE SMARTFIT AUTOS FOR CAR SERVICING
================================================ --}}
<section class="sv-why">
<div class="container">
<div class="text-center mb-5">
<h2 class="" style="color:#111">WHY CHOOSE SMARTFIT AUTOS FOR<br>CAR SERVICING</h2>
</div>
<div class="row g-3">
<div class="col-lg-6">
<div class="sv-wcard">
  <div class="sv-wheader">
    <span class="sv-wnum">01</span>
    <h3 class="sv-wtitle">EXPERT MECHANICS</h3>
  </div>
   <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Our trained mechanics have years of experience handling all types of vehicles, ensuring accurate diagnosis and dependable repairs every time.</p>
</div>
</div>
<div class="col-lg-6">
<div class="sv-wcard">
  <div class="sv-wheader">
    <span class="sv-wnum">02</span>
    <h3 class="sv-wtitle">AFFORDABLE CAR SERVICING PACKAGES</h3>
  </div>
   <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We provide cost-effective service packages designed to suit different budgets while maintaining high standards of quality and safety.</p>
</div>
</div>
<div class="col-lg-6">
<div class="sv-wcard">
  <div class="sv-wheader">
    <span class="sv-wnum">03</span>
    <h3 class="sv-wtitle">ADVANCED DIAGNOSTIC EQUIPMENT</h3>
  </div>
   <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We use modern diagnostic tools to quickly identify issues, allowing for precise repairs and reduced downtime for your vehicle.</p>
</div>
</div>
<div class="col-lg-6">
<div class="sv-wcard">
  <div class="sv-wheader">
    <span class="sv-wnum">04</span>
    <h3 class="sv-wtitle">ALL MAKES &amp; MODELS SERVICED</h3>
  </div>
   <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">From small cars to SUVs and commercial vehicles, we offer expert servicing for all makes and models with complete care.</p>
</div>
</div>
<div class="col-lg-6">
<div class="sv-wcard">
  <div class="sv-wheader">
    <span class="sv-wnum">05</span>
    <h3 class="sv-wtitle">QUICK TURNAROUND TIMES</h3>
  </div>
   <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We work efficiently to complete services on time, helping you get back on the road without unnecessary delays.</p>
</div>
</div>
<div class="col-lg-6">
<div class="sv-wcard">
  <div class="sv-wheader">
    <span class="sv-wnum">06</span>
    <h3 class="sv-wtitle">TRUSTED LOCAL GARAGE</h3>
  </div>
   <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We are a reliable local garage in Peterborough, known for honest service, quality workmanship, and long-term customer trust.</p>
</div>
</div>
</div>
</div>
</section>

{{-- Load Leaflet from jsDelivr --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css">

{{-- ================================================
SECTION 8 — WE SERVE PETERBOROUGH AND SURROUNDING AREAS
================================================ --}}
<section class="sv-areas">
<div class="container">
<div class="text-center mb-5">
<h2 class="" style="color:#111">WE SERVE PETERBOROUGH AND<br>SURROUNDING AREAS</h2>
</div>
<div class="row g-5 align-items-center">
<div class="col-lg-5">
<p style="font-size:14px;color:#555;line-height:1.82;margin-bottom:26px">Trusted car service in Peterborough and nearby areas. Smartfit Autos offers fast, reliable and affordable vehicle servicing and repairs. We handle routine maintenance and urgent repairs with expert care and quick turnaround times you can trust.</p>
<div class="d-flex flex-wrap gap-2">
  @php
  $mapAreas = [
      ['Peterborough', 52.5695, -0.2405],
      ['Stamford',     52.6510, -0.4810],
      ['Whittlesey',   52.5574, -0.1315],
      ['Crowland',     52.6756, -0.1661],
      ['Bourne',       52.7686, -0.3770],
      ['Huntingdon',   52.3304, -0.1867],
      ['Oundle',       52.4820, -0.4700],
      ['Sawtry',       52.4370, -0.2830],
      ['Ramsey',       52.4490, -0.1060],
      ['St Ives',      52.3270, -0.0760]
  ];
  @endphp
  @foreach($mapAreas as $idx => [$name, $lat, $lng])
  <button type="button" class="sv-abtn {{ $idx === 0 ? 'active' : '' }}" onclick="svGoTo({{ $idx }}, this)">{{ $name }}</button>
  @endforeach
</div>
</div>
<div class="col-lg-7">
<div id="svAreaMap" data-bs-theme="light"
  style="height:380px;border-radius:12px;overflow:hidden;border:1px solid #e4e4e4;">
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 9 — WHAT OUR CUSTOMERS SAY
================================================ --}}
<section class="py-5" style="background: #F2F2F4 !important;">
<div class="container py-4">
<div class="text-center mb-5">
    <h2 class="display-4 fw-extrabold text-dark mb-0" style="font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
        WHAT OUR CUSTOMERS SAY
    </h2>
</div>

<div class="home_reviews_slider_wrap position-relative">
    <div class="home_reviews_carousel">
        {{-- Review 1 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Fantastic work on my BMW. Needed an MOT and they fitted me in the same day. Got my car back within 2 hours after they sorted the tyres, so I was good to go.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    AMINATOU SMART
                </div>
            </div>
        </div>

        {{-- Review 2 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    They're always so polite, professional and honest about their ability to help. They've even done small favours that have gone above and beyond what I would have expected.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    ABE THOMAS
                </div>
            </div>
        </div>

        {{-- Review 3 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Took my car in for an MOT, they were very accommodating and efficient with their work. Good prices and an overall top service.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    ALEX GRIFFIN
                </div>
            </div>
        </div>

        {{-- Review 4 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Excellent service from the team at Smartfit Autos. Booked full servicing and MOT online. Fast turnaround, transparent pricing, and polite staff.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    DAVID MILLER
                </div>
            </div>
        </div>

        {{-- Review 5 --}}
        <div class="px-2 h-100">
            <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                    Brilliant garage! Had brake repair and disc replacements completed on the same day without any hassle. Highly recommend their experienced technicians.
                </p>
                <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                    SARAH JENKINS
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <button type="button" class="btn btn-light rounded-circle d-flex align-items-center justify-content-center p-0 reviews_arrow_left" style="width: 42px; height: 42px; border: 1px solid #ddd; background: #fff; cursor: pointer; transition: all 0.2s ease;">
        <i class="fa-solid fa-arrow-left text-dark small"></i>
    </button>
    <button type="button" class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center p-0 reviews_arrow_right" style="width: 42px; height: 42px; background-color: #ED1E24; border-color: #ED1E24; cursor: pointer; transition: all 0.2s ease;">
        <i class="fa-solid fa-arrow-right text-white small"></i>
    </button>
</div>
</div>
</section>

<style>
.home_reviews_carousel .slick-track {
display: flex !important;
}
.home_reviews_carousel .slick-slide {
height: inherit !important;
display: flex !important;
}
.home_reviews_carousel .slick-slide > div {
display: flex;
width: 100%;
}
.reviews_arrow_left:hover {
background: #f0f0f0 !important;
border-color: #bbb !important;
}
.reviews_arrow_right:hover {
background: #c41019 !important;
border-color: #c41019 !important;
}
</style>

<script>
(function() {
function initReviewsSlider() {
if (window.jQuery && jQuery.fn.slick && jQuery('.home_reviews_carousel').length) {
    if (!jQuery('.home_reviews_carousel').hasClass('slick-initialized')) {
        jQuery('.home_reviews_carousel').slick({
            dots: false,
            arrows: true,
            prevArrow: '.reviews_arrow_left',
            nextArrow: '.reviews_arrow_right',
            infinite: true,
            autoplay: true,
            autoplaySpeed: 3500,
            speed: 600,
            slidesToShow: 3,
            slidesToScroll: 1,
            pauseOnHover: true,
            pauseOnFocus: false,
            swipeToSlide: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }
}
}

if (document.readyState === 'complete' || document.readyState === 'interactive') {
setTimeout(initReviewsSlider, 100);
} else {
document.addEventListener('DOMContentLoaded', initReviewsSlider);
}
window.addEventListener('load', initReviewsSlider);
})();
</script>

{{-- ================================================
SECTION 10 — FREQUENTLY ASKED QUESTIONS
================================================ --}}
<section class="sv-faq">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-9">
<div class="text-center mb-5">
  <h2 class="sv-sec-title" style="color:#111">FREQUENTLY ASKED QUESTIONS</h2>
</div>
<div class="sv-fitem open" id="svF1">
  <h3 class="sv-fq fm-fq" onclick="svFaq('svF1')"><span>What car services do you offer in Peterborough?</span><div class="sv-ficon"></div></h3>
  <div class="sv-fa"> <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">We offer full, interim, and major car servicing along with diagnostics, brake checks, oil changes, and general vehicle maintenance for all makes and models.</p></div>
</div>
<div class="sv-fitem" id="svF2">
  <h3 class="sv-fq fm-fq" onclick="svFaq('svF2')"><span>How often should I get my car serviced?</span><div class="sv-ficon"></div></h3>
  <div class="sv-fa"> <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Most vehicles should be serviced every 6–12 months or every 6,000–12,000 miles, depending on usage and manufacturer guidelines.</p></div>
</div>
<div class="sv-fitem" id="svF3">
  <h3 class="sv-fq fm-fq" onclick="svFaq('svF3')"><span>Do you service all car makes and models?</span><div class="sv-ficon"></div></h3>
  <div class="sv-fa"> <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Yes, Smartfit Autos provides professional servicing for all makes and models, including petrol, diesel, hybrid, and commercial vehicles.</p></div>
</div>
<div class="sv-fitem" id="svF4">
  <h3 class="sv-fq fm-fq" onclick="svFaq('svF4')"><span>How long does a car service take?</span><div class="sv-ficon"></div></h3>
  <div class="sv-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Service time depends on the type of service. An interim service may take 1–2 hours, while a full or major service may take longer.</p></div>
</div>
<div class="sv-fitem" id="svF5">
  <h3 class="sv-fq fm-fq" onclick="svFaq('svF5')"><span>Do you provide repairs along with servicing?</span><div class="sv-ficon"></div></h3>
  <div class="sv-fa"> <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Yes, along with servicing, we also handle repairs including brakes, suspension, diagnostics, and other mechanical issues if needed.</p></div>
</div>
</div>
</div>
</div>
</section>

{{-- ================================================
SECTION 11 — FINAL CTA
================================================ --}}
<section class="sv-fcta">
<div class="sv-fcta-bg" style="background-image:url('{{ $svBrakeImg }}')"></div>
<div class="container">
<div class="sv-fcta-inner">
<p class="display-4 fw-extrabold text-white opacity-1" style="opacity: 1 !important;font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">GET YOUR CAR SERVICED BY LOCAL EXPERTS</p>
 <p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important; font-size: 18px; color:white;">Smartfit Autos offers reliable, affordable car servicing in Peterborough. Book your slot today.</p>
<div class="d-flex flex-wrap justify-content-center gap-3">
<a href="/booking/order" class="btn sv-btn-red rounded-pill px-5 py-3 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.8px">BOOK YOUR CAR SERVICE &rarr;</a>
<a href="tel:01733569998" class="btn sv-btn-red-out rounded-pill px-5 py-3 fw-bold text-uppercase" style="font-size:13px;letter-spacing:.8px">CALL NOW 01733 569998 &rarr;</a>
</div>
</div>
</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>
<script>
/* ---- Servicing FAQ accordion ---- */
function svFaq(id){
var el=document.getElementById(id);
var was=el.classList.contains('open');
document.querySelectorAll('.sv-fitem').forEach(function(i){i.classList.remove('open')});
if(!was) el.classList.add('open');
}

/* ---- Servicing interactive map: Leaflet + CartoDB Voyager tiles ---- */
(function(){
var locs = [
{name:"Peterborough", lat:52.5695, lng:-0.2405},
{name:"Stamford",     lat:52.6510, lng:-0.4810},
{name:"Whittlesey",   lat:52.5574, lng:-0.1315},
{name:"Crowland",     lat:52.6756, lng:-0.1661},
{name:"Bourne",       lat:52.7686, lng:-0.3770},
{name:"Huntingdon",   lat:52.3304, lng:-0.1867},
{name:"Oundle",       lat:52.4820, lng:-0.4700},
{name:"Sawtry",       lat:52.4370, lng:-0.2830},
{name:"Ramsey",       lat:52.4490, lng:-0.1060},
{name:"St Ives",      lat:52.3270, lng:-0.0760}
];
var map, markers = [];
function initServicingMap(){
var el = document.getElementById('svAreaMap');
if(!el || el._leaflet_id || typeof L === 'undefined') return;
map = L.map('svAreaMap', {scrollWheelZoom: false, zoomControl: true}).setView([52.5695, -0.2405], 10);
L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/">CARTO</a>',
subdomains: 'abcd',
maxZoom: 19
}).addTo(map);
var redPin = L.divIcon({
className: 'sv-map-pin',
html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 42" width="28" height="42"><path d="M14 0C8.48 0 4 4.48 4 10c0 7.5 10 26 10 26s10-18.5 10-26C24 4.48 19.52 0 14 0z" fill="#ED1E24"/><circle cx="14" cy="10" r="5.5" fill="#fff"/></svg>',
iconSize:   [28, 42],
iconAnchor: [14, 42],
popupAnchor:[0, -42]
});
locs.forEach(function(l, i){
var m = L.marker([l.lat, l.lng], {icon: redPin}).addTo(map)
       .bindPopup('<b style="color:#ED1E24;font-size:15px;">'+l.name+'</b><br><small style="color:#555;">Smartfit Autos Car Servicing Area</small>');
m.on('click', function(){
var btns = document.querySelectorAll('.sv-abtn');
btns.forEach(function(b){ b.classList.remove('active'); });
if(btns[i]) btns[i].classList.add('active');
});
markers.push(m);
});
setTimeout(function(){ if(map) map.invalidateSize(); }, 300);
}
window.svGoTo = function(idx, btn) {
document.querySelectorAll('.sv-abtn').forEach(function(b){ b.classList.remove('active'); });
if(btn) btn.classList.add('active');
if(map && locs[idx]){
map.flyTo([locs[idx].lat, locs[idx].lng], 12, {animate: true, duration: 0.8});
if(markers[idx]) markers[idx].openPopup();
}
};
if(document.readyState==='complete'){ setTimeout(initServicingMap, 150); }
else { window.addEventListener('load', function(){ setTimeout(initServicingMap, 150); }); }
window.addEventListener('resize', function(){ if(map) map.invalidateSize(); });
})();
</script>

@elseif($currentSlug === 'mot' || $currentSlug === 'mot-peterborough' || $currentSlug === 'mots')
@livewire('components.mot.ispis-mota')

@else
{{-- All other CMS pages render normally --}}
{!! $item->renderBlocks() !!}
@endif
@endif

@if (isset($lw))
@livewire($lw, ['slug' => $slug])
@endif

</main>

<x-footer/>

</div>
<!-- Body Wrap - End -->

@include('frontend.inc.js')

<script>
document.addEventListener('DOMContentLoaded', function () {

document.querySelectorAll('h1').forEach(function (heading) {

// Add classes
heading.classList.add('fw-extrabold','display-1','text-uppercase');
// Add inline styles
heading.style.fontFamily = 'Montserrat';
heading.style.fontWeight = '800';
heading.style.lineHeight = '100%';
heading.style.letterSpacing = '0px';
heading.style.verticalAlign = 'middle';
});
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
document.querySelectorAll('h2').forEach(function (heading) {
// Add classes
heading.classList.add('display-4','fw-extrabold','text-uppercase');
// Add inline styles
heading.style.fontFamily = 'Montserrat';
heading.style.fontWeight = '800';
heading.style.setProperty('line-height', '100%', 'important');
heading.style.letterSpacing = '0px';
heading.style.verticalAlign = 'middle';
});
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
document.querySelectorAll('h3').forEach(function (heading) {
// Add classes
heading.classList.add('fw-bold','text-uppercase');
// Add inline styles
heading.style.fontFamily = 'Mulish';
heading.style.setProperty('font-weight', '800', 'important');
heading.style.setProperty('font-size', '25px', 'important');
heading.style.lineHeight = '30.4px';
heading.style.letterSpacing = '-0.19px';
heading.style.verticalAlign = 'middle';

});

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
document.querySelectorAll('ul li').forEach(function (item) {
item.style.color = '#444';
item.style.setProperty('font-size', '18px', 'important');
item.style.fontFamily = 'Mulish';

});

});
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const mobileBtn = document.getElementById('site_mobile_toggle_btn');
    const mobileMenu = document.getElementById('main_menu_dropdown');
    const megaItems = document.querySelectorAll('.dropdown_fleet_item, .dropdown_services_item, .dropdown_mot_item, .dropdown_tyres_item, .dropdown_repairs_item');

    // Mobile Toggle Handler
    if (mobileBtn && mobileMenu) {
      mobileBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const isOpen = mobileMenu.classList.contains('show');
        if (isOpen) {
          mobileMenu.classList.remove('show');
          mobileBtn.setAttribute('aria-expanded', 'false');
        } else {
          mobileMenu.classList.add('show');
          mobileBtn.setAttribute('aria-expanded', 'true');
        }
      });
    }

    // Setup mega menus (Fleet, Services, MOT, Tyres, Repairs)
    megaItems.forEach(function(item) {
      const link = item.querySelector('a.nav-link');
      const menu = item.querySelector('.fleet_mega_menu, .services_mega_menu, .mot_mega_menu, .tyres_mega_menu, .repairs_mega_menu');
      if (!link || !menu) return;

      link.addEventListener('click', function(e) {
        if (window.innerWidth < 992) {
          e.preventDefault();
          e.stopPropagation();
          const isOpen = menu.classList.contains('show');
          
          // Close other mega menus
          megaItems.forEach(function(other) {
            if (other !== item) {
              const otherMenu = other.querySelector('.fleet_mega_menu, .services_mega_menu, .mot_mega_menu, .tyres_mega_menu, .repairs_mega_menu');
              const otherLink = other.querySelector('a.nav-link');
              if (otherMenu) otherMenu.classList.remove('show');
              other.classList.remove('show');
              if (otherLink) otherLink.setAttribute('aria-expanded', 'false');
            }
          });

          if (isOpen) {
            menu.classList.remove('show');
            item.classList.remove('show');
            link.setAttribute('aria-expanded', 'false');
          } else {
            menu.classList.add('show');
            item.classList.add('show');
            link.setAttribute('aria-expanded', 'true');
          }
        }
      });
    });

    // Close when clicking outside
    document.addEventListener('click', function(e) {
      if (mobileMenu && !mobileMenu.contains(e.target) && mobileBtn && !mobileBtn.contains(e.target)) {
        if (mobileMenu.classList.contains('show')) {
          mobileMenu.classList.remove('show');
          mobileBtn.setAttribute('aria-expanded', 'false');
        }
      }
      megaItems.forEach(function(item) {
        if (!item.contains(e.target)) {
          const menu = item.querySelector('.fleet_mega_menu, .services_mega_menu, .mot_mega_menu, .tyres_mega_menu, .repairs_mega_menu');
          const link = item.querySelector('a.nav-link');
          if (menu) menu.classList.remove('show');
          item.classList.remove('show');
          if (link) link.setAttribute('aria-expanded', 'false');
        }
      });
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        if (mobileMenu && window.innerWidth < 992) {
          mobileMenu.classList.remove('show');
          if (mobileBtn) mobileBtn.setAttribute('aria-expanded', 'false');
        }
        megaItems.forEach(function(item) {
          const menu = item.querySelector('.fleet_mega_menu, .services_mega_menu, .mot_mega_menu, .tyres_mega_menu, .repairs_mega_menu');
          const link = item.querySelector('a.nav-link');
          if (menu) menu.classList.remove('show');
          item.classList.remove('show');
          if (link) link.setAttribute('aria-expanded', 'false');
        });
      }
    });
  });
</script>

</body>
</html>