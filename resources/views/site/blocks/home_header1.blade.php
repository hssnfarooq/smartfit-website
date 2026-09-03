<section class="hero_section hero_section_1">
    <div class="container">
        <div class="row">
        <div class="col-lg-6">
            <div class="hero_section_content">
            <h1 class="hero_title wow" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h1>
            <p>{!!html_entity_decode($block->input('description'))!!}</p>
            <a class="btn btn-primary" href="{{$block->input('url')}}">
                <span class="btn_text">{{$block->input('btn_txt')}}</span>
            </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="hero_section_image">
            <img data-parallax='{"scale" : 0.6, "smoothness": 8}' src="{{$block->image('slika', 'flexible')}}" alt="{{$block->imageAltText('slika')}}">
            </div>
        </div>
        </div>
    </div>
    <div class="outline_text" data-parallax='{"x" : -200, "smoothness": 8}'>{!!html_entity_decode($block->input('bg_tekst'))!!}</div>
</section>