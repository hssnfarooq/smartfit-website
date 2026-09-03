@php
    $import_json = json_decode($proizvod->t_import_json ?? '');
    $defaultUrl = $proizvod?->defaultUrl;
    $brand = $proizvod?->brand;
    $variant = $proizvod?->variants?->first();

    $isRenderable = $import_json
        && $defaultUrl
        && !empty($defaultUrl->slug)
        && $brand
        && !empty($brand->name)
        && $variant;

    $proizvod_url = '';
    $brand_name = '';
    $naslov = '';
    $sku = '';
    $width = '';
    $profile = '';
    $rim = '';
    $description = '';
    $proizvod_slika = '';
    $naljepnica_slika = '';

    if ($isRenderable) {
        $proizvod_url = env('GUME_OPSIRNO_SLUG_PREFIX').$defaultUrl->slug;
        $brand_name = $brand->name;

        if (env('IMPORT_PARTNER') == 'stapletons') {
            $naslov = $import_json->make_and_pattern ?? $brand_name;

            $sku = $import_json->stock_code ?? '';
            $width = $import_json->width ?? '';
            $profile = $import_json->ratio ?? '';
            $rim = $import_json->dia ?? '';
            $description = $import_json->stock_description ?? '';
            
            $tmp_slika = strtoupper(str_replace(" ", "_", (string) ($import_json->tyre_image_name ?? '')));
            $proizvod_slika = !empty($tmp_slika) ? asset('storage'.env('PROIZVOD_FOLDER').$tmp_slika.'.png') : '';
            $naljepnica_slika = !empty($import_json->label_image_name) ? asset('storage'.env('NALJEPNICA_FOLDER').$import_json->label_image_name) : '';
        } else {
            $naslov = $import_json->product_title ?? $brand_name;

            $sku = $import_json->product_stock_number ?? '';
            $width = $import_json->width ?? '';
            $profile = $import_json->aspect_ratio ?? '';
            $rim = $import_json->rim ?? '';
            $description = '';

            $proizvod_slika = $import_json->product_best_match_image_url ?? '';
            $naljepnica_slika = '';
        }
    }
@endphp

@if ($isRenderable)
<div class="product_item">
    <!--
    <ul class="badge_group unordered_list">
        <li><span class="badge badge-danger">SALE</span></li>
    </ul>
    <ul class="badge_group unordered_list">
        <li><span class="badge badge-primary">NEW</span></li>
    </ul>
    -->
    <a class="item_image" href="{{$proizvod_url}}">
        @if (!empty($proizvod_slika))
            <img src="{{$proizvod_slika}}" alt="{{ $naslov }}" />
        @endif
    </a>
    <div class="item_content">
        <a class="item_brand" href="/tyres?brand_name={{$brand_name}}">{{$brand_name}}</a>
        <h3 class="item_title">
            <a href="{{$proizvod_url}}">
                {{ $naslov }}
            </a>
        </h3>
        
        <x-proizvod-box-ikone :json="$import_json" />

        

        <div class="item_footer">
            <x-proizvod-box-cijena :proizvod="$proizvod" />
            <!--
            <a class="btn-link" href="shop_details.html">
                <span class="btn_icon"><i class="fa-regular fa-angle-right"></i></span>
                <span class="btn_text">
                    <small>Add To Cart</small>
                    <small>Add To Cart</small>
                </span>
            </a>
            -->
        </div>
    </div>
    <!--<ul class="cart_btns_group unordered_list_block">
        <li><a href="#!"><i class="fa-light fa-heart"></i></a></li>
        <li><a href="#!"><i class="fa-light fa-eye"></i></a></li>
        <li><a href="#!"><i class="fa-light fa-code-compare"></i></a></li>
    </ul>-->
</div>
@endif

    <!--
    {"product_stock_number":"1756514HZE03.005.01","product_ean":"6921109014221","product_manufacturer_code":"03.005.01","product_title":"175\/65R14 ZETA ZTR50 82H (CAR SUMMER)","product_group":"TYRES","product_best_match_image_url":"https:\/\/dcjqgkl774ppl.cloudfront.net\/70\/images\/ze-ztr50.jpg","price":"23.97","width":"175","aspect_ratio":"65","rim":"14","speed_rating":"H","load_index":"82","reinforced":"","vehicle_type":"CAR","product_type":"SUMMER","runflat":"false","rolling_resistance":"D","wet_grip":"D","noise_performance":"71","noise_class_type":"2","ec_vehicle_class":"C1","product_available":"30.0","brand_name":"ZETA","brand_group":"House Brand","model_name":"ZTR50"}
    -->

    <!--
        STAPLETONS

{"stock_code":"1257017MSCONTACT","manufacturer":"CONTINENTAL","make_and_pattern":"CONTINENTAL SCONTACT","type":"C","size":"125\/70-17","width":"125","ratio":"70","dia":"17","speed":"M","load_spd":"98M","runflat":"","xl":"","winter":"","price":"47.30","retail":"47.30","stock":"3","ipc_code":"03113660000","stock_description":"125\/70R17 CI SCONTACT 98M","make_type":"P","season":"SUMMER","veh_class":"","rolling_res":"","wet_grip":"","noise_class_type":"","noise_performance":"","tyre_image_name":"CONTINENTAL_SCONTACT","label_image_name":"1257017MSCONTACT.png","ean":"4019238038651","weight":"4.63","oe_sidewall":"","oe_fitment":"","remarks":"","status":"","3peak":"","ice":"","eprel":"0","label_exempt":"Y","fleet":"56.76","online":"999.99"}
-->
