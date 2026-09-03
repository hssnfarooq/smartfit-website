<section class="product_section section_space_sm pt-0">
    <div class="container">

        <form action="/tyres" method="GET">
            <div class="product_filter_inline row">
                <div class="col-lg-2 col-md-1 col-sm-12">                    
                    <label>CONDITIONS</label>
                    <livewire:components.filter.product-type :name="'season'" />
                </div>
                <div class="col-lg-2 col-md-1 col-sm-12">                    
                    <label>MANUFACTURER</label>
                    <livewire:components.filter.brend :name="'manufacturer'" />
                </div>
                <div class="col-lg-6 col-md-5 col-sm-12">
                    
                    <div class="container"><label>TYRE FITMENT</label>
                        <div class="product_filter_inline row">
                            <div class="col-lg-4">
                                <livewire:components.filter.width :name="'width'" />
                            </div>
                            <div class="col-lg-4">
                                <livewire:components.filter.aspect-ratio :name="'ratio'" />
                            </div>
                            <div class="col-lg-4">
                                <livewire:components.filter.rim :name="'dia'" />
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="col-lg-2 col-md-1 col-sm-12">         
                    <label></label>           
                    <button type="submit" class="btn btn-primary">
                        <span class="btn_text">Search</span>
                      </button>
                </div>

            </div>
        </form>

        <div class="row">
            <div class="col-12">
                <img src="/assets/images/dealer_banner.png" class="img-fluid" />
            </div>
        </div>

        <div class="row">
            @foreach ($this->randomProizvodi as $item) 
            <div class="col-lg-3 col-md-6 col-sm-6">
                <x-proizvod-box :proizvod="$item" />                               
            </div>
            @endforeach  
        </div>
        <!--
        <div class="pagination_wrap">
            <ul class="pagination_nav unordered_list">
            <li><a href="#!"><i class="fa-regular fa-angle-left"></i></a></li>
            <li class="active"><a href="#!">1</a></li>
            <li><a href="#!">2</a></li>
            <li><a href="#!">3</a></li>
            <li><a href="#!"><i class="fa-regular fa-angle-right"></i></a></li>
            </ul>
        </div>
        -->
    </div>
</section>
