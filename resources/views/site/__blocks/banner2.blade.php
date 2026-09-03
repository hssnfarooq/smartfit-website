  <section class="video_section">
    <div class="video_wrap parallaxie section_space_lg" style="background-image: url('{{$block->image('slika', 'flexible')}}');">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="section_heading pe-lg-5">
              <div class="outline_text">{!!html_entity_decode($block->input('btn_tekst'))!!}</div>
              <h2 class="heading_text wow" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h2>
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