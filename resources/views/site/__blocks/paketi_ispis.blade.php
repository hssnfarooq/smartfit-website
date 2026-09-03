@if (count($block->getRelated('servicesPackages')) > 0) 
<section class="pricing_section section_space_lg pb-0">
  <div class="container">
    <div class="section_heading text-center">
      <div class="outline_text">{!!html_entity_decode($block->input('subtitle'))!!}</div>
      <h2 class="heading_text wow mb-0" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h2>
    </div>
    <div class="row">


      @foreach ($block->getRelated('servicesPackages') as $item)
                
          @php
          $save_str = '';
          if($item->action_price > 0){
            $save_str = $item->price - $item->action_price;
          }
          @endphp
          
          <div class="col-lg-4">
            <div class="pricing_item style_2 tilt">
              
              <div class="image_widget">
                <img src="{{$item->image('slika', 'flexible')}}" alt="{!!html_entity_decode($item->title)!!}">
              </div>
              
              @if (!empty($save_str))
                  <div class="item_badge">Save £{{$save_str}}</div>
              @endif
              <h3 class="item_title">{!!html_entity_decode($item->title)!!}</h3>
              <p class="item_description">
                {!!html_entity_decode($item->description)!!} 
              </p>
              <h4 class="list_title">What is Included</h4>
              {!!html_entity_decode($item->long_text)!!}
              <div class="price_value justify-content-start">
                <span class="sale_price">£{{$item->action_price > 0 ? $item->action_price :$item->price }}</span>
                @if (!empty($save_str))
                  <del class="remove_price">£{{$item->price}}</del>
                @endif              
              </div>
              <a class="btn btn-primary" href="#!">
                <span class="btn_text">Get Service</span>
              </a>
            </div>
          </div>

      @endforeach  
    </div>
  </div>
</section>
@endif