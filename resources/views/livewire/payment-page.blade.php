<div class="payment-page">
  <section class="payment-hero">
    <div class="container">
      <nav class="payment-breadcrumb" aria-label="Breadcrumb">
        <a href="/">Home</a>
        <span aria-hidden="true">/</span>
        <a href="/booking/order">Booking</a>
        <span aria-hidden="true">/</span>
        <span aria-current="page">Payment</span>
      </nav>
      <p class="payment-eyebrow">Secure checkout</p>
      <h1>Complete Your Booking</h1>
      <p>Review your booking and choose your preferred payment method.</p>
    </div>
  </section>

  <section class="payment-section">
    <div class="container">
      @if (!empty($redirekt))
        <div class="payment-status-card payment-status-card--warning" role="alert">
          <span class="payment-status-icon" aria-hidden="true">!</span>
          <div>
            <h2>Your session has expired</h2>
            <p>Please return to the booking page to confirm your details and services.</p>
            <a class="payment-primary-link" href="{{ $redirekt }}">Return to booking</a>
          </div>
        </div>
      @else
        <div class="payment-layout">
          <main class="payment-panel" aria-labelledby="payment-method-heading">
            <div class="payment-panel-heading">
              <div>
                <p class="payment-step">Payment details</p>
                <h2 id="payment-method-heading">Choose how to pay</h2>
              </div>
              <span class="payment-secure-badge">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 10V7a5 5 0 0 1 10 0v3m-11 0h12a1 1 0 0 1 1 1v9H5v-9a1 1 0 0 1 1-1Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Secure
              </span>
            </div>

            <div class="payment-method-support" aria-label="Supported payment methods">
              <span>Card</span>
              <span>Klarna</span>
              <span>Revolut Pay</span>
              <span>Link</span>
            </div>
            <p class="payment-method-eligibility">Available options are shown securely by Stripe based on the booking total and customer eligibility.</p>

            @if ($paymentSetupError)
              <div class="payment-alert payment-alert--error" role="alert">
                {{ $paymentSetupError }}
              </div>
              <a class="payment-primary-link" href="/booking/payment">Try again</a>
            @else
              <form id="payment-form" class="payment-form">
                <div id="payment-element" aria-live="polite"></div>
                <div id="payment-message" class="payment-alert payment-alert--error hidden" role="alert"></div>
                <button id="submit" class="payment-submit" type="submit">
                  <span class="payment-spinner hidden" id="spinner" aria-hidden="true"></span>
                  <span id="button-text">Pay {{ $total }}</span>
                </button>
              </form>
              <div class="payment-provider-note">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3 5 6v5c0 4.6 2.8 8.4 7 10 4.2-1.6 7-5.4 7-10V6l-7-3Z" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="m9 12 2 2 4-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Your payment details are encrypted and processed securely by Stripe.
              </div>
            @endif
          </main>

          <aside class="payment-summary" aria-labelledby="booking-summary-heading">
            <div class="payment-summary-heading">
              <div>
                <p class="payment-step">Your booking</p>
                <h2 id="booking-summary-heading">Order summary</h2>
              </div>
              <a href="/booking/order">Edit</a>
            </div>

            @if ($vehicleRegistration)
              <div class="payment-vehicle">
                <span>Vehicle</span>
                <strong>{{ strtoupper($vehicleRegistration) }}</strong>
              </div>
            @endif

            <ul class="payment-items">
              @foreach ($orderLines as $line)
                <li>
                  <div>
                    <strong>{{ $line['description'] }}</strong>
                    @if ($line['quantity'] > 1)
                      <span>Quantity: {{ $line['quantity'] }}</span>
                    @endif
                  </div>
                  <span>{{ $line['total'] }}</span>
                </li>
              @endforeach
            </ul>

            <dl class="payment-totals">
              <div><dt>Subtotal</dt><dd>{{ $subtotal }}</dd></div>
              <div><dt>VAT</dt><dd>{{ $tax }}</dd></div>
              <div class="payment-total"><dt>Total to pay</dt><dd>{{ $total }}</dd></div>
            </dl>

            @if ($customerEmail)
              <p class="payment-receipt-note">Your booking confirmation will be sent to <strong>{{ $customerEmail }}</strong>.</p>
            @endif
          </aside>
        </div>
      @endif
    </div>
  </section>

  @if (empty($redirekt) && empty($paymentSetupError))
    @push('scripts')
      <script src="https://js.stripe.com/v3/"></script>
      <script>
        (() => {
          const form = document.querySelector('#payment-form');
          if (!form || form.dataset.initialised === 'true') return;
          form.dataset.initialised = 'true';

          const stripe = Stripe(@json(config('services.stripe.public_key')));
          const elements = stripe.elements({
            clientSecret: @json($clientSecret),
            appearance: {
              theme: 'stripe',
              variables: {
                colorPrimary: '#ed1e24',
                colorText: '#19181d',
                colorDanger: '#b42318',
                colorBackground: '#ffffff',
                borderRadius: '10px',
                fontFamily: 'Mulish, Arial, sans-serif',
                spacingUnit: '4px'
              }
            }
          });

          elements.create('payment', {
            layout: 'tabs',
            defaultValues: {
              billingDetails: {
                email: @json($customerEmail),
                address: { country: 'GB' }
              }
            }
          }).mount('#payment-element');
          form.addEventListener('submit', handleSubmit);

          async function handleSubmit(event) {
            event.preventDefault();
            setLoading(true);

            try {
              const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                  return_url: @json(url(env('STRIPE_PAYMENT_RESPONSE')))
                }
              });

              if (error) {
                showMessage(error.message || 'Your payment could not be completed. Please try again.');
              }
            } catch (error) {
              showMessage('We could not contact the payment service. Please check your connection and try again.');
            } finally {
              setLoading(false);
            }
          }

          function showMessage(message) {
            const container = document.querySelector('#payment-message');
            container.textContent = message;
            container.classList.remove('hidden');
            container.focus?.();
          }

          function setLoading(isLoading) {
            const button = document.querySelector('#submit');
            button.disabled = isLoading;
            document.querySelector('#spinner').classList.toggle('hidden', !isLoading);
            document.querySelector('#button-text').classList.toggle('hidden', isLoading);
          }
        })();
      </script>
    @endpush
  @endif
</div>
