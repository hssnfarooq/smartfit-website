<section class="about_section section_space_sm pb-0">
    <div class="container">
      <div class="section_heading text-center">
        <h2 class="heading_text wow mb-0" data-splitting>
          {!!html_entity_decode($block->input('title'))!!}
        </h2>
        <p>{!!html_entity_decode($block->input('description'))!!}</p>
      </div>

      <ul class="nav tab_nav unordered_list_center" role="tablist">

        <li role="presentation" class="service_tab">
          <button class="active" data-bs-toggle="tab" data-bs-target="#service_tab_1" type="button" role="tab" aria-selected="true">
            <span class="btn_icon">
              <img src="{{ asset('assets/images/icons/icon_lever.svg') }}" alt="">
            </span>
            <span class="btn_text">
              MOT's
            </span>
          </button>
        </li>

        <li role="presentation" class="service_tab">
          <button data-bs-toggle="tab" data-bs-target="#service_tab_2" type="button" role="tab" aria-selected="false">
            <span class="btn_icon">
              <img src="{{ asset('assets/images/icons/icon_engine_2.svg') }}" alt="">
            </span>
            <span class="btn_text">
              Servicing
            </span>
          </button>
        </li>

        <li role="presentation" class="service_tab">
          <button data-bs-toggle="tab" data-bs-target="#service_tab_3" type="button" role="tab" aria-selected="false">
            <span class="btn_icon">
              <img src="{{ asset('assets/images/icons/icon_oil.svg') }}" alt="">
            </span>
            <span class="btn_text">
              Repairs
            </span>
          </button>
        </li>
        <li role="presentation" class="service_tab">
          <button data-bs-toggle="tab" data-bs-target="#service_tab_4" type="button" role="tab" aria-selected="false">
            <span class="btn_icon">
              <img src="{{ asset('assets/images/icons/icone_tire.svg') }}" alt="">
            </span>
            <span class="btn_text">
              Mobile Tyre Fitting
            </span>
          </button>
        </li>
        <li role="presentation" class="service_tab">
          <button data-bs-toggle="tab" data-bs-target="#service_tab_5" type="button" role="tab" aria-selected="false">
            <span class="btn_icon">
              <img src="{{ asset('assets/images/icons/icon_gear.svg') }}" alt="">
            </span>
            <span class="btn_text">
              Parts Sourcing
            </span>
          </button>
        </li>
        <li role="presentation" class="service_tab">
          <button data-bs-toggle="tab" data-bs-target="#service_tab_6" type="button" role="tab" aria-selected="false">
            <span class="btn_icon">
              <img src="{{ asset('assets/images/icons/icon_battery.svg') }}" alt="">
            </span>
            <span class="btn_text">
              Vehicle Recovery
            </span>
          </button>
        </li>
      </ul>


      <div class="tab-content" style="position: relative"><!--  style="background-image: url('{{ asset('assets/images/shapes/tyre_print_5.svg') }}');" -->
        
        @for ($i = 1; $i < 6; $i++)
          <!--<a href="javascript:;" class="autoPoi autoPoi{{$i}}" data-bs-toggle="tab" data-bs-target="#service_tab_{{$i}}" role="tab"></a>-->
        @endfor

        <div class="tab-pane fade show active" id="service_tab_1" role="tabpanel">
          <div class="row align-items-center">
            <div class="col-lg-12" style="position: relative">
              <div class="tab_tekst">
                With MOT test centres throughout the UK and many open 7-days-a-week, it’s no wonder we’re the UK’s number 1 MOT tester. Book a Service at the same time as your car MOT and receive an additional saving over the standard individual product price.
              </div>
              <div class="item_image">
                <img src="{{ asset('assets/images/services_tabs/1.jpg') }}" alt="">
              </div>
            </div>
          </div>
        </div>
        
        <div class="tab-pane fade" id="service_tab_2" role="tabpanel">
          <div class="row align-items-center">
            <div class="col-lg-12" style="position: relative">
              <div class="tab_tekst">
                Book your Essential Car Care, Interim or Full Service online today. Book an MOT test at the same time and receive an additional saving over the standard individual product price.
              </div>
              <div class="item_image">
                <img src="{{ asset('assets/images/services_tabs/2.jpg') }}" alt="">
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="service_tab_3" role="tabpanel">
          <div class="row align-items-center">
            <div class="col-lg-12" style="position: relative">
              <div class="tab_tekst">
                Whether your car requires minor repair work or a major auto part replacement, Kennings Autos Centre is the perfect solution. We understand that car breakdowns can have a drastic effect on your schedule.
              </div>
              <div class="item_image">
                <img src="{{ asset('assets/images/services_tabs/3.jpg') }}" alt="">
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="service_tab_4" role="tabpanel">
          <div class="row align-items-center">
            <div class="col-lg-12" style="position: relative">
              <div class="tab_tekst">
                We know getting new tyres can be a hassle and that taking time out to visit your nearest Smartfit Auto centre Centre can disrupt your busy day. That’s why we introduced our mobile tyre replacement service offering the ultimate in convenience.
              </div>
              <div class="item_image">
                <img src="{{ asset('assets/images/services_tabs/4.jpg') }}" alt="">
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="service_tab_5" role="tabpanel">
          <div class="row align-items-center">
            <div class="col-lg-12" style="position: relative">
              <div class="tab_tekst">
                Time is precious and we are sure you have better things to do than spending hours hunting down prices on replacement car spare parts, that’s where Kennings helps.
              </div>
              <div class="item_image">
                <img src="{{ asset('assets/images/services_tabs/5.jpg') }}" alt="">
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="service_tab_6" role="tabpanel">
          <div class="row align-items-center">
            <div class="col-lg-12" style="position: relative">
              <div class="tab_tekst">
                With a team of skilled motor mechanics available round the clock and operating a modern fleet of specialised trucks from our fully equipped garage, Kennings can deal with any type of vehicle from prestige sports car to fully laden articulated trucks.
              </div>
              <div class="item_image">
                <img src="{{ asset('assets/images/services_tabs/6.jpg') }}" alt="">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>