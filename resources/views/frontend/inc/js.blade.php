<!-- Fraimwork - Jquery Include -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-dropdown-ml-hack.js') }}"></script>

@unless(request()->is('/'))
<!-- Animation - jquery include -->
<script src="{{ asset('assets/js/cursor.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/tilt.min.js') }}"></script>
<script src="{{ asset('assets/js/parallaxie.js') }}"></script>
<script src="{{ asset('assets/js/parallax-scroll.js') }}"></script>

<!-- Text Animation - Jquery Include -->
<script src="{{ asset('assets/js/splitting.min.js') }}"></script>
@endunless

<!-- Carousel - Jquery Include -->
<script src="{{ asset('assets/js/slick.min.js') }}"></script>

@unless(request()->is('/'))
<!-- Video & Image Popup - Jquery Include -->
<script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>

<!-- Counter - Jquery Include -->
<script src="{{ asset('assets/js/appear.js') }}"></script>
<script src="{{ asset('assets/js/odometer.min.js') }}"></script>

<!-- Countdown Timer - jquery include -->
<script src="{{ asset('assets/js/countdown.js') }}"></script>

<!-- Vanilla Calendar - Jquery Include -->
<script src="{{ asset('assets/js/vanilla-calendar.min.js') }}"></script>

<!-- Image Before After - Jquery Include -->
<script src="{{ asset('assets/js/imagebeforeafter.js') }}"></script>
@endunless

<!-- Pricing Range - Jquery Include -->
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>

@unless(request()->is('/'))
<!-- Dark & Light Mode - Jquery Include -->
<script src="{{ asset('assets/js/dark-light.js') }}"></script>

<!-- Custom - Jquery Include -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Leaflet Map JS -->
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js"></script>
@else
<script>
(function($) {
    $(window).on('scroll', function() {
        $('.backtotop').toggle($(this).scrollTop() > 200);
    });
    $('.backtotop .scroll').on('click', function(event) {
        event.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    $('.dropdown').on('mouseenter', function() {
        $(this).children('.dropdown-menu').addClass('show');
    }).on('mouseleave', function() {
        $(this).children('.dropdown-menu').removeClass('show');
    });
})(jQuery);
</script>
@endunless

@include('frontend.inc.kuki-konsent')

@stack('scripts')

@livewireScripts
