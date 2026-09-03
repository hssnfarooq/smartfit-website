<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

@if(request()->is('/'))
<link rel="preload" as="image" href="{{ asset('assets/images/home/hero-range-rover.webp') }}" fetchpriority="high">
@endif

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&amp;display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&amp;display=swap">

<!-- Fraimwork - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

<!-- Icon Font - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}"></noscript>

@unless(request()->is('/'))
<!-- Animation - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}"></noscript>

<!-- Cursor - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/cursor.css') }}" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" type="text/css" href="{{ asset('assets/css/cursor.css') }}"></noscript>
@endunless

<!-- Carousel - CSS Include -->
<link id="smartfit-slick-css" rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}" media="print" onload="this.media='all'">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}"><link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}"></noscript>

@unless(request()->is('/'))
<!-- Video & Image Popup - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}"></noscript>

<!-- Leaflet Map CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css"></noscript>

<!-- Vanilla Calendar - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vanilla-calendar.min.css') }}" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vanilla-calendar.min.css') }}"></noscript>

<!-- Counter - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/odometer.css') }}" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" type="text/css" href="{{ asset('assets/css/odometer.css') }}"></noscript>
@endunless

<!-- Pricing Range - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}">

<!-- Custom - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/moj.css') }}?v={{ filemtime(public_path('assets/css/moj.css')) }}">

@if(isset($chekout))
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/checkout.css') }}?v={{ filemtime(public_path('assets/css/checkout.css')) }}">
@endif

@livewireStyles

<style>
.btn, .btn-danger, .btn-primary, .btn-secondary, button {
  -webkit-clip-path: none !important;
  clip-path: none !important;
}
.btn::before, .btn::after,
.btn-danger::before, .btn-danger::after,
.btn-primary::before, .btn-primary::after {
  display: none !important;
  content: none !important;
  opacity: 0 !important;
}
</style>

{!! CookieConsent::styles() !!}
