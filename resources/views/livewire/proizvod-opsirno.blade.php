@php
    $product = $this->product;
    $import_json = json_decode($product->t_import_json ?? '');
    //$proizvod_url = env('GUME_OPSIRNO_SLUG_PREFIX').$this->variant->defaultUrl->slug;


    $brand_name = $product->brand?->name ?? '';
    if (env('IMPORT_PARTNER') == 'stapletons') {
        $naslov = $import_json->make_and_pattern ?? $brand_name;

        $sku = $import_json->stock_code ?? '';
        $width = $import_json->width ?? '';
        $profile = $import_json->ratio ?? '';
        $rim = $import_json->dia ?? '';
        $description = $import_json->stock_description ?? '';
        
        $tmp_slika = strtoupper(str_replace(" ", "_", (string) ($import_json->tyre_image_name ?? '')));
        $proizvod_slika = !empty($tmp_slika) ? '/storage'.env('PROIZVOD_FOLDER').$tmp_slika.'.png' : '';

        $naljepnica_slika = !empty($import_json->label_image_name) ? '/storage'.env('NALJEPNICA_FOLDER').$import_json->label_image_name : '';
    }else {
        $naslov = $import_json->product_title ?? $brand_name;

        $sku = $import_json->product_stock_number ?? '';
        $width = $import_json->width ?? '';
        $profile = $import_json->aspect_ratio ?? '';
        $rim = $import_json->rim ?? '';
        $description = '';

        $proizvod_slika = $import_json->product_best_match_image_url ?? '';
        $naljepnica_slika = '';
    }
@endphp

<section class="details_section shop_details section_space_lg">
    <div class="container">
        <div class="section_space_sm pt-0">
            <div class="row">
            <div class="col-lg-6">
                <div class="image_gallery_carousel">
                    <div class="details_image_carousel">
                        <div class="gallery_image">
                            @if (!empty($proizvod_slika))
                                <img src="{{$proizvod_slika}}" alt="{{ $naslov }}" />
                            @endif
                        </div>
                        @if (!empty($naljepnica_slika))
                            <div class="gallery_image">
                                <img src="{{$naljepnica_slika}}" alt="{{ $naslov }}" />
                            </div>
                        @endif
                    </div>
                    @if (!empty($naljepnica_slika))
                    <div class="details_image_carousel_nav">
                        <div class="gallery_image">
                                @if (!empty($proizvod_slika))
                                    <img src="{{$proizvod_slika}}" alt="{{ $naslov }}" />
                                @endif
                        </div>
                        <div class="gallery_image">
                            <img src="{{$naljepnica_slika}}" alt="{{ $naslov }}" />
                        </div>                   
                    </div>
                    @endif
                </div>               
            </div>
            <div class="col-lg-6">
                <div class="details_content ps-lg-4">
                    <ul class="breadcrumb_nav unordered_list mb-4">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{env('GUME_OPSIRNO_SLUG_PREFIX')}}">Tyres</a></li>
                        <li>{{$naslov}}</li>
                    </ul>

                    <div style="clear: both; height:30px"></div>

                    <h1 class="details_item_title">{{$naslov}}</h1>

                    <x-proizvod-box-ikone :json="$import_json" />
                
                
                    <div style="clear: both; height:30px"></div>
                
                    <x-proizvod-box-cijena :proizvod="$product" />

                    <ul class="product_details_info_list unordered_list_block text-uppercase">
                        <li><span>Sku: </span>{{$sku}}</li>
                        <li>
                            <span>Manufacturer: </span>
                            <a href="#">{{$brand_name}}</a>
                        </li>
                        <li><span>Width: </span>{{$width}}</li>
                        <li><span>Profile: </span>{{$profile}}</li>
                        <li><span>Rim: </span>{{$rim}}</li>
                    </ul>

                    <div style="clear: both"></div>
                    <p>
                        {{$description}}                
                    </p>
                                
                    @if ($this->variant)
                        <livewire:components.add-to-cart :purchasable="$this->variant" :wire:key="$this->variant->id">
                    @endif
                
                </div>
            </div>
            </div>
        </div>
    </div>
</section>
