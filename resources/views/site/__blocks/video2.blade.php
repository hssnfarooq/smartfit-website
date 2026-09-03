<section class="video_section">
    <div class="video_wrap parallaxie text-center section_space_lg" style="background-image: url('{{$block->image('slika', 'flexible')}}');">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="section_heading">
              <h2 class="heading_text mb-0 wow" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h2>
            </div>
            <a class="video_play_btn popup_video" href="{{$block->input('video_url')}}">
              <i class="fa-duotone fa-play"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
</section>