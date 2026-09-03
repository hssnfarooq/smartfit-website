<section class="service_section bg_gray_dark">
    <div class="service_split_wrapper">

        @foreach ($block->children as $item) 
        <div class="service_split_item">
            <div class="item_image">
            <img src="{{$item->image('slika', 'flexible')}}" alt="{!!html_entity_decode($item->input('title'))!!}">
            </div>
            <div class="item_content">
            <div class="section_heading">
                <div class="outline_text">{!!html_entity_decode($item->input('title'))!!}</div>
                <h3 class="heading_text wow" data-splitting>{!!html_entity_decode($item->input('title'))!!}</h3>
                <p class="heading_description mb-0">{!!html_entity_decode($item->input('description'))!!}</p>
            </div>
            <a class="btn btn-primary" href="{{$item->input('url')}}">
                <span class="btn_text">{!!html_entity_decode($item->input('btn'))!!}</span>
            </a>
            </div>
        </div>
        @endforeach

    </div>
</section>