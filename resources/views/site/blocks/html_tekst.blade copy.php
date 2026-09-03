<section class="details_section section_space_sm">
    <div class="container">
      <div class="row">
        <div class="details_content">
          @php
              $tekst = $block->input('description');
              $tekst = str_replace('<blockquote>', '<blockquote><div class="quote_icon"><img src="assets/images/icons/icon_quote.svg"></div>', $tekst);
          @endphp
            {!!html_entity_decode($tekst)!!}
        </div>
      </div>
    </div>
</section>