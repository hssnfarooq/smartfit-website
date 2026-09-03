<section class="contact_section section_space_sm">
    <div class="container">
      <div class="section_heading">
        <h3 class="heading_text mb-0 wow" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h3>
      </div>

      <div class="row">

        @for ($i = 1; $i <= 3; $i++)
            <div class="col-lg-4">
                <div class="contact_info_box">
                    {!!html_entity_decode($block->input('description_'.$i))!!}
                </div>
            </div>
        @endfor
        
        <div class="col-12">
          <div class="gmap_canvas">
            {!!html_entity_decode($block->input('gmap_iframe'))!!}
            <!--<iframe src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>-->
          </div>
        </div>
      </div>
    </div>
</section>