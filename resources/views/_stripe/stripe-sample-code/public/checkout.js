// This is your test secret API key.
const stripe = Stripe("pk_test_51PdsIHLi2eGpOXQtx249mcTLaaOfnEAVaVGqQl1uzbg26yFQztI3zRWjtlCh7A81KxGbsscHebPDa3nQGi0A4cmg00Ba8mmyz2");

initialize();

// Create a Checkout Session
async function initialize() {
  const fetchClientSecret = async () => {
    const response = await fetch("/checkout.php", {
      method: "POST",
    });
    const { clientSecret } = await response.json();
    return clientSecret;
  };

  const checkout = await stripe.initEmbeddedCheckout({
    fetchClientSecret,
  });

  // Mount Checkout
  checkout.mount('#checkout');
}