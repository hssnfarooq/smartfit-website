<section class="contact_section section_space_lg">
    <div class="container">
      <div class="section_heading">
        <h3 class="heading_text mb-0 wow" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h3>
      </div>

      <div class="row">

        @for ($i = 1; $i <= 3; $i++)
            @php
                $contactContent = html_entity_decode($block->input('description_'.$i));

                if (request()->is('contacts-kennings-auto-centre')) {
                    if ($i === 1) {
                        $contactContent = '<h3>Address</h3><ul><li><p>7 Welland Rd, Dogsthorpe,<br>Peterborough, PE1 3SA</p></li></ul>';
                    } elseif ($i === 3) {
                        $contactContent = str_replace('+44 1733 569998', '01733 569998', $contactContent);
                    }
                }
            @endphp
            <div class="col-lg-4">
                <div class="contact_info_box">
                    {!! $contactContent !!}
                </div>
            </div>
        @endfor
        
        <div class="col-12">
          <div class="gmap_canvas">
            @if (request()->is('contacts-kennings-auto-centre'))
              <iframe src="https://www.google.com/maps?q=7+Welland+Rd,+Dogsthorpe,+Peterborough,+PE1+3SA&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Smartfit Autos at 7 Welland Road"></iframe>
            @else
              {!!html_entity_decode($block->input('gmap_iframe'))!!}
            @endif
            <!--<iframe src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>-->
          </div>
        </div>
      </div>
    </div>
</section>
