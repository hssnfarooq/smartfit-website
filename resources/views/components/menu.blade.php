@if ($header == 'sastrane')
    <div class="list-group list-group-flush">
        @foreach($links as $link)
            @php
                if(!empty($link->description))
                    $url = $link->description;
                else
                    $url = $link->getRelated('page')->first()->slugBaza.'/'.$link->getRelated('page')->first()->slug;    
                
                if($url == '/home-page') $url = '/';
                
                $isFleet = (strcasecmp(trim($link->title), 'fleet') === 0);
                $klik = '';
                if($link->tree || $isFleet){
                    $url = 'javascript:;';
                    $klik = ' onclick="podmeni('.$link->id.')"';
                }
            @endphp
             <a href="{{$url}}"{!!html_entity_decode($klik)!!} class="list-group-item list-group-item-action list-group-item-success">{{strcasecmp(trim($link->title), 'contacts') === 0 ? 'Contact Us' : (strcasecmp(trim($link->title), 'tyre shop') === 0 ? 'Tyres' : $link->title)}} 
                @if ($link->tree || $isFleet)
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short strelica" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                </svg>
                @endif
             </a>
        @endforeach
    </div>
@else
    
    @php
    $link_klasa = '';
    if($header == 'bijelo')
        $link_klasa = ' bijelo';
    @endphp
    <nav class="main_menu navbar navbar-expand-lg">
        <div class="main_menu_inner collapse navbar-collapse justify-content-center" id="main_menu_dropdown">
            <ul class="main_menu_list unordered_list_center">

                @foreach($links as $link)
                    @php
                        if(!empty($link->description))
                            $url = $link->description;
                        else
                            $url = $link->getRelated('page')->first()->slugBaza.'/'.$link->getRelated('page')->first()->slug;    
                        
                        if($url == '/home-page') $url = '/';
                        
                        $isFleet = (strcasecmp(trim($link->title), 'fleet') === 0);
                        $isServices = (strcasecmp(trim($link->title), 'services') === 0 || strcasecmp(trim($link->title), 'servicing') === 0);
                        $isMot = (strcasecmp(trim($link->title), 'mot') === 0);
                        $isTyres = (strcasecmp(trim($link->title), 'tyres') === 0 || strcasecmp(trim($link->title), 'tyre shop') === 0 || strcasecmp(trim($link->title), 'tyre') === 0);
                        $isRepairs = (strcasecmp(trim($link->title), 'repairs') === 0 || strcasecmp(trim($link->title), 'repair') === 0);
                        $isDropdown = $link->tree || $isFleet || $isServices || $isMot || $isTyres || $isRepairs;
                        $klasa_li = $isDropdown ? ' class="dropdown' . ($isFleet ? ' dropdown_fleet_item' : '') . ($isServices ? ' dropdown_services_item' : '') . ($isMot ? ' dropdown_mot_item' : '') . ($isTyres ? ' dropdown_tyres_item' : '') . ($isRepairs ? ' dropdown_repairs_item' : '') . '"' : '';
                        $klasa_a = $isDropdown ? ' role="button" data-bs-toggle="dropdown" aria-expanded="false"' : '';
                        $onclick = ' onclick="document.location = \'' . $url . '\'"';
                    @endphp
                    <li {!!html_entity_decode($klasa_li)!!}>
                        <a class="nav-link{{$link_klasa}}" href="{{$url}}" id="shop_submenu{{$link->id}}"{!!html_entity_decode($klasa_a)!!}{!!html_entity_decode($onclick)!!}>
                            {{strcasecmp(trim($link->title), 'contacts') === 0 ? 'Contact Us' : (strcasecmp(trim($link->title), 'tyre shop') === 0 ? 'Tyres' : $link->title)}}
                        </a>
                        @if ($isFleet)
                        <div class="dropdown-menu fleet_mega_menu" aria-labelledby="shop_submenu{{$link->id}}">
                            <div class="fleet_mega_menu_inner">
                                <!-- Column 1: Fleet Services -->
                                <div class="fleet_col fleet_col_1">
                                    <p class="fleet_col_title">Fleet Services</p>
                                    <ul class="fleet_list">
                                        <li class="fleet_item">Fleet Maintenance</li>
                                        <li class="fleet_item">Fleet Servicing</li>
                                        <li class="fleet_item">Fleet Repair</li>
                                        <li class="fleet_item">MOT Management</li>
                                    </ul>
                                </div>

                                <!-- Column 2: Business Support -->
                                <div class="fleet_col fleet_col_2">
                                    <p class="fleet_col_title">Business Support</p>
                                    <ul class="fleet_list">
                                        <li class="fleet_item">Contract Work</li>
                                        <li class="fleet_item">parts Sourcing</li>
                                        <li class="fleet_item">Priority Bookings</li>
                                        <li class="fleet_item">Scheduled Maintenance</li>
                                    </ul>
                                </div>

                                <!-- Column 3: Commercial Vehicles -->
                                <div class="fleet_col fleet_col_3">
                                    <p class="fleet_col_title">Commercial Vehicles</p>
                                    <ul class="fleet_list">
                                        <li class="fleet_item">Van Servicing</li>
                                        <li class="fleet_item">Commercial Vehicle Repair</li>
                                        <li class="fleet_item">Vehicle Recovery</li>
                                        <li class="fleet_item">Vehicle Health Checks</li>
                                    </ul>
                                </div>

                                <!-- Column 4: Promotional Content -->
                                <div class="fleet_col fleet_col_4 fleet_promo_col">
                                    <div class="fleet_promo_content">
                                        <h3 class="fleet_promo_heading">Keep your fleet moving</h3>
                                        <p class="fleet_promo_desc">Reliable main tenancy and repair solutions for business and commercial vehicles</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif ($isServices)
                        <div class="dropdown-menu services_mega_menu" aria-labelledby="shop_submenu{{$link->id}}">
                            <div class="fleet_mega_menu_inner services_mega_menu_inner">
                                <!-- Column 1: Vehicle Servicing -->
                                <div class="fleet_col fleet_col_1">
                                    <p class="fleet_col_title">Vehicle Servicing</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item"><a href="/interim-car-service" class="services_menu_link">Interim Car Service</a></li>
                                        <li class="fleet_item"><a href="/full-car-service" class="services_menu_link">Full Car Service</a></li>
                                        <li class="fleet_item"><a href="/major-car-service" class="services_menu_link">Major Car Service</a></li>
                                        <li class="fleet_item"><a href="/manufacturer-approved-service" class="services_menu_link">Manufacturer Approved Service</a></li>
                                        <li class="fleet_item"><a href="/electric-vehicle-servicing-and-maintenance" class="services_menu_link">Electric Vehicle Servicing & Maintenance</a></li>
                                        <li class="fleet_item"><a href="/hybrid-vehicle-servicing" class="services_menu_link">Hybrid Vehicle Servicing</a></li>
                                        <li class="fleet_item"><a href="/car-servicing" class="services_menu_link">Car Servicing</a></li>
                                    </ul>
                                </div>

                                <!-- Column 2: Maintenance -->
                                <div class="fleet_col fleet_col_2">
                                    <p class="fleet_col_title">Maintenance</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item"><a href="/air-conditioning-service" class="services_menu_link">Air Conditioning Service</a></li>
                                        <li class="fleet_item"><a href="/oil-and-filter" class="services_menu_link">Oil & Filter</a></li>
                                        <li class="fleet_item"><a href="/brake-fluid-change" class="services_menu_link">Brake Fluid Change</a></li>
                                        <li class="fleet_item"><a href="/servicing" class="services_menu_link">Servicing</a></li>
                                        <li class="fleet_item"><a href="/free-25-point-health-check" class="services_menu_link">Free 25 Point Health Check</a></li>
                                    </ul>
                                </div>

                                <!-- Column 3: Additional Services -->
                                <div class="fleet_col fleet_col_3">
                                    <p class="fleet_col_title">Additional Services</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item"><a href="/air-conditioning-recharge" class="services_menu_link">Air Conditioning Recharge</a></li>
                                        <li class="fleet_item"><a href="/batteries" class="services_menu_link">Battery Check & Replacement</a></li>
                                        <li class="fleet_item"><a href="/vehicle-diagnostics" class="services_menu_link">Vehicle Diagnostics</a></li>
                                        <li class="fleet_item"><a href="/parts-sourcing" class="services_menu_link">Parts Sourcing</a></li>
                                        <li class="fleet_item"><a href="/vehicle-recovery" class="services_menu_link">Vehicle Recovery</a></li>
                                    </ul>
                                </div>

                                <!-- Column 4: Promotional Content -->
                                <div class="fleet_col fleet_col_4 fleet_promo_col">
                                    <div class="fleet_promo_content">
                                        <h3 class="fleet_promo_heading">Keep your vehicle performing at its best</h3>
                                        <p class="fleet_promo_desc">Routine servicing and maintenance for all makes and models</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif ($isMot)
                        <div class="dropdown-menu mot_mega_menu" aria-labelledby="shop_submenu{{$link->id}}">
                            <div class="fleet_mega_menu_inner mot_mega_menu_inner">
                                <!-- Column 1: MOT -->
                                <div class="fleet_col fleet_col_1">
                                    <p class="fleet_col_title">MOT</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item"><a href="/mot" class="services_menu_link">Book Your MOT</a></li>
                                        <li class="fleet_item"><a href="/mot-class-4" class="services_menu_link">MOT Class 4</a></li>
                                        <li class="fleet_item"><a href="/mot-class-5-kennings-auto-centre" class="services_menu_link">MOT Class 5</a></li>
                                        <li class="fleet_item"><a href="/mot-class-7" class="services_menu_link">MOT Class 7</a></li>
                                        <li class="fleet_item"><a href="/mot-class-4" class="services_menu_link">MOT Retest</a></li>
                                        <li class="fleet_item"><a href="/mot-class-4" class="services_menu_link">MOT Preparation</a></li>
                                        <li class="fleet_item"><a href="/mot" class="services_menu_link">When is My MOT Due</a></li>
                                    </ul>
                                </div>

                                <!-- Column 2: MOT & Service -->
                                <div class="fleet_col fleet_col_2">
                                    <p class="fleet_col_title">MOT & Service</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item"><a href="/mot-class-4-oil-and-filter" class="services_menu_link">Combined MOT & Service</a></li>
                                        <li class="fleet_item"><a href="/mot-class-4-oil-and-filter" class="services_menu_link">MOT Class 4 + Oil & Filter</a></li>
                                        <li class="fleet_item"><a href="/mot-class-4-interim-service" class="services_menu_link">MOT Class 4 + Interim Service</a></li>
                                        <li class="fleet_item"><a href="/mot-class-4-full-service" class="services_menu_link">MOT Class 4 + Full Service</a></li>
                                        <li class="fleet_item"><a href="/mot-class-4-major-service" class="services_menu_link">MOT Class 4 + Major Service</a></li>
                                    </ul>
                                </div>

                                <!-- Column 3: Commercial Vehicles -->
                                <div class="fleet_col fleet_col_3">
                                    <p class="fleet_col_title">Commercial Vehicles</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item"><a href="/mot-class-5-kennings-auto-centre" class="services_menu_link">MOT Class 5 - Smartfit Autos</a></li>
                                        <li class="fleet_item"><a href="/mot-class-7" class="services_menu_link">MOT Class 7</a></li>
                                        <li class="fleet_item"><a href="/mot" class="services_menu_link">Common MOT Failures</a></li>
                                        <li class="fleet_item"><a href="/free-25-point-health-check" class="services_menu_link">Pre MOT Checks</a></li>
                                        <li class="fleet_item"><a href="/mot" class="services_menu_link">MOT Test Advise</a></li>
                                        <li class="fleet_item"><a href="/repairs" class="services_menu_link">MOT Repair</a></li>
                                    </ul>
                                </div>

                                <!-- Column 4: Promotional Content -->
                                <div class="fleet_col fleet_col_4 fleet_promo_col">
                                    <div class="fleet_promo_content">
                                        <h3 class="fleet_promo_heading">MOT due?</h3>
                                        <p class="fleet_promo_desc">Fast and reliable MOT testing available</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif ($isTyres)
                        <div class="dropdown-menu tyres_mega_menu" aria-labelledby="shop_submenu{{$link->id}}">
                            <div class="fleet_mega_menu_inner tyres_mega_menu_inner">
                                <!-- Column 1: Tyre Services -->
                                <div class="fleet_col fleet_col_1">
                                    <p class="fleet_col_title">Tyre Services</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item"><a href="/tyres-2" class="services_menu_link">Tyre Fitting</a></li>
                                        <li class="fleet_item"><a href="/mobile-tyre-fitting" class="services_menu_link">Mobile Tyre Fitting</a></li>
                                        <li class="fleet_item">Puncture Repairs</li>
                                        <li class="fleet_item"><a href="/tyre-pressure-monitoring-system" class="services_menu_link">TPMS</a></li>
                                        <li class="fleet_item">Wheel Balancing</li>
                                        <li class="fleet_item">Tyre Rotation</li>
                                        <li class="fleet_item">Seasonal Tyre Charges</li>
                                    </ul>
                                </div>

                                <!-- Column 2: Wheel & Alignment -->
                                <div class="fleet_col fleet_col_2">
                                    <p class="fleet_col_title">Wheel & Alignment</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item"><a href="/wheel-alignment" class="services_menu_link">Wheel Alignment</a></li>
                                        <li class="fleet_item"><a href="/4-wheel-laser-alignment" class="services_menu_link">4 Wheel Laser Alignment</a></li>
                                        <li class="fleet_item"><a href="/alloy-wheel-refurbishment" class="services_menu_link">Alloy Wheel Refurbishment</a></li>
                                        <li class="fleet_item">Tracking Adjustment</li>
                                        <li class="fleet_item">Wheel Balancing</li>
                                    </ul>
                                </div>

                                <!-- Column 3: Tyre Information -->
                                <div class="fleet_col fleet_col_3">
                                    <p class="fleet_col_title">Tyre Information</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item">Tyre Pressure Advise</li>
                                        <li class="fleet_item">Tyre Safety Checks</li>
                                        <li class="fleet_item">Tyre Wear & Tread Depth</li>
                                        <li class="fleet_item">Tyre Maintenance Tips</li>
                                        <li class="fleet_item">Winter vs Summer Tyres</li>
                                    </ul>
                                </div>

                                <!-- Column 4: Fleet & Commercial -->
                                <div class="fleet_col fleet_col_4">
                                    <p class="fleet_col_title">Fleet & Commercial</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item">Fleet Tyre Management</li>
                                        <li class="fleet_item"><a href="/fleet-and-contract-work" class="services_menu_link">Contract Work</a></li>
                                        <li class="fleet_item">Commercial Vehicle Tyres</li>
                                        <li class="fleet_item">Emergency Tyre Assistance</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @elseif ($isRepairs)
                        <div class="dropdown-menu repairs_mega_menu" aria-labelledby="shop_submenu{{$link->id}}">
                            <div class="fleet_mega_menu_inner repairs_mega_menu_inner">
                                <!-- Column 1: Engine & Mechanical -->
                                <div class="fleet_col fleet_col_1">
                                    <p class="fleet_col_title">Engine & Mechanical</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item">Engine Repairs</li>
                                        <li class="fleet_item">Timing Belt Replacement</li>
                                        <li class="fleet_item"><a href="/clutches" class="services_menu_link">Clutch Repairs</a></li>
                                        <li class="fleet_item">GearBox Repairs</li>
                                        <li class="fleet_item">Cooling System Repairs</li>
                                    </ul>
                                </div>

                                <!-- Column 2: Brakes -->
                                <div class="fleet_col fleet_col_2">
                                    <p class="fleet_col_title">Brakes</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item"><a href="/brakes" class="services_menu_link">Brake Repairs</a></li>
                                        <li class="fleet_item">Brake Pads & Discs</li>
                                        <li class="fleet_item"><a href="/shocks-and-suspension" class="services_menu_link">Suspension Repairs</a></li>
                                        <li class="fleet_item"><a href="/shocks-and-suspension" class="services_menu_link">Shock Absorbers</a></li>
                                        <li class="fleet_item"><a href="/steering" class="services_menu_link">Steering Repair</a></li>
                                    </ul>
                                </div>

                                <!-- Column 3: Electrical & Diagnostics -->
                                <div class="fleet_col fleet_col_3">
                                    <p class="fleet_col_title">Electrical & Diagnostics</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item"><a href="/vehicle-diagnostics" class="services_menu_link">Vehicle Diagnostics</a></li>
                                        <li class="fleet_item"><a href="/batteries" class="services_menu_link">Battery Replacement</a></li>
                                        <li class="fleet_item">Starter Motor Repairs</li>
                                        <li class="fleet_item">Alternator Repairs</li>
                                        <li class="fleet_item">Electrical Fault Finding</li>
                                    </ul>
                                </div>

                                <!-- Column 4: Exhaust & General Repairs -->
                                <div class="fleet_col fleet_col_4">
                                    <p class="fleet_col_title">Exhaust & General Repairs</p>
                                    <ul class="fleet_list services_nav_list">
                                        <li class="fleet_item"><a href="/exhausts" class="services_menu_link">Exhaust Repairs</a></li>
                                        <li class="fleet_item">Welding Repairs</li>
                                        <li class="fleet_item"><a href="/repairs" class="services_menu_link">MOT Repairs</a></li>
                                        <li class="fleet_item"><a href="/repairs" class="services_menu_link">General Vehicle Repairs</a></li>
                                        <li class="fleet_item"><a href="/parts-sourcing" class="services_menu_link">Parts Replacement</a></li>
                                    </ul>
                                    <div class="repairs_promo_content">
                                        <h3 class="fleet_promo_heading">Need a Repair?</h3>
                                        <p class="fleet_promo_desc">From diagnostics to major mechanical work, we 'll get you back on the road quick</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif ($link->tree)
                        <ul class="dropdown-menu" aria-labelledby="shop_submenu{{$link->id}}">
                            @foreach ($link->getRelated('page')->first()->children as $podmeni)
                                <li>
                                    <a href="{{substr($podmeni->slug,0,1) != '/' ? '/' : ''}}{{$podmeni->slug}}">{{$podmeni->title}}</a>                                        
                                </li>
                            @endforeach 

                            @foreach ($link->children as $podmeni)
                                @php
                                if(!empty($podmeni->description))
                                    $url = $podmeni->description;
                                else
                                    $url = $podmeni->getRelated('page')->first()->slugBaza.'/'.$podmeni->getRelated('page')->first()->slug;
                                @endphp
                                <li><a href="{{$url}}">{{$podmeni->title}}</a>
                            </li>
                            @endforeach  
                        </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

    <style>
    /* ==========================================================================
       MEGA-MENU EMBEDDED STYLES (DEPLOYMENT-SAFE FALLBACK)
       ========================================================================== */
    .main_menu_list > li.dropdown_fleet_item > a,
    .main_menu_list > li.dropdown_services_item > a,
    .main_menu_list > li.dropdown_mot_item > a,
    .main_menu_list > li.dropdown_tyres_item > a,
    .main_menu_list > li.dropdown_repairs_item > a {
        position: relative !important;
    }

    .main_menu_list > li.dropdown_fleet_item > a:after,
    .main_menu_list > li.dropdown_services_item > a:after,
    .main_menu_list > li.dropdown_mot_item > a:after,
    .main_menu_list > li.dropdown_tyres_item > a:after,
    .main_menu_list > li.dropdown_repairs_item > a:after {
        display: none !important;
        content: none !important;
    }

    .main_menu_list > li.dropdown_fleet_item > a::before,
    .main_menu_list > li.dropdown_services_item > a::before,
    .main_menu_list > li.dropdown_mot_item > a::before,
    .main_menu_list > li.dropdown_tyres_item > a::before,
    .main_menu_list > li.dropdown_repairs_item > a::before {
        content: '' !important;
        position: absolute !important;
        bottom: -2px !important;
        left: 0 !important;
        width: 100% !important;
        height: 2px !important;
        background-color: var(--smartfit-red, #ED1E24) !important;
        transform: scaleX(0) !important;
        transform-origin: center !important;
        transition: transform 0.25s ease !important;
    }

    .main_menu_list > li.dropdown_fleet_item:hover > a::before,
    .main_menu_list > li.dropdown_fleet_item.show > a::before,
    .main_menu_list > li.dropdown_fleet_item > a:focus::before,
    .main_menu_list > li.dropdown_services_item:hover > a::before,
    .main_menu_list > li.dropdown_services_item.show > a::before,
    .main_menu_list > li.dropdown_services_item > a:focus::before,
    .main_menu_list > li.dropdown_mot_item:hover > a::before,
    .main_menu_list > li.dropdown_mot_item.show > a::before,
    .main_menu_list > li.dropdown_mot_item > a:focus::before,
    .main_menu_list > li.dropdown_tyres_item:hover > a::before,
    .main_menu_list > li.dropdown_tyres_item.show > a::before,
    .main_menu_list > li.dropdown_tyres_item > a:focus::before,
    .main_menu_list > li.dropdown_repairs_item:hover > a::before,
    .main_menu_list > li.dropdown_repairs_item.show > a::before,
    .main_menu_list > li.dropdown_repairs_item > a:focus::before {
        transform: scaleX(1) !important;
    }

    .main_menu_list > li.dropdown_fleet_item:hover > a,
    .main_menu_list > li.dropdown_fleet_item.show > a,
    .main_menu_list > li.dropdown_fleet_item > a:focus,
    .main_menu_list > li.dropdown_services_item:hover > a,
    .main_menu_list > li.dropdown_services_item.show > a,
    .main_menu_list > li.dropdown_services_item > a:focus,
    .main_menu_list > li.dropdown_mot_item:hover > a,
    .main_menu_list > li.dropdown_mot_item.show > a,
    .main_menu_list > li.dropdown_mot_item > a:focus,
    .main_menu_list > li.dropdown_tyres_item:hover > a,
    .main_menu_list > li.dropdown_tyres_item.show > a,
    .main_menu_list > li.dropdown_tyres_item > a:focus,
    .main_menu_list > li.dropdown_repairs_item:hover > a,
    .main_menu_list > li.dropdown_repairs_item.show > a,
    .main_menu_list > li.dropdown_repairs_item > a:focus {
        color: var(--smartfit-red, #ED1E24) !important;
    }

    @media (min-width: 992px) {
        .site_header {
            position: sticky !important;
            top: 0 !important;
            width: 100% !important;
            z-index: 1030 !important;
        }

        .site_header .header_bottom,
        .site_header .header_bottom > .container,
        .site_header .header_bottom .row,
        .site_header .header_bottom .col-lg-8,
        .site_header .meni_bg,
        .site_header .main_menu,
        .site_header .main_menu_inner,
        .site_header .main_menu_list,
        .site_header .dropdown_fleet_item,
        .site_header .dropdown_services_item,
        .site_header .dropdown_mot_item,
        .site_header .dropdown_tyres_item,
        .site_header .dropdown_repairs_item {
            position: static !important;
        }

        .site_header .main_menu_list > li:not(.dropdown_fleet_item):not(.dropdown_services_item):not(.dropdown_mot_item):not(.dropdown_tyres_item):not(.dropdown_repairs_item) {
            position: relative !important;
        }

        .dropdown_fleet_item .fleet_mega_menu,
        .dropdown_services_item .services_mega_menu,
        .dropdown_mot_item .mot_mega_menu,
        .dropdown_tyres_item .tyres_mega_menu,
        .dropdown_repairs_item .repairs_mega_menu {
            position: absolute !important;
            top: 100% !important;
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            max-width: 100vw !important;
            min-width: 100% !important;
            background: #ffffff !important;
            background-color: #ffffff !important;
            border: none !important;
            border-top: 1px solid rgba(0, 0, 0, 0.06) !important;
            border-bottom: 2px solid rgba(0, 0, 0, 0.08) !important;
            box-shadow: 0 25px 45px -10px rgba(0, 0, 0, 0.08) !important;
            margin: 0 !important;
            padding: 0 !important;
            z-index: 1050 !important;
            border-radius: 0 !important;
            box-sizing: border-box !important;
            display: block !important;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(4px);
            transition: opacity 0.22s cubic-bezier(0.16, 1, 0.3, 1), transform 0.22s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.22s ease;
        }

        .dropdown_fleet_item .fleet_mega_menu::before,
        .dropdown_services_item .services_mega_menu::before,
        .dropdown_mot_item .mot_mega_menu::before,
        .dropdown_tyres_item .tyres_mega_menu::before,
        .dropdown_repairs_item .repairs_mega_menu::before {
            content: '' !important;
            position: absolute !important;
            top: -20px !important;
            left: 0 !important;
            right: 0 !important;
            height: 20px !important;
            background: transparent !important;
            border: none !important;
            display: block !important;
            pointer-events: auto !important;
        }

        .dropdown_fleet_item:hover > .fleet_mega_menu,
        .dropdown_fleet_item:focus-within > .fleet_mega_menu,
        .dropdown_fleet_item .fleet_mega_menu.show,
        .dropdown_services_item:hover > .services_mega_menu,
        .dropdown_services_item:focus-within > .services_mega_menu,
        .dropdown_services_item .services_mega_menu.show,
        .dropdown_mot_item:hover > .mot_mega_menu,
        .dropdown_mot_item:focus-within > .mot_mega_menu,
        .dropdown_mot_item .mot_mega_menu.show,
        .dropdown_tyres_item:hover > .tyres_mega_menu,
        .dropdown_tyres_item:focus-within > .tyres_mega_menu,
        .dropdown_tyres_item .tyres_mega_menu.show,
        .dropdown_repairs_item:hover > .repairs_mega_menu,
        .dropdown_repairs_item:focus-within > .repairs_mega_menu,
        .dropdown_repairs_item .repairs_mega_menu.show {
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
            transform: translateY(0) !important;
        }
    }

    .services_row_existing {
        width: 100%;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        background: #fafafa;
        padding: 12px clamp(24px, 4vw, 80px);
        box-sizing: border-box;
    }

    .services_existing_list {
        max-width: 1720px;
        margin: 0 auto !important;
        padding: 0 !important;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px 18px;
        list-style: none !important;
    }

    .services_existing_list li {
        margin: 0 !important;
        padding: 0 !important;
        display: inline-block;
    }

    .services_existing_list li a {
        font-family: var(--bs-font-heading, "Montserrat", sans-serif);
        font-size: 13.5px;
        font-weight: 600;
        color: #333333 !important;
        text-decoration: none !important;
        padding: 4px 10px;
        border-radius: 4px;
        display: inline-block;
        transition: all 0.2s ease;
        text-transform: capitalize;
    }

    .services_existing_list li a:hover {
        color: var(--smartfit-red, #ED1E24) !important;
        background: rgba(237, 30, 36, 0.08);
    }

    .fleet_mega_menu_inner {
        width: 100%;
        max-width: 1720px;
        margin: 0 auto;
        padding: 44px clamp(24px, 4vw, 80px) 48px;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: flex-start;
        box-sizing: border-box;
    }

    .services_mega_menu_inner,
    .mot_mega_menu_inner,
    .tyres_mega_menu_inner,
    .repairs_mega_menu_inner {
        display: grid !important;
        grid-template-columns: repeat(4, 1fr) !important;
        gap: clamp(24px, 3.5vw, 60px) !important;
        align-items: start !important;
    }

    .tyres_mega_menu_inner,
    .repairs_mega_menu_inner {
        padding: 36px clamp(24px, 4vw, 80px) 40px !important;
        gap: clamp(20px, 3.8vw, 70px) !important;
    }

    .tyres_mega_menu_inner .fleet_col_title,
    .repairs_mega_menu_inner .fleet_col_title {
        font-size: 18px !important;
        margin-bottom: 14px !important;
    }

    .tyres_mega_menu_inner .fleet_item,
    .tyres_mega_menu_inner .services_menu_link,
    .repairs_mega_menu_inner .fleet_item,
    .repairs_mega_menu_inner .services_menu_link {
        font-size: 14.5px !important;
        line-height: 1.4 !important;
        margin-bottom: 8px !important;
    }

    .services_mega_menu_inner .fleet_col,
    .mot_mega_menu_inner .fleet_col,
    .tyres_mega_menu_inner .fleet_col,
    .repairs_mega_menu_inner .fleet_col {
        width: 100% !important;
        max-width: 100% !important;
        flex: none !important;
        margin: 0 !important;
        min-width: 0 !important;
    }

    .fleet_col_1 {
        width: 280px;
        flex: 0 0 280px;
        max-width: 280px;
        margin-right: clamp(20px, 3.5vw, 65px);
    }

    .fleet_col_2 {
        width: 280px;
        flex: 0 0 280px;
        max-width: 280px;
        margin-right: clamp(20px, 3.5vw, 65px);
    }

    .fleet_col_3 {
        width: 353px;
        flex: 0 0 353px;
        max-width: 353px;
        margin-right: clamp(20px, 3.5vw, 65px);
    }

    .fleet_promo_col {
        width: 521px;
        flex: 0 0 521px;
        max-width: 521px;
        margin-left: auto;
    }

    .fleet_col_title {
        font-family: var(--bs-font-heading, "Montserrat", sans-serif) !important;
        font-size: 19px !important;
        font-weight: 700 !important;
        color: #111111 !important;
        margin: 0 0 18px 0 !important;
        padding: 0 !important;
        line-height: 1.3 !important;
        letter-spacing: -0.2px !important;
        text-transform: none !important;
    }

    .fleet_mega_menu ul,
    .services_mega_menu ul,
    .mot_mega_menu ul,
    .tyres_mega_menu ul,
    .repairs_mega_menu ul,
    .fleet_mega_menu_inner ul,
    .fleet_list,
    .services_nav_list {
        list-style: none !important;
        list-style-type: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .fleet_mega_menu li,
    .services_mega_menu li,
    .mot_mega_menu li,
    .tyres_mega_menu li,
    .repairs_mega_menu li,
    .fleet_mega_menu_inner li,
    .fleet_item {
        list-style: none !important;
        list-style-type: none !important;
        font-family: var(--bs-font-body, "Mulish", sans-serif) !important;
        font-size: 15px !important;
        font-weight: 400 !important;
        color: #2b2b2b !important;
        line-height: 1.5 !important;
        margin-bottom: 11px !important;
        padding: 0 !important;
        text-transform: none !important;
        white-space: normal !important;
        word-break: normal !important;
        overflow-wrap: break-word !important;
    }

    .services_nav_list .fleet_item {
        pointer-events: auto !important;
        cursor: default !important;
    }

    .services_menu_link {
        font-family: var(--bs-font-body, "Mulish", sans-serif) !important;
        font-size: 15px !important;
        font-weight: 400 !important;
        color: #2b2b2b !important;
        line-height: 1.5 !important;
        text-decoration: none !important;
        display: inline-block !important;
        transition: color 0.18s ease, transform 0.18s ease !important;
        text-transform: none !important;
        white-space: normal !important;
        word-break: normal !important;
        overflow-wrap: break-word !important;
    }

    .services_menu_link:hover,
    .services_menu_link:focus {
        color: var(--smartfit-red, #ED1E24) !important;
        transform: translateX(3px) !important;
        text-decoration: none !important;
    }

    .fleet_item:last-child {
        margin-bottom: 0 !important;
    }

    .fleet_promo_content {
        padding-top: 18px;
        text-align: center;
    }

    .fleet_promo_heading {
        font-family: var(--bs-font-heading, "Montserrat", sans-serif);
        font-size: 24px;
        font-weight: 700;
        font-style: italic;
        color: #111111;
        margin: 0 0 10px 0;
        line-height: 1.3;
        text-transform: none;
    }

    .fleet_promo_desc {
        font-family: var(--bs-font-body, "Mulish", sans-serif);
        font-size: 14px;
        font-style: italic;
        font-weight: 400;
        color: #4a4a4a;
        line-height: 1.55;
        margin: 0;
        text-transform: none;
    }

    .repairs_promo_content {
        margin-top: 24px;
        text-align: right;
    }

    .repairs_promo_content .fleet_promo_heading {
        font-family: var(--bs-font-heading, "Montserrat", sans-serif) !important;
        font-size: 15.5px !important;
        font-weight: 700 !important;
        font-style: italic !important;
        color: #111111 !important;
        margin: 0 0 4px 0 !important;
        line-height: 1.3 !important;
    }

    .repairs_promo_content .fleet_promo_desc {
        font-family: var(--bs-font-body, "Mulish", sans-serif) !important;
        font-size: 12.5px !important;
        font-style: italic !important;
        font-weight: 400 !important;
        color: #4a4a4a !important;
        line-height: 1.4 !important;
        margin: 0 !important;
    }

    @media (min-width: 992px) and (max-width: 1399.98px) {
        .fleet_mega_menu_inner {
            padding: 35px 30px;
            gap: 20px;
        }

        .fleet_col_1,
        .fleet_col_2 {
            width: auto;
            flex: 1 1 200px;
            max-width: 250px;
            margin-right: 0;
        }

        .fleet_col_3 {
            width: auto;
            flex: 1 1 240px;
            max-width: 280px;
            margin-right: 0;
        }

        .fleet_promo_col {
            width: auto;
            flex: 1.2 1 300px;
            max-width: 400px;
        }

        .fleet_item {
            white-space: normal;
        }

        .fleet_promo_heading {
            font-size: 20px;
        }
    }

    @media (min-width: 768px) and (max-width: 991.98px) {
        .dropdown_fleet_item,
        .dropdown_services_item,
        .dropdown_mot_item,
        .dropdown_tyres_item,
        .dropdown_repairs_item {
            position: relative !important;
            width: 100% !important;
        }

        .dropdown_fleet_item .fleet_mega_menu,
        .dropdown_services_item .services_mega_menu,
        .dropdown_mot_item .mot_mega_menu,
        .dropdown_tyres_item .tyres_mega_menu,
        .dropdown_repairs_item .repairs_mega_menu {
            position: static !important;
            width: 100% !important;
            max-width: 100% !important;
            box-shadow: none !important;
            border: 1px solid #e5e5e5 !important;
            border-radius: 8px !important;
            padding: 24px !important;
            margin: 12px 0 !important;
            display: none !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .dropdown_fleet_item .fleet_mega_menu.show,
        .dropdown_services_item .services_mega_menu.show,
        .dropdown_mot_item .mot_mega_menu.show,
        .dropdown_tyres_item .tyres_mega_menu.show,
        .dropdown_repairs_item .repairs_mega_menu.show {
            display: block !important;
        }

        .fleet_mega_menu_inner {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 24px 30px !important;
            padding: 0 !important;
            max-width: 100% !important;
        }

        .fleet_col {
            width: 100% !important;
            max-width: 100% !important;
            flex: none !important;
            margin: 0 !important;
        }

        .fleet_promo_content {
            text-align: left !important;
            padding-top: 0 !important;
        }

        .fleet_item {
            white-space: normal !important;
        }

        .services_row_existing {
            padding: 12px 0 16px 0;
        }
    }

    @media (max-width: 767.98px) {
        .dropdown_fleet_item,
        .dropdown_services_item,
        .dropdown_mot_item,
        .dropdown_tyres_item,
        .dropdown_repairs_item {
            position: relative !important;
            width: 100% !important;
        }

        .dropdown_fleet_item .fleet_mega_menu,
        .dropdown_services_item .services_mega_menu,
        .dropdown_mot_item .mot_mega_menu,
        .dropdown_tyres_item .tyres_mega_menu,
        .dropdown_repairs_item .repairs_mega_menu {
            position: static !important;
            width: 100% !important;
            max-width: 100% !important;
            box-shadow: none !important;
            border: 1px solid #e5e5e5 !important;
            border-radius: 6px !important;
            padding: 16px 14px !important;
            margin: 10px 0 !important;
            display: none !important;
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
        }

        .dropdown_fleet_item .fleet_mega_menu.show,
        .dropdown_services_item .services_mega_menu.show,
        .dropdown_mot_item .mot_mega_menu.show,
        .dropdown_tyres_item .tyres_mega_menu.show,
        .dropdown_repairs_item .repairs_mega_menu.show {
            display: block !important;
        }

        .fleet_mega_menu_inner {
            display: flex !important;
            flex-direction: column !important;
            gap: 20px !important;
            padding: 0 !important;
            max-width: 100% !important;
        }

        .fleet_col {
            width: 100% !important;
            max-width: 100% !important;
            flex: none !important;
            margin: 0 !important;
        }

        .fleet_col_title {
            font-size: 17px !important;
            margin-bottom: 12px !important;
        }

        .fleet_item {
            font-size: 14px !important;
            margin-bottom: 9px !important;
            white-space: normal !important;
        }

        .fleet_promo_content {
            text-align: left !important;
            padding-top: 5px !important;
        }

        .fleet_promo_heading {
            font-size: 18px !important;
        }

        .fleet_promo_desc {
            font-size: 13px !important;
        }

        .services_row_existing {
            padding: 10px 0 14px 0;
        }
    }
    </style>

@endif