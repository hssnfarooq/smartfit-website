@php
    $readyCtaBookingHref = $readyCtaBookingHref ?? '/booking/order';
    $readyCtaBookingLabel = $readyCtaBookingLabel ?? 'BOOK ONLINE';
@endphp

<div class="sf-ready-cta" id="ready-when-you-are">
    <div class="sf-ready-cta__message">
        <div class="sf-ready-cta__icon" aria-hidden="true">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div>
            <div class="sf-ready-cta__title">Ready When You Are</div>
            <div class="sf-ready-cta__subtitle">Speak to the Peterborough team directly</div>
        </div>
    </div>

    <div class="sf-ready-cta__actions sf-cta-pair">
        <a href="tel:01733569998" class="sf-cta sf-cta--outline-dark">
            CALL NOW&nbsp; 01733 569998
            <i class="fa-solid fa-arrow-right sf-cta__icon" aria-hidden="true"></i>
        </a>
        <a href="{{ $readyCtaBookingHref }}" class="sf-cta sf-cta--primary">{{ $readyCtaBookingLabel }}</a>
    </div>
</div>
