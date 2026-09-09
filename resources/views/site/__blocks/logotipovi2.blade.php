@php
    $isAboutPage = request()->is('about-us');
    $manufacturerHeading = $isAboutPage
        ? 'Tyres Manufacturers'
        : html_entity_decode($block->input('url'));
    $aboutBrands = $isAboutPage ? config('tyre_manufacturers', []) : [];
@endphp
<section class="brand_logo_section text-center section_space_lg{{ $isAboutPage ? ' about_tyre_manufacturers' : '' }}">
    <div class="container">
      <div class="section_heading">
        <h2 class="heading_text mb-0 wow" data-splitting>{{ $manufacturerHeading }}</h2>
      </div>
      <div class="row brand_logo_blur_effect justify-content-center">
        @if ($isAboutPage)
          @foreach ($aboutBrands as $brand)
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
              <a class="brand_logo_item" href="/tyres?manufacturer={{ urlencode($brand['name']) }}">
                <img
                  src="{{ asset('assets/images/brands/' . $brand['file']) }}"
                  alt="{{ $brand['name'] }}"
                  width="{{ $brand['width'] }}"
                  height="{{ $brand['height'] }}"
                  class="brand_logo_item_novo img-fluid{{ isset($brand['class']) ? ' ' . $brand['class'] : '' }}"
                  loading="lazy"
                  decoding="async"
                >
              </a>
            </div>
          @endforeach
        @else
          @foreach ($block->children as $item)
              <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <a class="brand_logo_item" href="{!!html_entity_decode($item->input('url'))!!}">
                  <img src="{{$item->image('slika', 'flexible')}}" alt="{!!html_entity_decode($item->input('title'))!!}" class="brand_logo_item_novo img-fluid">
                </a>
              </div>
          @endforeach
        @endif
      </div>
    </div>
  </section>
