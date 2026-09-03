{!! CookieConsent::scripts() !!}

<script>
function loadGoogleAnalytics() {
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', '{{ env('GOOGLE_ANALYTICS_ID') }}', 
        {
            'cookie_domain': window.location.hostname, // Automatski uzima točnu domenu
            'cookie_flags': 'SameSite=Lax;Secure'
        }
    );

    // Load the GA script
    const script = document.createElement('script');
    script.src = 'https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_ID') }}';
    script.async = true;
    
    document.head.appendChild(script);
}

</script>