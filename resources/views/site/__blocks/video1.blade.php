<section class="video_section">
    <div class="container">
        <div class="section_heading mb-0">
        <h2 class="heading_text mb-0 wow" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h2>
        </div>
        <hr>
        <div class="video_wrap parallaxie text-center" style="background-image: url('{{$block->image('slika', 'flexible')}}');">
        <a class="video_play_btn popup_video" href="{{$block->input('video_url')}}">
            <i class="fa-duotone fa-play"></i>
        </a>
        </div>
    </div>
</section>