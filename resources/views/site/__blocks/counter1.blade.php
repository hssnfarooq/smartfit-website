<div class="counter_section bg_gray_dark section_space_md">
  <div class="container">
    <div class="counter_items_group row">
      @for ($i = 1; $i <= 4; $i++)
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="counter_item">
            <div class="counter_value">
              <span class="odometer" data-count="{{(int)$block->input('broj_'.$i)}}">{{(int)$block->input('broj_'.$i)}}</span>
              <span>{{preg_replace('/\d/', '', $block->input('broj_'.$i))}}</span>
            </div>
            <hr>
            <p class="counter_description mb-0">{{$block->input('tekst_'.$i)}}</p>
          </div>
        </div>
      @endfor
    </div>
  </div>
</div>