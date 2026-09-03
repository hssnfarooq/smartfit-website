@php
    $items = App\Models\Testimonial::where('published', 1)->get();
@endphp
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-extrabold text-uppercase text-dark mb-0" style="font-weight: 900; letter-spacing: 1px;">
                WHAT OUR CUSTOMERS SAY
            </h2>
        </div>

        <div class="row g-4 justify-content-center">
            @if (count($items) > 0)
                @foreach ($items->take(3) as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 rounded-3 shadow-sm p-4 bg-light">
                        <div class="d-flex gap-1 text-warning mb-3" style="font-size: 14px;">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6; font-size: 13px;">
                            "{{ $item->description }}"
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark small" style="font-weight: 800; letter-spacing: 0.5px;">
                            {{ $item->name ? $item->name : $item->title }}
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 rounded-3 shadow-sm p-4 bg-light">
                        <div class="d-flex gap-1 text-warning mb-3" style="font-size: 14px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6; font-size: 13px;">
                            "Fantastic work on my BMW. Needed an MOT and they fitted me in the same day. Got my car back within 2 hours after they sorted the tyres, so I was good to go."
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark small" style="font-weight: 800; letter-spacing: 0.5px;">
                            AMINATOU SMART
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 rounded-3 shadow-sm p-4 bg-light">
                        <div class="d-flex gap-1 text-warning mb-3" style="font-size: 14px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6; font-size: 13px;">
                            "They're always so polite, professional and honest about their ability to help. They've even done small favours that have gone above and beyond what I would have expected."
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark small" style="font-weight: 800; letter-spacing: 0.5px;">
                            ABE THOMAS
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 rounded-3 shadow-sm p-4 bg-light">
                        <div class="d-flex gap-1 text-warning mb-3" style="font-size: 14px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6; font-size: 13px;">
                            "Took my car in for an MOT, they were very accommodating and efficient with their work. Good prices and an overall top service."
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark small" style="font-weight: 800; letter-spacing: 0.5px;">
                            ALEX GRIFFIN
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
