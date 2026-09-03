<section class="video_section">
    <div class="video_wrap parallaxie text-center section_space_lg" style="background-image: url('{{$block->image('slika', 'flexible')}}');">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="section_heading">
              <h2 class="heading_text wow mb-0" data-splitting>
                {!!html_entity_decode($block->input('title'))!!}
              </h2>
              <p class="heading_description mb-0">
                {!!html_entity_decode($block->input('description'))!!}
            </p>
            </div>
            <a class="btn btn-primary" href="{!!html_entity_decode($block->input('url'))!!}">
              <span class="btn_text">{!!html_entity_decode($block->input('btn_tekst'))!!}</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>