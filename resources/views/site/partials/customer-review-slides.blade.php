@foreach (config('customer_reviews', []) as $review)
    <div class="customer-review-slide h-100">
        <div class="p-4 border bg-white h-100 d-flex flex-column customer-review-card">
            <div class="text-warning mb-3 customer-review-stars" aria-label="5 out of 5 stars">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
            </div>
            <p class="mb-4 flex-grow-1 customer-review-text">
                {{ $review['review'] }}
            </p>
            <div class="fw-extrabold text-uppercase text-dark mt-auto customer-review-name">
                {{ $review['name'] }}
            </div>
        </div>
    </div>
@endforeach
