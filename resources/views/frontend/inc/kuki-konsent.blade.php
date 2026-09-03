{!! CookieConsent::scripts() !!}

<script>
function loadGoogleAnalytics() {
    if (window.__smartfitAnalyticsScheduled) {
        return;
    }
    window.__smartfitAnalyticsScheduled = true;
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

    // Consent has already been granted. Queue the page view immediately, but
    // download and execute Analytics after the page's critical rendering work.
    const loadScript = function() {
        const script = document.createElement('script');
        script.src = 'https://www.googletagmanager.com/gtag/js?id={{ env('GOOGLE_ANALYTICS_ID') }}';
        script.async = true;
        document.head.appendChild(script);
    };

    if ('requestIdleCallback' in window) {
        window.requestIdleCallback(loadScript, { timeout: 3000 });
    } else {
        window.setTimeout(loadScript, 2500);
    }
}

</script>
