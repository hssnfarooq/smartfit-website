<section class="workprocess_section section_space_lg">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="section_heading pe-lg-5">
            <h2 class="heading_text wow" data-splitting>{!!html_entity_decode($block->input('title'))!!}</h2>
            <p class="heading_description mb-0">
                {!!html_entity_decode($block->input('description'))!!}
            </p>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="row">
            @php
                $i = 0;
            @endphp
            @foreach ($block->children as $item) 
                @php
                    $i++;
                @endphp
                <div class="col-md-6 col-sm-6">
                    <div class="workprocess_item">
                        <h3 class="item_title">
                        <span class="serial_number">{{'0'.$i}}</span>
                        <span class="title_text">{!!html_entity_decode($item->input('title'))!!}</span>
                        </h3>
                        <p class="mb-0">{!!html_entity_decode($item->input('description'))!!}</p>
                    </div>
                </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>