<section class="blog_section">
    <div class="container">
        <div class="section_heading">
            <h2 class="heading_text mb-0 wow" data-splitting>{!!html_entity_decode($item->input('title'))!!}</h2>
        </div>

        @if (count($block->getRelated('pages')) > 0)      
            <div class="row">
            @php
                $i = 0;
            @endphp
            @foreach ($block->getRelated('pages') as $item)
                @php
                    $i++;
                    
                    $klasa_item = $i > 1 ? '' : ' content_above_image';
                    $klasa_kol = $i > 1 ? 'col-lg-4 col-md-6 col-sm-6' : 'col-lg-12 col-md-12 col-sm-12';
                @endphp
                <div class="{{$klasa_kol}}">
                    <div class="blog_item{{$klasa_item}}">
                        <a class="item_image" href="{{$item->slug}}">
                            <img src="{{$item->image('slika', 'Crop 16:9')}}" alt="{!!html_entity_decode($item->title)!!}">
                        </a>
                        <div class="item_content">
                            <h3 class="item_title">
                                <a href="{{$item->slug}}">
                                    {!!html_entity_decode($item->title)!!}
                                </a>
                            </h3>
                            <a class="btn-link" href="{{$item->slug}}">
                                <span class="btn_icon"><i class="fa-regular fa-angle-right"></i></span>
                                <span class="btn_text">
                                    <small>Read More</small>
                                    <small>Read More</small>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach  
            </div>        
        @endif
    </div>
</section>