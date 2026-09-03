@php
    $kol = count($block->getRelated('saleActions')) > 0 ? 8 : 12;
@endphp
<section class="hero_promotion_product">
    <div class="container">
        <div class="row">
            <div class="col-lg-{{$kol}}">
                <div class="carousel_1col" data-slick='{"arrows": false}' style="background-image: url('{{ asset('assets/images/shapes/tyre_print_4.svg') }}');">
                    @foreach ($block->children as $item) 
                    <div class="slider_item">
                        <div class="promotion_product_item">
                            <div class="item_content">
                                <div class="discount_text">{!!html_entity_decode($item->input('title'))!!}</div>
                                <h3 class="item_title">
                                    @if (!empty($item->input('url')))
                                        <a href="{{$item->input('url')}}">
                                            {!!html_entity_decode($item->input('description'))!!}
                                        </a>
                                    @else
                                        {!!html_entity_decode($item->input('description'))!!}
                                    @endif
                                    
                                </h3>
                                @if (!empty($item->input('url')))
                                <div class="btn_wrap pb-0">
                                    <a class="btn btn-primary" href="{{$item->input('url')}}">
                                        <span class="btn_text">
                                            @php
                                                echo !empty($block->input('btn')) ? $item->input('btn') : 'VIEW ALL';
                                            @endphp
                                        </span>
                                    </a>
                                </div>    
                                @endif
                                
                            </div>
                            @if ($item->hasImage('slika', 'flexible'))
                                <div class="item_image">
                                    <img src="{{$item->image('slika', 'flexible')}}" alt="{{$item->input('title')}}">
                                </div>
                            @endif                            
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            @if (count($block->getRelated('saleActions')) > 0)
                <div class="col-lg-4">
                    <div class="row">
                        @foreach ($block->getRelated('saleActions') as $item)
                            <div class="col-lg-12 col-md-6 col-sm-6">
                                <div class="promotion_product_item small_content" style="background-image: url('{{ asset('assets/images/shapes/tyre_print_4.svg') }}');">
                                    <div class="item_content">
                                        <h3 class="item_title">
                                            <a href="{{$item->input('url')}}">
                                                {!!html_entity_decode($item->input('title'))!!}
                                            </a>
                                        </h3>
                                        <div class="btn_wrap pb-0">
                                            <a class="btn-link" href="{{$item->input('url')}}">
                                            <span class="btn_icon"><i class="fa-regular fa-angle-right"></i></span>
                                            <span class="btn_text">
                                                <small>Shop Now</small>
                                                <small>Shop Now</small>
                                            </span>
                                            </a>
                                        </div>
                                    </div>
                                    @if ($item->hasImage('slika', 'flexible'))
                                        <div class="item_image">
                                            <img src="{{$item->image('slika', 'flexible')}}" alt="{{$item->input('title')}}">
                                        </div>
                                    @endif  
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
        </div>
    </div>
</section>