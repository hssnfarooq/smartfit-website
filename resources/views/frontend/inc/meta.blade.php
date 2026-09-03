<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

<!-- Fraimwork - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

<!-- Icon Font - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">

<!-- Animation - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">

<!-- Cursor - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/cursor.css') }}">

<!-- Carousel - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick-theme.css') }}">

<!-- Video & Image Popup - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}">

<!-- Leaflet Map CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css">

<!-- Vanilla Calendar - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vanilla-calendar.min.css') }}">

<!-- Counter - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/odometer.css') }}">

<!-- Pricing Range - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}">

<!-- Custom - CSS Include -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/moj.css') }}?v={{date('His')}}">

@if(isset($chekout))
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/checkout.css') }}?v={{date('His')}}">
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