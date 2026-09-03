@php
    $kol = 12/$block->input('po_redu');
@endphp
<section class="service_section our_services_section section_space_lg">
    <div class="container">
        <div class="section_heading">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="heading_text mb-0 wow" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h2>
                </div>
                @if (!empty($block->input('url')))       
                <div class="col-lg-6 d-none d-lg-flex justify-content-end">
                    <a class="btn btn-primary" href="{{$block->input('url')}}">
                    <span class="btn_text">
                    @php
                        echo !empty($block->input('btn')) ? $block->input('btn') : 'VIEW ALL';
                    @endphp
                    </span>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <div class="row">

            @foreach ($block->children as $item) 
                @php
                    $ikona = 'frontend.ikone.'.(!empty($item->input('ikona')) ? $item->input('ikona') : 'tools');
                @endphp
                <div class="col-lg-{{$kol}} col-md-{{$kol}}  col-sm-6">
                    <div class="service_item">
                        <div class="item_icon">
                            @include($ikona)
                        </div>
                        <div class="item_content">
                        <h3 class="item_title">{!!html_entity_decode($item->input('title'))!!}</h3>
                        <p>
                            {!!html_entity_decode($item->input('description'))!!}
                        </p>
                        <a class="btn-link" href="{!!html_entity_decode($item->input('url'))!!}">
                            <span class="btn_icon"><i class="fa-regular fa-angle-right"></i></span>
                            <span class="btn_text">
                            <small>{!!html_entity_decode($item->input('btn'))!!}</small>
                            <small>{!!html_entity_decode($item->input('btn'))!!}</small>
                            </span>
                        </a>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>

        
        @if (!empty($block->input('url')))       
        <div class="btn_wrap text-center d-lg-none d-block">
            <a class="btn btn-primary" href="{{$block->input('url')}}">
            <span class="btn_text">
                @php
                echo !empty($block->input('btn')) ? $block->input('btn') : 'VIEW ALL';
                @endphp
            </span>
            </a>
        </div>
        @endif
       
    </div>
</section>
