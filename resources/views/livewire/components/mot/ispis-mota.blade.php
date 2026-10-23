<div>
    <style>
        .page_banner, .details_section { display: none !important; }

        /* ── RESET any global btn clip-path / pseudo-elements ─────────── */
        .mot-hero .btn,
        .mot-pricing-card .btn,
        .mot-steps-section .btn,
        .mot-cta-banner .btn,
        .mot-contact-box .btn {
            -webkit-clip-path: none !important;
            clip-path: none !important;
            position: relative !important;
            box-shadow: none !important;
            outline: none !important;
        }
        .mot-hero .btn::before, .mot-hero .btn::after,
        .mot-pricing-card .btn::before, .mot-pricing-card .btn::after,
        .mot-steps-section .btn::before, .mot-steps-section .btn::after,
        .mot-cta-banner .btn::before, .mot-cta-banner .btn::after,
        .mot-contact-box .btn::before, .mot-contact-box .btn::after {
            display: none !important;
            content: none !important;
            opacity: 0 !important;
        }

        /* ── HERO ─────────────────────────────────────────────────────── */
        .mot-hero {
            background: radial-gradient(circle at 100% 50%, #30141a 0%, #151515 50%, #111111 100%);
            padding: 60px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .mot-hero .container { position: relative; z-index: 2; }
        .mot-hero h1 {
            font-size: clamp(2.2rem, 4vw, 3.5rem);
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 18px;
            color: #fff;
            line-height: 1.1;
        }
        .mot-hero p {
            font-size: 1rem;
            max-width: 560px;
            margin-bottom: 28px;
            color: #a3a3a3;
            line-height: 1.6;
        }
        .mot-btn-red {
            background-color: #e72b37;
            color: #fff;
            border-color: #e72b37;
            font-weight: 800;
            text-transform: uppercase;
            margin-right: 12px;
            margin-bottom: 12px;
            display: inline-block;
            text-decoration: none;
            transition: background .2s;
        }
        .mot-btn-red:hover { background-color: #c41a24; border-color: #c41a24; color: #fff; }
        .mot-btn-outline {
            background-color: transparent;
            color: #fff;
            border-color: #555;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 12px;
            display: inline-block;
            text-decoration: none;
            transition: border-color .2s;
        }
        .mot-btn-outline:hover { border-color: #fff; color: #fff; }
        /* hero card */
        .mot-card-wrap {
            position: relative;
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }
        .mot-card-wrap img {
            max-width: 360px;
            width: 100%;
            height: auto;
            display: block;
            position: relative;
            z-index: 2;
            filter: drop-shadow(0 20px 40px rgba(0,0,0,.7));
            border-radius: 14px;
        }
        .mot-decorative-circles {
            position: absolute; top: 50%; right: 15%;
            transform: translateY(-50%);
            width: 500px; height: 500px;
            border: 1px dashed rgba(255,255,255,.05);
            border-radius: 50%;
            z-index: 1; pointer-events: none;
        }
        .mot-decorative-circles::before {
            content: '';
            position: absolute;
            top: 50px; left: 50px; right: 50px; bottom: 50px;
            border: 1px solid rgba(255,255,255,.02);
            border-radius: 50%;
        }

        /* ── WHAT WE CHECK ────────────────────────────────────────────── */
        .mot-check-section { padding: 80px 0; background: #fff; }
        .mot-check-section h2 {
            text-align: center;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 18px;
        }
        .mot-check-section .intro {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 46px;
            color: #555;
            line-height: 1.6;
        }
        .mot-check-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            border: 1px solid #eee;
        }
        .mot-check-item {
            padding: 26px;
            border: 1px solid #eee;
            display: flex;
            align-items: center;
        }
        .mot-check-item .icon {
            width: 30px; height: 30px;
            background: #fef0f2;
            color: #E31837;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin-right: 14px;
            flex-shrink: 0;
            font-size: 12px;
        }
        .mot-check-item span { font-weight: 600; color: #333; font-size: 14px; }

        /* ── STEPS ────────────────────────────────────────────────────── */
        .mot-steps-section { padding: 60px 0; background: #f8f9fa; }
        .mot-steps-section h2 {
            text-align: center;
            font-weight: 900;
            line-height: 1.15;
            text-transform: uppercase;
            margin-bottom: 40px;
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
            color: #111;
            letter-spacing: 0.5px;
        }
        .mot-steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 0;
        }
        .mot-step-item .step-num {
            width: 32px;
            height: 32px;
            border: 1.5px solid #ED1E24;
            color: #ED1E24;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-bottom: 14px;
            font-size: 13px;
        }
        .mot-step-item h4 {
            font-weight: 800;
            font-size: 15px;
            text-transform: uppercase;
            margin-bottom: 8px;
            color: #111;
            letter-spacing: 0.3px;
        }
        .mot-step-item p {
            color: #6b7280;
            font-size: 13px;
            line-height: 1.5;
            margin-bottom: 0;
        }
        /* ── PRICING CARDS ────────────────────────────────────────────── */
        .mot-options-section { padding: 80px 0; background: #fff; }
        .mot-options-section h2 {
            text-align: center;
            font-weight: 900;
            text-transform: uppercase;
            margin-bottom: 16px;
        }
        .mot-pricing-card {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-left: 4px solid #E31837;
            border-radius: 8px;
            padding: 32px;
            height: 100%;
        }
        .mot-pricing-card .card-class {
            font-size: 11px;
            font-weight: 800;
            color: #E31837;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }
        .mot-pricing-card h3 {
            font-weight: 900;
            font-size: 17px;
            text-transform: uppercase;
            margin-bottom: 14px;
            color: #111;
        }
        .mot-pricing-card p { color: #666; font-size: 14px; line-height: 1.6; margin-bottom: 22px; }
        .mot-pricing-card .price {
            font-size: 3rem;
            font-weight: 900;
            color: #111;
            margin-bottom: 22px;
            line-height: 1;
        }
        .mot-pricing-card .price sup { font-size: 1.4rem; font-weight: 700; vertical-align: top; margin-top: 8px; }

        /* ── CTA BANNER ───────────────────────────────────────────────── */
        .mot-cta-banner {
            padding: 105px 0 115px;
            background-image: url('{{ asset('storage/mot/45c989125792c19738901c01d81d2eb0c0389583.jpg') }}');
            background-size: cover;
            background-position: center center;
            position: relative;
            text-align: center;
            color: #fff;
        }
        .mot-cta-banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(180deg, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.68) 100%);
            z-index: 1;
        }
        .mot-cta-banner .container { position: relative; z-index: 2; }
        .mot-cta-banner h2 {
            color: #ffffff !important;
            font-weight: 900 !important;
            font-size: clamp(2rem, 3.5vw, 2.75rem);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 18px;
            line-height: 1.15;
            text-shadow: 0 2px 10px rgba(0,0,0,0.4);
        }
        .mot-cta-banner p {
            color: #ffffff !important;
            font-weight: 500;
            line-height: 1.6;
            margin-bottom: 32px;
            max-width: 680px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 0 1px 6px rgba(0,0,0,0.4);
        }
        .mot-cta-btn-red {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #ED1E24;
            color: #fff !important;
            border-color: #ED1E24;
            font-weight: 800;
            text-transform: uppercase;
            text-decoration: none;
            transition: all .2s;
            box-shadow: 0 4px 15px rgba(237,30,36,0.3);
            -webkit-clip-path: none !important;
            clip-path: none !important;
        }
        .mot-cta-btn-red:hover { background: #b0121e; border-color: #b0121e; color: #fff !important; }
        .mot-cta-btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(0,0,0,0.3);
            backdrop-filter: blur(4px);
            color: #fff !important;
            border-color: #ED1E24;
            font-weight: 800;
            text-transform: uppercase;
            text-decoration: none;
            transition: all .2s;
            -webkit-clip-path: none !important;
            clip-path: none !important;
        }
        .mot-cta-btn-outline:hover { background: rgba(237,30,36,0.2); border-color: #ED1E24; color: #fff !important; }

        /* ── WHY CHOOSE ───────────────────────────────────────────────── */
        .mot-why-choose { padding: 80px 0; background: #fff; }
        .mot-why-choose h2 {
            text-align: center;
            font-weight: 900;
            text-transform: uppercase;
            max-width: 640px;
            margin: 0 auto 46px;
        }
        .mot-why-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }
        .mot-why-card { background: #f4f5f7; padding: 28px; border-radius: 8px; }
        .mot-why-card h3 {
            font-weight: 800;
            font-size: 15px;
            margin-bottom: 12px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            color: #111;
        }
        .mot-why-card h3 .num { color: #E31837; margin-right: 10px; }
        .mot-why-card p { color: #666; margin: 0; font-size: 13.5px; line-height: 1.65; }

        /* ── MOT DUE ──────────────────────────────────────────────────── */
        .mot-due-section { padding: 80px 0; background: #fff; }

        /* ── AREAS ────────────────────────────────────────────────────── */
        .mot-areas-section {
            padding: 72px 0 60px;
            background: #f2f2f4;
        }
        .mot-areas-container {
            width: min(1780px, calc(100% - 48px));
            max-width: none;
            margin: 0 auto;
            padding: 0;
        }
        .sf-main-page .page_content h2.mot-areas-title {
            max-width: 1360px;
            margin: 0 auto 43px;
            color: #17171b;
            font-family: Montserrat, sans-serif;
            font-size: clamp(3rem, 4.25vw, 4.5rem) !important;
            font-weight: 800 !important;
            line-height: 1.18 !important;
            letter-spacing: -1.4px;
            text-align: center;
            text-transform: uppercase;
        }
        .mot-areas-card {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            min-height: 536px;
            overflow: hidden;
            border: 1px solid #ddd8d1;
            border-radius: 14px;
            background: #fff;
        }
        .mot-areas-content {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding: 64px 72px 62px;
        }
        .sf-main-page .page_content p.mot-areas-copy {
            max-width: 700px;
            margin: 0 0 37px;
            color: #716e6a;
            font-family: Mulish, sans-serif;
            font-size: clamp(1.25rem, 1.4vw, 1.625rem) !important;
            font-weight: 400;
            line-height: 1.5 !important;
            text-align: left !important;
        }
        .mot-areas-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 16px 14px;
        }
        .mot-abtn {
            display: inline-flex;
            min-height: 64px;
            align-items: center;
            justify-content: center;
            padding: 14px 28px;
            border: 1.5px solid #ded9d2;
            border-radius: 999px;
            font-family: Montserrat, sans-serif;
            font-size: 20px;
            font-weight: 600;
            line-height: 1;
            color: #4e4d4d !important;
            background: #fff !important;
            cursor: pointer;
            transition: color .2s ease, background-color .2s ease, border-color .2s ease;
            text-decoration: none;
            -webkit-clip-path: none !important;
            clip-path: none !important;
            border-style: solid !important;
        }
        .mot-abtn:hover, .mot-abtn.active {
            background: #ED1E24 !important;
            border-color: #ED1E24 !important;
            color: #fff !important;
        }
        #motAreaMap {
            background: #e8e0d8 !important;
            min-height: 536px;
            height: 100%;
            width: 100%;
            border-radius: 0;
        }
        #motAreaMap img, #motAreaMap canvas { filter: none !important; max-width: none !important; }
        #motAreaMap .leaflet-tile-container img { filter: none !important; display: block !important; }
        .mot-map-pin {
            color: #ed1e24;
            font-size: 64px;
            line-height: 1;
            text-align: center;
            filter: drop-shadow(0 3px 4px rgba(0, 0, 0, .16));
        }

        /* ── TESTIMONIALS ─────────────────────────────────────────────── */
        .mot-testi-section { padding: 80px 0; background: #fff; }
        .mot-testi-card {
            background: #fff;
            border: 1px solid #efefef;
            border-radius: 8px;
            padding: 28px;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 18px rgba(0,0,0,.04);
        }
        .mot-testi-stars { color: #ffc107; font-size: 13px; margin-bottom: 14px; }
        .mot-testi-text { color: #555; font-size: 14px; line-height: 1.65; flex-grow: 1; margin-bottom: 18px; }
        .mot-testi-name { font-weight: 800; font-size: 12px; text-transform: uppercase; color: #111; border-top: 1px solid #eee; padding-top: 14px; margin: 0; }

        /* ── FAQ ──────────────────────────────────────────────────────── */
        .mot-faq-section { padding: 80px 0 90px; background: #fff; }
        .mot-faq-section h2.faq-main-title {
            text-align: center;
            font-weight: 900;
            font-size: 36px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #111;
            margin-bottom: 44px;
        }
        .mot-faq-section .accordion-item {
            border: none;
            border-top: 1px solid #e5e7eb;
            background: transparent;
            border-radius: 0 !important;
        }
        .mot-faq-section .accordion-item:last-child {
            border-bottom: 1px solid #e5e7eb;
        }
        .mot-faq-section .accordion-button {
            font-family: var(--bs-font-body, "Mulish", sans-serif) !important;
            font-weight: 700;
            font-size: 16.5px;
            padding: 22px 0;
            background: transparent !important;
            color: #111 !important;
            box-shadow: none !important;
            border: none !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-transform: none !important;
            transition: color .2s ease;
        }
        .mot-faq-section .accordion-button:hover {
            color: #ED1E24 !important;
        }
        .mot-faq-section .accordion-button:focus { box-shadow: none !important; }
        .mot-faq-section .accordion-button::after {
            background-image: none !important;
            content: '+' !important;
            font-size: 20px !important;
            line-height: 1 !important;
            width: 32px !important;
            height: 32px !important;
            min-width: 32px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: 1.5px solid #ddd !important;
            color: #666 !important;
            background-color: transparent !important;
            border-radius: 50% !important;
            font-weight: 400 !important;
            margin-left: 16px !important;
            transform: none !important;
            transition: all .25s ease !important;
        }
        .mot-faq-section .accordion-button:hover::after {
            border-color: #ED1E24 !important;
            color: #ED1E24 !important;
        }
        .mot-faq-section .accordion-button:not(.collapsed)::after {
            content: '−' !important;
            font-size: 22px !important;
            font-weight: 700 !important;
            color: #fff !important;
            border-color: #ED1E24 !important;
            background-color: #ED1E24 !important;
            transform: none !important;
        }
        .mot-faq-section .accordion-body {
            padding: 0 40px 22px 0;
            color: #6b7280;
            font-size: 14.5px;
            line-height: 1.7;
        }

        /* ── RESPONSIVE ───────────────────────────────────────────────── */
        @media (max-width: 991px) {
            .mot-check-grid { grid-template-columns: repeat(2, 1fr); }
            .mot-steps-grid { grid-template-columns: repeat(2, 1fr); }
            .mot-why-grid { grid-template-columns: 1fr; }
            .mot-areas-card { grid-template-columns: 1fr; }
            .mot-areas-content { padding: 48px 44px; }
            #motAreaMap { min-height: 380px; height: 380px; }
        }
        @media (max-width: 767px) {
            .mot-check-grid { grid-template-columns: 1fr; }
            .mot-steps-grid { grid-template-columns: 1fr; }
            .mot-areas-section { padding: 54px 0 46px; }
            .mot-areas-container { width: calc(100% - 30px); }
            .sf-main-page .page_content h2.mot-areas-title {
                margin-bottom: 34px;
                font-size: clamp(2.1rem, 10vw, 3rem) !important;
                line-height: 1.08 !important;
                letter-spacing: -.7px;
            }
            .mot-areas-content { padding: 34px 24px 38px; }
            .sf-main-page .page_content p.mot-areas-copy {
                margin-bottom: 28px;
                font-size: 1.05rem !important;
                line-height: 1.55 !important;
            }
            .mot-areas-buttons { gap: 10px 8px; }
            .mot-abtn {
                min-height: 48px;
                padding: 11px 18px;
                font-size: 14px;
            }
            #motAreaMap { min-height: 320px; height: 320px; }
        }
    </style>

    @php
        $currencyId = App\Support\CartPriceGuard::currentCurrencyId();
        $testimonials = \DB::table('testimonials')->where('published', 1)->take(3)->get();
        $locations    = \DB::table('locations')->where('published', 1)->get();
    @endphp

    {{-- ══════════════════════════════════════════════════════════
         1. HERO
    ══════════════════════════════════════════════════════════ --}}
    <section class="mot-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="fm-hero-title">MOT Peterborough</h1>
                    <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">
                        Looking for a reliable MOT in Peterborough? At Smartfit Autos, we provide professional, DVSA approved MOT testing to keep your vehicle safe, legal, and roadworthy. Our experienced technicians ensure a quick, hassle-free process with honest advice and transparent pricing.
                    </p>
                    <div class="sf-cta-pair">
                        <a href="tel:01733569998" class="mot-btn-red sf-cta sf-cta--primary">CALL NOW 01733 569998</a>
                        <a href="#book-mot" class="mot-btn-outline sf-cta sf-cta--outline-light">BOOK MOT ONLINE <i class="fa-solid fa-arrow-right sf-cta__icon" aria-hidden="true"></i></a>
                    </div>
                    <div class="features sf-hero-features">
                        <div class="sf-hero-feature"><i class="fa-solid fa-check" aria-hidden="true"></i>SAME-DAY SLOTS</div>
                        <div class="sf-hero-feature"><i class="fa-solid fa-check" aria-hidden="true"></i>CLASS 4 &amp; CLASS 7</div>
                        <div class="sf-hero-feature"><i class="fa-solid fa-check" aria-hidden="true"></i>TRANSPARENT PRICING</div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center text-lg-end" style="position:relative;">
                    <div class="mot-decorative-circles"></div>
                    <div class="mot-card-wrap">
                        <img src="{{ asset('storage/mot/' . rawurlencode('Background+Border.png')) }}" alt="MOT Status – Smartfit Autos Peterborough">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         2. WHAT WE CHECK
    ══════════════════════════════════════════════════════════ --}}
    <section class="mot-check-section">
        <div class="container">
            <div class="text-center">
                <h2>What we check during your MOT test</h2>
                <p class="text-dark fs-5 mb-4 w-75 intro" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important; font-size: 18px;">
                    An MOT test is a legal requirement in the UK that ensures your vehicle meets road safety and environmental standards. At Smartfit Autos in Peterborough, we carry out a full and detailed inspection following DVSA guidelines.<br><br>We check all essential components, including:
                </p>
            </div>

            <div class="mot-check-grid">
                @foreach([
                    'Wheels, tyres, and brakes',
                    'Lights, indicators, and electrical systems',
                    'Steering and suspension components',
                    'Exhaust system and emissions',
                    'Windscreen, wipers, and washer bottle',
                    'Horn functionality',
                    'Seatbelts and seat condition',
                    'Fuel system',
                    'Bodywork and overall vehicle structure',
                    'Doors, mirrors, and opening mechanisms',
                    'Registration plate condition and visibility',
                    'Vehicle Identification Number (VIN)',
                ] as $item)
                <div class="mot-check-item">
                    <div class="icon"><i class="fas fa-check"></i></div>
                    <span>{{ $item }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         3. EASY STEPS
    ══════════════════════════════════════════════════════════ --}}
    <section class="mot-steps-section">
        <div class="container">
            <h2>EASY STEPS TO GET YOUR MOT<br>DONE IN PETERBOROUGH</h2>

            <div class="mot-steps-grid">
                @foreach([
                    ['1','BOOK YOUR MOT',      'Book online or call our Peterborough team to schedule your MOT at a time that suits you.'],
                    ['2','VISIT OUR GARAGE',   'Bring your vehicle to Smartfit Autos in Peterborough for your booked MOT appointment.'],
                    ['3','MOT TESTING',        'Our DVSA-authorised testers complete a full inspection to ensure your vehicle is road legal.'],
                    ['4','GET RESULTS & ADVICE','We explain your MOT results clearly and advise you on any repairs or next steps needed.'],
                ] as [$n,$title,$desc])
                <div class="mot-step-item">
                    <div class="step-num">{{ $n }}</div>
                    <h3>{!! $title !!}</h3>
                    <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">{{ $desc }}</p>
                </div>
                @endforeach
            </div>

            @include('site.partials.ready-when-you-are', [
                'readyCtaBookingHref' => '#book-mot',
                'readyCtaBookingLabel' => 'BOOK MOT ONLINE',
            ])
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         4. MOT OPTIONS / PRICING
    ══════════════════════════════════════════════════════════ --}}
    <section id="book-mot" class="mot-options-section">
        <div class="container">
            <h2>Your MOT options at Smartfit Autos</h2>
                <p class="text-secondary fs-5 mb-4 w-75" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important;text-align:center;max-width:100%; margin:0 auto;">
                    At Smartfit Autos, we provide reliable and DVSA-approved MOT testing for both cars and larger vehicles at clear, competitive prices.</p>

            <div class="row justify-content-center g-4">
                {{-- CLASS 4 --}}
                <div class="col-md-5">
                    <div class="mot-pricing-card">
                        <div class="card-class">CLASS 4</div>
                        <h3>Cars &amp; Small Vehicles</h3>
                        <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">Required for most cars and small vehicles over 3 years old. This is the standard MOT test for passenger vehicles, helping confirm full compliance with UK road safety and environmental regulations.</p>
                        <div class="price d-flex"><small class="fs-5">£</small>39.99</div>
                        <a href="/booking/order" class="sf-cta sf-cta--primary" style="background:#E31837;color:#fff;font-weight:800;text-transform:uppercase;text-decoration:none;-webkit-clip-path:none!important;clip-path:none!important;">BOOK THIS TEST</a>
                    </div>
                </div>
                {{-- CLASS 7 --}}
                <div class="col-md-5">
                    <div class="mot-pricing-card">
                        <div class="card-class">CLASS 7</div>
                        <h3>Vans &amp; Commercial Vehicles</h3>
                        <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">For larger vans and commercial vehicles weighing between 3,000kg and 3,500kg. A complete safety inspection to confirm your vehicle meets legal road standards.</p>
                        <div class="price d-flex"><small class="fs-5">£</small>55</div>
                        <a href="/booking/order" class="sf-cta sf-cta--primary" style="background:#E31837;color:#fff;font-weight:800;text-transform:uppercase;text-decoration:none;-webkit-clip-path:none!important;clip-path:none!important;">BOOK THIS TEST</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         5. FULL-WIDTH CTA IMAGE BANNER
    ══════════════════════════════════════════════════════════ --}}
    <section class="mot-cta-banner">
        <div class="container">
            <p class="display-4 fw-extrabold text-white opacity-1" style="opacity: 1 !important;font-family: Montserrat;font-weight: 800;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">NEED AN MOT? GET IT DONE TODAY</p>
            <p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important; color: white;">Book your MOT in Peterborough today with trusted local experts and<br class="d-none d-md-block"> fast, simple online scheduling.</p>
            <div class="d-flex align-items-center justify-content-center flex-wrap gap-3 sf-cta-pair">
                <a href="#book-mot" class="mot-cta-btn-red sf-cta sf-cta--primary">
                    <span>BOOK YOUR MOT NOW</span>
                </a>
                <a href="tel:01733569998" class="mot-cta-btn-outline sf-cta sf-cta--outline-light">
                    <span>CALL NOW 01733 569998</span>
                    <i class="fa-solid fa-arrow-right sf-cta__icon" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         6. WHY CHOOSE US
    ══════════════════════════════════════════════════════════ --}}
    <section class="mot-why-choose">
        <div class="container">
            <h2 class="w-75" style="max-width: 100% !important;">Why choose Smartfit Autos for MOT in Peterborough?</h2>
            <div class="mot-why-grid">
                @foreach([
                    ['01','DVSA Authorised',       'Our MOT testing is fully DVSA approved, ensuring your vehicle is checked to strict legal standards with accurate, reliable, and compliant results every time.'],
                    ['02','Same-Day Slots',         'We offer flexible same-day MOT appointments in Peterborough, helping you get your vehicle tested quickly without long waiting times or unnecessary delays.'],
                    ['03','Transparent Pricing',    'Enjoy honest, upfront pricing with Smartfit Autos. No hidden charges or surprise fees just clear, fair MOT costs you can trust from start to finish.'],
                    ['04','Experienced Technicians','Our skilled technicians have years of MOT testing experience, ensuring thorough inspections and accurate assessments for your vehicle\'s safety and compliance.'],
                    ['05','Easy Online Booking',    'Book your MOT in just a few clicks using our simple online system. Fast, convenient, and available anytime to suit your busy schedule.'],
                    ['06','Locally Trusted Garage', 'Proudly trusted by drivers across Peterborough for reliable MOT services, honest advice, and consistent high-quality workmanship you can depend on.'],
                ] as [$num,$title,$desc])
                <div class="mot-why-card">
                    <h3 class="sf-numbered-card-heading"><span class="num sf-numbered-card-number">{{ $num }}</span>{{ strtoupper($title) }}</h3>
                    <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         7. WHEN IS YOUR MOT DUE
    ══════════════════════════════════════════════════════════ --}}
    <section class="mot-due-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h2>When is your MOT due?</h2>
                    <p class="text-dark mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">In the UK, vehicles over three years old are required to have an MOT test every year to ensure they meet road safety and environmental standards. Keeping your MOT up to date is essential, as driving without a valid certificate can lead to fines, penalty points, and potential insurance issues.</p>
                    <p class="text-dark mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">If you're unsure when your MOT is due, Smartfit Autos in Peterborough can help. Our team can quickly check your MOT expiry date and assist you in booking your next test at a time that suits you, so you never miss your renewal.</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('storage/mot/834ad9ed2e54dd1f67195f8f628b80c2544d4ee0.jpg') }}" class="img-fluid rounded shadow-lg" alt="Mechanic performing MOT inspection" style="width:100%;object-fit:cover;border-radius:10px;">
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         8. AREAS WE SERVE + MAP
    ══════════════════════════════════════════════════════════ --}}
    @include('site.partials.service-area-map', [
        'serviceAreaId' => 'mot-service-area',
        'serviceAreaTitle' => 'We serve Peterborough and<br>surrounding areas',
        'serviceAreaDescription' => 'We proudly serve drivers across Peterborough and nearby areas with fast, reliable MOT testing. Visit Smartfit Autos for convenient local service you can trust.',
        'serviceAreaPopupLabel' => 'Smartfit Autos MOT & Servicing Area',
    ])

    {{-- ══════════════════════════════════════════════════════════
         9. CUSTOMER REVIEWS
    ══════════════════════════════════════════════════════════ --}}
    <section class="py-5" style="background: #F2F2F4 !important;">
        <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-extrabold text-dark mb-0" style="font-family: Montserrat;font-weight: 800;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
                WHAT OUR CUSTOMERS SAY
            </h2>
        </div>
        
        <div class="home_reviews_slider_wrap position-relative">
            <div class="home_reviews_carousel">
                @include("site.partials.customer-review-slides")
            </div>
        </div>
        
        @include("site.partials.customer-review-controls")
        </div>
    </section>
        
        <style>
        .home_reviews_carousel .slick-track {
        display: flex !important;
        }
        .home_reviews_carousel .slick-slide {
        height: inherit !important;
        display: flex !important;
        }
        .home_reviews_carousel .slick-slide > div {
        display: flex;
        width: 100%;
        }
        </style>
        
        <script>
        (function() {
        function initReviewsSlider() {
        if (window.jQuery && jQuery.fn.slick && jQuery('.home_reviews_carousel').length) {
            if (!jQuery('.home_reviews_carousel').hasClass('slick-initialized')) {
                jQuery('.home_reviews_carousel').slick({
                    dots: false,
                    arrows: true,
                    prevArrow: '.reviews_arrow_left',
                    nextArrow: '.reviews_arrow_right',
                    infinite: true,
                    autoplay: true,
                    autoplaySpeed: 3500,
                    speed: 600,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    pauseOnHover: true,
                    pauseOnFocus: false,
                    swipeToSlide: true,
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            }
        }
        }
        
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
        setTimeout(initReviewsSlider, 100);
        } else {
        document.addEventListener('DOMContentLoaded', initReviewsSlider);
        }
        window.addEventListener('load', initReviewsSlider);
        })();
        </script>

    {{-- ══════════════════════════════════════════════════════════
         10. FAQ
    ══════════════════════════════════════════════════════════ --}}
    <section class="mot-faq-section">
        <div class="container">
            <div class="text-center"><h2 class="mb-5">FREQUENTLY ASKED QUESTIONS</h2></div>

            <div class="accordion" id="motFaqAccordion" style="max-width: 860px; margin: 0 auto;">

                @php
                $faqs = [
                    ['What’s included in an MOT?',
                     'An MOT test is required every year once your vehicle is over 3 years old. It checks essential safety, roadworthiness, and environmental standards. Vehicles over 40 years old may be exempt if no major modifications have been made in the last 30 years.',
                     true],
                    ['How long does an MOT take?',
                     'On average, an MOT test takes around 45 minutes to 1 hour, depending on the condition of the vehicle.',
                     false],
                    ['When does a new car need an MOT?',
                     'A new car needs its first MOT after 3 years. However, taxis, emergency vehicles, and vehicles with more than 9 seats require an MOT after 12 months.',
                     false],
                    ['How can I check my MOT history?',
                     'You can check your MOT history on the official <a href="https://www.check-mot.service.gov.uk/" target="blank">GOV.UK</a> website by entering your vehicle registration number.',
                     false],
                    ['How long is an MOT certificate valid for?',
                     'An MOT certificate is valid for 12 months from the expiry date of your previous MOT. You can find the exact expiry date on your current certificate.',
                     false],
                ];
                @endphp

                <style>
                    .fm-faq{background:#fff;padding:82px 0}
                    .fm-fitem{border-bottom:1px solid #e6e6e6}
                    .fm-fitem:first-child{border-top:1px solid #e6e6e6}
                    .fm-fq{display:flex;justify-content:space-between;align-items:center;padding:20px 0;cursor:pointer;font-size:16.5px;font-weight:700;color:#111;user-select:none;gap:16px;transition:color .2s;text-transform:none !important}
                    .fm-fq:hover{color:#ED1E24}
                    .fm-ficon{width:32px;height:32px;border:1.5px solid #ddd;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px;line-height:1;color:#666;transition:all .25s ease;font-weight:400;user-select:none}
                    .fm-fq:hover .fm-ficon{border-color:#ED1E24;color:#ED1E24}
                    .fm-ficon::before{content:'+';display:block;line-height:1}
                    .fm-fitem.open .fm-ficon{background:#ED1E24 !important;border-color:#ED1E24 !important;color:#fff !important;transform:none !important}
                    .fm-fitem.open .fm-ficon::before{content:'−' !important;font-size:22px;font-weight:700}
                    .fm-fa{display:none;padding:0 40px 22px 0;font-size:14.5px;color:#666;line-height:1.7}
                    .fm-fitem.open .fm-fa{display:block}
                </style>
                <div class="fm-fitem open" id="fmF1">
                    <h3 class="fm-fq" onclick="fmFaq('fmF1')"><span>What’s included in an MOT?</span><div class="fm-ficon"></div></h3>
                    <div class="fm-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">An MOT test is required every year once your vehicle is over 3 years old. It checks essential safety, roadworthiness, and environmental standards. Vehicles over 40 years old may be exempt if no major modifications have been made in the last 30 years.</p></div>
                </div>
                <div class="fm-fitem" id="fmF2">
                    <h3 class="fm-fq" onclick="fmFaq('fmF2')"><span>How long does an MOT take?</span><div class="fm-ficon"></div></h3>
                    <div class="fm-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">On average, an MOT test takes around 45 minutes to 1 hour, depending on the condition of the vehicle.</p></div>
                </div>
                <div class="fm-fitem" id="fmF3">
                    <h3 class="fm-fq" onclick="fmFaq('fmF3')"><span>When does a new car need an MOT?</span><div class="fm-ficon"></div></h3>
                    <div class="fm-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">A new car needs its first MOT after 3 years. However, taxis, emergency vehicles, and vehicles with more than 9 seats require an MOT after 12 months.</p></div>
                </div>
                <div class="fm-fitem" id="fmF4">
                    <h3 class="fm-fq" onclick="fmFaq('fmF4')"><span>How can I check my MOT history?</span><div class="fm-ficon"></div></h3>
                    <div class="fm-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">You can check your MOT history on the official <a href="https://www.check-mot.service.gov.uk/" target="blank">GOV.UK</a> website by entering your vehicle registration number.</p></div>
                </div>
                <div class="fm-fitem" id="fmF5">
                    <h3 class="fm-fq" onclick="fmFaq('fmF5')"><span>How long is an MOT certificate valid for?</span><div class="fm-ficon"></div></h3>
                    <div class="fm-fa"><p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">An MOT certificate is valid for 12 months from the expiry date of your previous MOT. You can find the exact expiry date on your current certificate..</p></div>
                </div>
                
                <script>
                    function fmFaq(id){
                        var el=document.getElementById(id);
                        var was=el.classList.contains('open');
                        document.querySelectorAll('.fm-fitem').forEach(function(i){i.classList.remove('open')});
                        if(!was) el.classList.add('open');
                    }

                </script>

            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════
         11. FINAL CTA BANNER
    ══════════════════════════════════════════════════════════ --}}
    <section class="mot-cta-banner">
        <div class="container">
            <p class="display-4 fw-extrabold text-white opacity-1" style="opacity: 1 !important;font-family: Montserrat;font-weight: 800;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">Book your MOT in Peterborough today</p>
            <p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important; color: white;">Get your MOT done quickly in Peterborough with flexible slots and DVSA-approved testing at Smartfit Autos.</p>
            <div class="sf-cta-pair">
                <a href="#book-mot" class="mot-cta-btn-red sf-cta sf-cta--primary">BOOK YOUR MOT NOW</a>
                <a href="tel:01733569998" class="mot-cta-btn-outline sf-cta sf-cta--outline-light">CALL NOW 01733 569998 <i class="fa-solid fa-arrow-right sf-cta__icon" aria-hidden="true"></i></a>
            </div>
        </div>
    </section>

</div>
