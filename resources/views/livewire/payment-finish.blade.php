<div class="payment-page">
  <section class="payment-hero">
    <div class="container">
      <nav class="payment-breadcrumb" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <span aria-hidden="true">/</span>
        <a href="/booking/order">Booking</a>
        <span aria-hidden="true">/</span>
        <span aria-current="page">Payment status</span>
      </nav>
      <p class="payment-eyebrow">Secure checkout</p>
      <h1>Booking Payment</h1>
      <p>We are checking your payment and booking status.</p>
    </div>
  </section>

  <section class="payment-section">
    <div class="container">
      @if ($paymentStatus === 'failed')
        <div class="payment-status-card payment-status-card--error" role="alert">
          <span class="payment-status-icon" aria-hidden="true">!</span>
          <div>
            <h2>Payment Not Completed</h2>
            <p>{{ $paymentMessage }}</p>
            <a class="payment-primary-link" href="/booking/payment">Return to payment</a>
          </div>
        </div>
      @elseif ($paymentStatus === 'success')
        <div class="payment-status-card payment-status-card--success" role="status">
          <span class="payment-status-icon" aria-hidden="true">✓</span>
          <div>
            <h2>Payment Confirmed</h2>
            <p>{{ $paymentMessage }}</p>
          </div>
        </div>
      @elseif ($paymentStatus === 'pending')
        <div class="payment-status-card payment-status-card--pending" role="status">
          <span class="payment-status-icon" aria-hidden="true">…</span>
          <div>
            <h2>Payment Processing</h2>
            <p>{{ $paymentMessage }}</p>
            <a class="payment-primary-link" href="/">Return to homepage</a>
          </div>
        </div>
      @else
        <div class="payment-status-card" role="status" aria-live="polite">
          <span class="payment-status-icon" aria-hidden="true">
            <span class="payment-spinner"></span>
          </span>
          <div>
            <h2>Confirming Your Payment</h2>
            <p>{{ $paymentMessage }}</p>
          </div>
        </div>
      @endif
    </div>
  </section>

  @if (!empty($redirekt))
    @push('scripts')
      <script>
        window.location.replace(@json($redirekt));
      </script>
    @endpush
  @endif
</div>
