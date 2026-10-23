@php
    $serviceAreaId = $serviceAreaId ?? 'service-area';
    $serviceAreaTitle = $serviceAreaTitle ?? 'We serve Peterborough and<br>surrounding areas';
    $serviceAreaDescription = $serviceAreaDescription ?? '';
    $serviceAreaPopupLabel = $serviceAreaPopupLabel ?? 'Smartfit Autos Service Area';
    $serviceAreas = [
        ['Peterborough', 52.5695, -0.2405],
        ['Stamford', 52.6510, -0.4810],
        ['Whittlesey', 52.5574, -0.1315],
        ['Crowland', 52.6756, -0.1661],
        ['Bourne', 52.7686, -0.3770],
        ['Huntingdon', 52.3304, -0.1867],
        ['Oundle', 52.4820, -0.4700],
        ['Sawtry', 52.4370, -0.2830],
        ['Ramsey', 52.4490, -0.1060],
        ['St Ives', 52.3270, -0.0760],
    ];
    $serviceAreaLocations = array_map(
        fn ($area) => ['name' => $area[0], 'lat' => $area[1], 'lng' => $area[2]],
        $serviceAreas
    );
@endphp

@once
<style>
    .sf-service-area {
        padding: 72px 0 60px;
        background: #f2f2f4;
    }
    .sf-service-area__container {
        width: min(1780px, calc(100% - 48px));
        max-width: none;
        margin: 0 auto;
        padding: 0;
    }
    .sf-main-page .page_content h2.sf-service-area__title {
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
    .sf-service-area__card {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        min-height: 536px;
        overflow: hidden;
        border: 1px solid #ddd8d1;
        border-radius: 14px;
        background: #fff;
    }
    .sf-service-area__content {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding: 64px 72px 62px;
    }
    .sf-main-page .page_content p.sf-service-area__copy {
        max-width: 700px;
        margin: 0 0 37px;
        color: #716e6a;
        font-family: Mulish, sans-serif;
        font-size: clamp(1.25rem, 1.4vw, 1.625rem) !important;
        font-weight: 400;
        line-height: 1.5 !important;
        text-align: left !important;
    }
    .sf-service-area__buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 16px 14px;
    }
    .sf-service-area__button {
        display: inline-flex;
        min-height: 64px;
        align-items: center;
        justify-content: center;
        padding: 14px 28px;
        border: 1.5px solid #ded9d2 !important;
        border-radius: 999px;
        color: #4e4d4d !important;
        background: #fff !important;
        font-family: Montserrat, sans-serif;
        font-size: 20px;
        font-weight: 600;
        line-height: 1;
        cursor: pointer;
        transition: color .2s ease, background-color .2s ease, border-color .2s ease;
        text-decoration: none;
        -webkit-clip-path: none !important;
        clip-path: none !important;
    }
    .sf-service-area__button:hover,
    .sf-service-area__button.active {
        border-color: #ed1e24 !important;
        color: #fff !important;
        background: #ed1e24 !important;
    }
    .sf-service-area__button:focus-visible {
        outline: 3px solid rgba(237, 30, 36, .3);
        outline-offset: 3px;
    }
    .sf-service-area__map {
        min-width: 0;
        min-height: 536px;
        background: #e8e0d8;
    }
    .sf-service-area__map-canvas {
        width: 100%;
        height: 100%;
        min-height: 536px;
        background: #e8e0d8 !important;
        color-scheme: light;
    }
    .sf-service-area__map-canvas img,
    .sf-service-area__map-canvas canvas {
        max-width: none !important;
        filter: none !important;
    }
    .sf-service-area__map-canvas .leaflet-tile-container img {
        display: block !important;
        filter: none !important;
    }
    .sf-service-area__pin {
        color: #ed1e24;
        font-size: 64px;
        line-height: 1;
        text-align: center;
        filter: drop-shadow(0 3px 4px rgba(0, 0, 0, .16));
    }
    @media (max-width: 991px) {
        .sf-service-area__card { grid-template-columns: 1fr; }
        .sf-service-area__content { padding: 48px 44px; }
        .sf-service-area__map,
        .sf-service-area__map-canvas { min-height: 380px; height: 380px; }
    }
    @media (max-width: 767px) {
        .sf-service-area { padding: 54px 0 46px; }
        .sf-service-area__container { width: calc(100% - 30px); }
        .sf-main-page .page_content h2.sf-service-area__title {
            margin-bottom: 34px;
            font-size: clamp(2.1rem, 10vw, 3rem) !important;
            line-height: 1.08 !important;
            letter-spacing: -.7px;
        }
        .sf-service-area__content { padding: 34px 24px 38px; }
        .sf-main-page .page_content p.sf-service-area__copy {
            margin-bottom: 28px;
            font-size: 1.05rem !important;
            line-height: 1.55 !important;
        }
        .sf-service-area__buttons { gap: 10px 8px; }
        .sf-service-area__button {
            min-height: 48px;
            padding: 11px 18px;
            font-size: 14px;
        }
        .sf-service-area__map,
        .sf-service-area__map-canvas { min-height: 320px; height: 320px; }
    }
</style>
@endonce

<section class="sf-service-area" data-service-area="{{ $serviceAreaId }}">
    <div class="sf-service-area__container">
        <h2 class="sf-service-area__title">{!! $serviceAreaTitle !!}</h2>

        <div class="sf-service-area__card">
            <div class="sf-service-area__content">
                <p class="sf-service-area__copy">{{ $serviceAreaDescription }}</p>
                <div class="sf-service-area__buttons" aria-label="Choose a service area">
                    @foreach($serviceAreas as $index => [$name, $lat, $lng])
                        <button type="button"
                                class="sf-service-area__button {{ $index === 0 ? 'active' : '' }}"
                                data-service-area-index="{{ $index }}"
                                aria-pressed="{{ $index === 0 ? 'true' : 'false' }}">
                            {{ $name }}
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="sf-service-area__map" data-bs-theme="light">
                <div id="{{ $serviceAreaId }}-map"
                     class="sf-service-area__map-canvas"
                     aria-label="Map of Smartfit Autos service areas"></div>
            </div>
        </div>
    </div>
</section>

<script>
(function () {
    var root = document.querySelector('[data-service-area="{{ $serviceAreaId }}"]');
    if (!root) return;

    var locations = @json($serviceAreaLocations);
    var map;
    var marker;
    var activeLocation = 0;
    var mapId = @json($serviceAreaId . '-map');
    var popupLabel = @json($serviceAreaPopupLabel);

    function popupContent(location) {
        return '<b style="color:#ED1E24;font-size:15px;">' + location.name + '</b><br><small style="color:#555;">' + popupLabel + '</small>';
    }

    function setActiveButton(index) {
        root.querySelectorAll('[data-service-area-index]').forEach(function (button) {
            var isActive = Number(button.dataset.serviceAreaIndex) === index;
            button.classList.toggle('active', isActive);
            button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });
    }

    function selectLocation(index, animate) {
        if (!map || !locations[index]) return;
        activeLocation = index;
        setActiveButton(index);
        var location = locations[index];
        if (animate) map.flyTo([location.lat, location.lng], 12, { duration: .8 });
        marker.setLatLng([location.lat, location.lng]);
        marker.setPopupContent(popupContent(location));
        marker.openPopup();
    }

    function initMap() {
        var element = document.getElementById(mapId);
        if (!element || element._leaflet_id || typeof L === 'undefined') return;

        map = L.map(mapId, { zoomControl: false, scrollWheelZoom: false }).setView([locations[0].lat, locations[0].lng], 11);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        var pin = L.divIcon({
            className: 'sf-service-area__pin',
            html: '<i class="fa-solid fa-location-dot" aria-hidden="true"></i>',
            iconSize: [58, 72],
            iconAnchor: [29, 72],
            popupAnchor: [0, -68]
        });
        marker = L.marker([locations[0].lat, locations[0].lng], { icon: pin }).addTo(map)
            .bindPopup(popupContent(locations[0]));
        marker.on('click', function () { setActiveButton(activeLocation); });

        root.querySelectorAll('[data-service-area-index]').forEach(function (button) {
            button.addEventListener('click', function () {
                selectLocation(Number(button.dataset.serviceAreaIndex), true);
            });
        });

        setTimeout(function () { map.invalidateSize(); }, 300);
    }

    if (document.readyState === 'complete') setTimeout(initMap, 150);
    else window.addEventListener('load', function () { setTimeout(initMap, 150); });
    window.addEventListener('resize', function () { if (map) map.invalidateSize(); });
})();
</script>
