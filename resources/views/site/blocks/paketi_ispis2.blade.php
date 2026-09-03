@if (count($block->getRelated('servicesPackages')) > 0) 
<section class="pricing_section service_packages_section section_space_sm" style="background:#f4f5f7 !important; background-color:#f4f5f7 !important; background-image:none !important;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="section_heading">
            <h2 class="heading_text wow" data-splitting>Service Packages</h2>
            <p class="heading_description">
                {!!html_entity_decode($block->input('description'))!!}
            </p>
            <!--<ul class="info_list unordered_list_block text-uppercase">
              <li>
                <span class="info_icon">
                  <img src="assets/images/icons/icon_square.svg" alt="ProMotors - Icon Square">
                </span>
                <span class="info_text">Same Day Service</span>
              </li>
              <li>
                <span class="info_icon">
                  <img src="assets/images/icons/icon_square.svg" alt="ProMotors - Icon Square">
                </span>
                <span class="info_text">Convenient Location</span>
              </li>
              <li>
                <span class="info_icon">
                  <img src="assets/images/icons/icon_square.svg" alt="ProMotors - Icon Square">
                </span>
                <span class="info_text">Online Appointment</span>
              </li>
            </ul>-->
          </div>
        </div>
             
            @php
                $i = 0;
            @endphp
            @foreach ($block->getRelated('servicesPackages') as $item)
              
                @php
                $save_str = '';
                if($item->action_price > 0){
                  $save_str = $item->price - $item->action_price;
                }

                @endphp
                <div class="col-lg-4">
                  <div class="pricing_item tilt" style="background:#fff !important; background-color:#fff !important; background-image:none !important;">
                    @if (!empty($save_str))
                        <div class="item_badge">Save £{{$save_str}}</div>
                    @endif
                    
                    <h3 class="item_title text-center">{!!html_entity_decode($item->title)!!}</h3>
                    <div class="price_value text-center">
                      <span class="sale_price">£{{$item->action_price > 0 ? $item->action_price :$item->price }}</span>
                      @if (!empty($save_str))
                        <del class="remove_price">£{{$item->price}}</del>
                      @endif              
                    </div>
                    @if (!empty($item->lbl))
                        <h4 class="price_limit text-center">{{$item->lbl}}</h4>
                    @endif            
                    <hr>
                    {!!html_entity_decode($item->long_text)!!}
                    <div class="text-center">
                      <a class="get_service_btn" href="/booking/order">
                        <span class="btn_text">Book Service</span>
                      </a>
                    </div>
                  </div>
                </div>

            @endforeach         
       
      </div>
    </div>
</section>
@endif
