@php
    $naslov = $block->input('title');
    $tekst  = $block->input('description');

    $slika  = $block->image('slika', 'flexible');

 
@endphp
<section class="video_section">
    <div class="video_wrap parallaxie text-center section_space_sm" style="background-image: url('{{$slika}}');">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            @if (!empty($naslov) || !empty($tekst))
            <div class="section_heading">
              @if (!empty($naslov))
              <h2 class="heading_text wow mb-0" data-splitting>
                {!!html_entity_decode($naslov)!!}
              </h2>
              @endif
              @if (!empty($tekst))
                <p class="heading_description mb-0">
                  {!!html_entity_decode($tekst)!!}
              </p>
              @endif
            </div>
            @endif
            <div class="text-center">
              <a class="get_service_btn" href="/booking/order">
                <span class="btn_text">Book Service</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
