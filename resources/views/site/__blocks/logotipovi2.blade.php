<section class="brand_logo_section text-center section_space_lg">
    <div class="container">
      <div class="section_heading">
        <h2 class="heading_text mb-0 wow" data-splitting>{!!html_entity_decode($block->input('url'))!!}</h2>
      </div>
      <div class="row brand_logo_blur_effect">

        @foreach ($block->children as $item) 
           
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
              <a class="brand_logo_item" href="{!!html_entity_decode($item->input('url'))!!}">
                <img src="{{$item->image('slika', 'flexible')}}" alt="{!!html_entity_decode($item->input('title'))!!}">
              </a>
            </div>

        @endforeach
        
      </div>
    </div>
  </section>