<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-extrabold text-uppercase text-dark mb-0" style="font-weight: 900; letter-spacing: 1px;">
                WHAT OUR CUSTOMERS SAY
            </h2>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach (config('customer_reviews', []) as $review)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 rounded-3 shadow-sm p-4 bg-light">
                        <div class="d-flex gap-1 text-warning mb-3 customer-review-stars" aria-label="5 out of 5 stars">
                            <i class="fa-solid fa-star" aria-hidden="true"></i>
                            <i class="fa-solid fa-star" aria-hidden="true"></i>
                            <i class="fa-solid fa-star" aria-hidden="true"></i>
                            <i class="fa-solid fa-star" aria-hidden="true"></i>
                            <i class="fa-solid fa-star" aria-hidden="true"></i>
                        </div>
                        <p class="text-secondary small mb-4 flex-grow-1 customer-review-text" style="line-height: 1.6; font-size: 13px;">
                            {{ $review['review'] }}
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark small customer-review-name" style="font-weight: 800; letter-spacing: 0.5px;">
                            {{ $review['name'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
