<section class="brand_logo_section text-center">
    <div class="container">
      <div class="section_heading">
        <h2 class="heading_text mb-0 wow" data-splitting>{!!html_entity_decode($block->input('url'))!!}</h2>
      </div>
    </div>

    <div class="brand_logo_carousel brand_logo_blur_effect row align-items-center" data-slick='{"dots":false, "arrows": false}'>

      @foreach ($block->children as $item) 
           
          <div class="col-">
            <a class="brand_logo_item" href="{!!html_entity_decode($item->input('url'))!!}">
              <img src="{{$item->image('slika', 'flexible')}}" alt="{!!html_entity_decode($item->input('title'))!!}">
            </a>
          </div>

      @endforeach

    </div>
  </section>