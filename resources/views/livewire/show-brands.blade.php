<section class="brand_logo_section py-4 bg-white border-bottom">
    <div class="container">
        @if(!empty($this->sectionTitle))
        <div class="section_heading text-center mb-4">
            <h2 class="heading_text mb-0 fw-bold">{!!html_entity_decode($this->sectionTitle)!!}</h2>
        </div>
        @endif
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3 justify-content-center align-items-center">
            @foreach ($this->brands as $item) 
                @if (count($item->products) > 0)
                <div class="col">
                    <a href="{{env('GUME_OPSIRNO_SLUG_PREFIX')}}?manufacturer={{$item->name}}" class="d-flex align-items-center justify-content-center p-3 bg-white border rounded-3 text-decoration-none shadow-sm h-100 brand_card_hover" style="height: 90px;">
                        @if ($item->thumbnail && file_exists(public_path('storage/' . $item->thumbnail->id . '/' . $item->thumbnail->file_name)))
                            <img src="{{$item->thumbnail->getUrl()}}" alt="{{$item->name}}" style="max-height: 48px; max-width: 140px; width: auto; height: auto; object-fit: contain;">
                        @else
                            <span class="fw-bold text-dark fs-5">{{$item->name}}</span>
                        @endif
                    </a>
                </div>  
                @endif
            @endforeach
        </div>
    </div>
</section>
