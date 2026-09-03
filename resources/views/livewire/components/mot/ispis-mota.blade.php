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
            border: 2px solid #e72b37;
            padding: 11px 26px;
            font-weight: 800;
            font-size: 12px;
            text-transform: uppercase;
            border-radius: 30px;
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
            border: 1px solid #555;
            padding: 11px 26px;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            border-radius: 30px;
            margin-bottom: 12px;
            display: inline-block;
            text-decoration: none;
            transition: border-color .2s;
        }
        .mot-btn-outline:hover { border-color: #fff; color: #fff; }
        .mot-hero .features {
            display: flex;
            gap: 22px;
            margin-top: 26px;
            flex-wrap: wrap;
        }
        .mot-hero .features div {
            display: flex;
            align-items: center;
            font-weight: 700;
            color: #888;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: .5px;
        }
        .mot-hero .features div i { color: #e72b37; margin-right: 7px; }

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
            margin-bottom: 36px;
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
        .mot-contact-box {
            background: #fff;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            padding: 22px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            flex-wrap: wrap;
            gap: 16px;
        }
        .mot-contact-box .phone-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            background: #fde8e8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
        }
        .mot-contact-box h5 {
            margin: 0 0 2px 0;
            font-weight: 800;
            font-size: 15.5px;
            color: #111;
        }
        .mot-contact-box p {
            margin: 0;
            color: #6b7280;
            font-size: 13px;
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
            border: 1.5px solid #ED1E24;
            padding: 13px 32px;
            border-radius: 30px;
            font-weight: 800;
            font-size: 13px;
            text-transform: uppercase;
            text-decoration: none;
            letter-spacing: 0.5px;
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
            border: 1.5px solid #ED1E24;
            padding: 13px 32px;
            border-radius: 30px;
            font-weight: 800;
            font-size: 13px;
            text-transform: uppercase;
            text-decoration: none;
            letter-spacing: 0.5px;
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
        .mot-why-card h4 {
            font-weight: 800;
            font-size: 15px;
            margin-bottom: 12px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            color: #111;
        }
        .mot-why-card h4 .num { color: #E31837; margin-right: 10px; font-weight: 800; }
        .mot-why-card p { color: #666; margin: 0; font-size: 13.5px; line-height: 1.65; }

        /* ── MOT DUE ──────────────────────────────────────────────────── */
        .mot-due-section { padding: 80px 0; background: #fff; }

        /* ── AREAS ────────────────────────────────────────────────────── */
        .mot-areas-section { padding: 80px 0; background: #f8f9fa; }
        .mot-abtn {
            display: inline-block;
            padding: 8px 20px;
            border: 1.5px solid #ddd;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            color: #555 !important;
            background: #fff !important;
            cursor: pointer;
            transition: all .2s;
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
            height: 380px;
            width: 100%;
            border-radius: 0 12px 12px 0;
        }
        @media (max-width: 991px) {
            #motAreaMap { border-radius: 0 0 12px 12px; height: 300px; }
        }
        #motAreaMap img, #motAreaMap canvas { filter: none !important; max-width: none !important; }
        #motAreaMap .leaflet-tile-container img { filter: none !important; display: block !important; }
        .mot-map-pin svg { display: block; }

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
        }
        @media (max-width: 767px) {
            .mot-check-grid { grid-template-columns: 1fr; }
            .mot-steps-grid { grid-template-columns: 1fr; }
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
                    <div>
                        <a href="tel:01733569998" class="mot-btn-red">CALL NOW 01733 569998</a>
                        <a href="#book-mot"       class="mot-btn-outline">BOOK MOT ONLINE +</a>
                    </div>
                    <div class="features">
                        <div><i class="fas fa-check"></i> SAME-DAY SLOTS</div>
                        <div><i class="fas fa-check"></i> CLASS 4 &amp; CLASS 7</div>
                        <div><i class="fas fa-check"></i> TRANSPARENT PRICING</div>
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

            <div class="mot-contact-box">
                <div class="d-flex align-items-center">
                    <div class="phone-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" stroke="#ED1E24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight:800;font-size: 15px;color:#111">Ready when you are</div>
                        <div style="font-size: 15px;color:#666">Speak to the Peterborough team directly</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <a href="tel:01733569998" style="display:inline-block;padding:10px 24px;border:1.5px solid #111;border-radius:30px;font-weight:800;font-size:12.5px;color:#111;text-decoration:none;text-transform:uppercase;letter-spacing:0.5px;-webkit-clip-path:none!important;clip-path:none!important;">CALL NOW &nbsp;01733 569998</a>
                    <a href="#book-mot"       style="display:inline-block;padding:10px 26px;background:#ED1E24;border:1.5px solid #ED1E24;border-radius:30px;font-weight:800;font-size:12.5px;color:#fff;text-decoration:none;text-transform:uppercase;letter-spacing:0.5px;-webkit-clip-path:none!important;clip-path:none!important;">BOOK MOT ONLINE</a>
                </div>
            </div>
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
                        <a href="/booking/order" style="display:inline-block;background:#E31837;color:#fff;border:none;padding:12px 28px;border-radius:30px;font-weight:800;font-size:13px;text-transform:uppercase;text-decoration:none;-webkit-clip-path:none!important;clip-path:none!important;">BOOK THIS TEST</a>
                    </div>
                </div>
                {{-- CLASS 7 --}}
                <div class="col-md-5">
                    <div class="mot-pricing-card">
                        <div class="card-class">CLASS 7</div>
                        <h3>Vans &amp; Commercial Vehicles</h3>
                        <p class="text-secondary mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; font-size: 18px;">For larger vans and commercial vehicles weighing between 3,000kg and 3,500kg. A complete safety inspection to confirm your vehicle meets legal road standards.</p>
                        <div class="price d-flex"><small class="fs-5">£</small>55</div>
                        <a href="/booking/order" style="display:inline-block;background:#E31837;color:#fff;border:none;padding:12px 28px;border-radius:30px;font-weight:800;font-size:13px;text-transform:uppercase;text-decoration:none;-webkit-clip-path:none!important;clip-path:none!important;">BOOK THIS TEST</a>
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
            <p class="display-4 fw-extrabold text-white opacity-1" style="opacity: 1 !important;font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">NEED AN MOT? GET IT DONE TODAY</p>
            <p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important; font-size: 18px !important; color: white;">Book your MOT in Peterborough today with trusted local experts and<br class="d-none d-md-block"> fast, simple online scheduling.</p>
            <div class="d-flex align-items-center justify-content-center flex-wrap gap-3">
                <a href="#book-mot" class="mot-cta-btn-red">
                    <span>BOOK YOUR MOT NOW</span>
                    <i class="fa-solid fa-arrow-right fs-6"></i>
                </a>
                <a href="tel:01733569998" class="mot-cta-btn-outline">
                    <span>CALL NOW 01733 569998</span>
                    <i class="fa-solid fa-arrow-right fs-6"></i>
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
                    <h3><span class="num" style="color: #ED1E24; font-size: 20px; font-weight: 900;"> {{ $num }} </span> {{ strtoupper($title) }}</h3>
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
    <section class="mot-areas-section">
        <div class="container">
            <div class="text-center">
                <h2>We serve Peterborough and<br>surrounding areas</h2>
            </div>

            <div style="background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 10px 40px rgba(0,0,0,.07);display:flex;flex-wrap:wrap;">
                <div style="flex:1;padding:36px;min-width:280px;">
                    <p style="color:#666;line-height:1.65;margin-bottom:24px;font-size:14.5px;">We proudly serve drivers across Peterborough and nearby areas with fast, reliable MOT testing. Visit Smartfit Autos for convenient local service you can trust.</p>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        @php
                        $areas = [
                            [0,'Peterborough'], [1,'Stamford'],   [2,'Whittlesey'],
                            [3,'Crowland'],     [4,'Bourne'],     [5,'Huntingdon'],
                            [6,'Oundle'],       [7,'Sawtry'],     [8,'Ramsey'],     [9,'St Ives'],
                        ];
                        @endphp
                        @foreach($areas as [$idx,$name])
                        <button type="button"
                                class="mot-abtn {{ $idx===0 ? 'active' : '' }}"
                                onclick="motGoTo({{ $idx }},this)">
                            {{ $name }}
                        </button>
                        @endforeach
                    </div>
                </div>
                <div style="flex:1;min-width:280px;position:relative;">
                    <div id="motAreaMap" style="min-height: 380px; height: 100%;"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Leaflet map --}}
    <script>
    (function(){
      var locs = [
        {name:"Peterborough", lat:52.5695, lng:-0.2405},
        {name:"Stamford",     lat:52.6510, lng:-0.4810},
        {name:"Whittlesey",   lat:52.5574, lng:-0.1315},
        {name:"Crowland",     lat:52.6756, lng:-0.1661},
        {name:"Bourne",       lat:52.7686, lng:-0.3770},
        {name:"Huntingdon",   lat:52.3304, lng:-0.1867},
        {name:"Oundle",       lat:52.4820, lng:-0.4700},
        {name:"Sawtry",       lat:52.4370, lng:-0.2830},
        {name:"Ramsey",       lat:52.4490, lng:-0.1060},
        {name:"St Ives",      lat:52.3270, lng:-0.0760}
      ];
      var map, markers = [];
      function initMOTMap(){
        var el = document.getElementById('motAreaMap');
        if(!el || el._leaflet_id || typeof L === 'undefined') return;
        map = L.map('motAreaMap',{zoomControl:true,scrollWheelZoom:false}).setView([52.5695,-0.2405],10);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',{
          attribution:'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/">CARTO</a>',
          subdomains: 'abcd',
          maxZoom:19
        }).addTo(map);
        var redPin = L.divIcon({
          className:'mot-map-pin',
          html:'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 42" width="28" height="42"><path d="M14 0C8.48 0 4 4.48 4 10c0 7.5 10 26 10 26s10-18.5 10-26C24 4.48 19.52 0 14 0z" fill="#ED1E24"/><circle cx="14" cy="10" r="5.5" fill="#fff"/></svg>',
          iconSize:[28,42],
          iconAnchor:[14,42],
          popupAnchor:[0,-42]
        });
        locs.forEach(function(l, i){
          var m = L.marker([l.lat,l.lng],{icon:redPin}).addTo(map)
                   .bindPopup('<b style="color:#ED1E24;font-size:15px;">'+l.name+'</b><br><small style="color:#555;">Smartfit Autos MOT & Servicing Area</small>');
          m.on('click', function(){
            var btns = document.querySelectorAll('.mot-abtn');
            btns.forEach(function(b){ b.classList.remove('active'); });
            if(btns[i]) btns[i].classList.add('active');
          });
          markers.push(m);
        });
        setTimeout(function(){ if(map) map.invalidateSize(); }, 300);
      }
      window.motGoTo = function(idx,btn){
        document.querySelectorAll('.mot-abtn').forEach(function(b){ b.classList.remove('active'); });
        if(btn) btn.classList.add('active');
        if(map && locs[idx]){
          map.flyTo([locs[idx].lat,locs[idx].lng],12,{duration:0.8});
          if(markers[idx]) markers[idx].openPopup();
        }
      };
      if(document.readyState==='complete'){ setTimeout(initMOTMap,150); }
      else { window.addEventListener('load',function(){ setTimeout(initMOTMap,150); }); }
      window.addEventListener('resize', function(){ if(map) map.invalidateSize(); });
    })();
    </script>

    {{-- ══════════════════════════════════════════════════════════
         9. CUSTOMER REVIEWS
    ══════════════════════════════════════════════════════════ --}}
    <section class="py-5" style="background: #F2F2F4 !important;">
        <div class="container py-4">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-extrabold text-dark mb-0" style="font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">
                WHAT OUR CUSTOMERS SAY
            </h2>
        </div>
        
        <div class="home_reviews_slider_wrap position-relative">
            <div class="home_reviews_carousel">
                {{-- Review 1 --}}
                <div class="px-2 h-100">
                    <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                        <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                            Fantastic work on my BMW. Needed an MOT and they fitted me in the same day. Got my car back within 2 hours after they sorted the tyres, so I was good to go.
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                            AMINATOU SMART
                        </div>
                    </div>
                </div>
        
                {{-- Review 2 --}}
                <div class="px-2 h-100">
                    <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                        <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                            They're always so polite, professional and honest about their ability to help. They've even done small favours that have gone above and beyond what I would have expected.
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                            ABE THOMAS
                        </div>
                    </div>
                </div>
        
                {{-- Review 3 --}}
                <div class="px-2 h-100">
                    <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                        <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                            Took my car in for an MOT, they were very accommodating and efficient with their work. Good prices and an overall top service.
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                            ALEX GRIFFIN
                        </div>
                    </div>
                </div>
        
                {{-- Review 4 --}}
                <div class="px-2 h-100">
                    <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                        <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                            Excellent service from the team at Smartfit Autos. Booked full servicing and MOT online. Fast turnaround, transparent pricing, and polite staff.
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                            DAVID MILLER
                        </div>
                    </div>
                </div>
        
                {{-- Review 5 --}}
                <div class="px-2 h-100">
                    <div class="p-4 border rounded-3 bg-white h-100 shadow-sm d-flex flex-column" style="min-height: 270px; border-color: #e5e7eb !important;">
                        <div class="text-warning mb-3" style="font-size: 14px; letter-spacing: 2px;">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-secondary fs-5 mb-4 flex-grow-1" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: left !important; line-height: 1.55;">
                            Brilliant garage! Had brake repair and disc replacements completed on the same day without any hassle. Highly recommend their experienced technicians.
                        </p>
                        <div class="fw-extrabold text-uppercase text-dark mt-auto" style="font-family: Montserrat;font-weight: 800;font-size: 17px;line-height: 28px;letter-spacing: 0.8px !important;vertical-align: middle;text-transform: uppercase !important;">
                            SARAH JENKINS
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button" class="btn btn-light rounded-circle d-flex align-items-center justify-content-center p-0 reviews_arrow_left" style="width: 42px; height: 42px; border: 1px solid #ddd; background: #fff; cursor: pointer; transition: all 0.2s ease;">
                <i class="fa-solid fa-arrow-left text-dark small"></i>
            </button>
            <button type="button" class="btn btn-danger rounded-circle d-flex align-items-center justify-content-center p-0 reviews_arrow_right" style="width: 42px; height: 42px; background-color: #ED1E24; border-color: #ED1E24; cursor: pointer; transition: all 0.2s ease;">
                <i class="fa-solid fa-arrow-right text-white small"></i>
            </button>
        </div>
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
        .reviews_arrow_left:hover {
        background: #f0f0f0 !important;
        border-color: #bbb !important;
        }
        .reviews_arrow_right:hover {
        background: #c41019 !important;
        border-color: #c41019 !important;
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
            <p class="display-4 fw-extrabold text-white opacity-1" style="opacity: 1 !important;font-family: Montserrat;font-weight: 800;line-height: 100% !important;letter-spacing: 0px;vertical-align: middle;text-transform: uppercase;">Book your MOT in Peterborough today</h2>
            <p class="mb-4" style="font-family: Mulish;font-weight: 400;vertical-align: middle;text-align: center !important; font-size: 18px !important; color: white;">Get your MOT done quickly in Peterborough with flexible slots and DVSA-approved testing at Smartfit Autos.</p>
            <div>
                <a href="#book-mot"       class="mot-cta-btn-red">BOOK YOUR MOT NOW &rarr;</a>
                <a href="tel:01733569998" class="mot-cta-btn-outline">CALL NOW 01733 569998 &rarr;</a>
            </div>
        </div>
    </section>

</div>
