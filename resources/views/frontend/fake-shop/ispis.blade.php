@php
    $stranica = isset($_GET['p']) ? $_GET['p'] : 0;
    $po_stranici = 12;

    $od = $stranica*$po_stranici;


    $width = isset($_GET['w']) ? $_GET['w'] : '';
    $brand = isset($_GET['b']) ? $_GET['b'] : '';
    $rim   = isset($_GET['r']) ? $_GET['r'] : '';
    $ar    = isset($_GET['ar']) ? $_GET['ar'] : '';

    $filter = ' WHERE id > 0';
    if(!empty($width)) $filter .= " AND width = '$width'";
    if(!empty($brand)) $filter .= " AND brand = '$brand'";
    if(!empty($rim)) $filter .= " AND rim = '$rim'";
    if(!empty($ar)) $filter .= " AND aspect_ratio = '$ar'";


    //ukupno
    $sql = "SELECT count(id) FROM proizvodi$filter";
    $result = mysqli_query($mysqli, $sql);
    if($row = mysqli_fetch_row($result))
        $uk = $row[0];

    $br_stranica = $uk/12;


    $qs = "w=$width&b=$brand&r=$rim&ar=$ar";
@endphp
<section class="page_banner" style="background-image: url('assets/images/shapes/tyre_print_3.svg');">
    <div class="container">
      <ul class="breadcrumb_nav unordered_list">
        <li><a href="/">Home</li>
        <li>Our Shop</a></li>
      </ul>
      <h1 class="page_title wow" data-splitting>Our Shop </h1>
    </div>
  </section>


  <section class="shop_section section_space_lg pb-0">
    <div class="container">

      <div class="row">
        <div class="col-12">

                @if (!empty($brand))
                <a href="?w={{$width}}&b=&r={{$rim}}&ar={{$ar}}" style="margin-right: 10px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                      </svg>
                      {{$brand}}
                </a>
                @endif

                @if (!empty($width))
                <a href="?w=&b={{$brand}}&r={{$rim}}&ar={{$ar}}" style="margin-right: 10px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                      </svg>
                      {{$width}}
                </a>
                @endif

                @if (!empty($rim))
                <a href="?w={{$width}}&b={{$brand}}&r=&ar={{$ar}}" style="margin-right: 10px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                      </svg>
                      {{$rim}}
                </a>
                @endif

                @if (!empty($ar))
                <a href="?w={{$width}}&b={{$brand}}&r={{$rim}}&ar=" style="margin-right: 10px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                      </svg>
                      {{$ar}}
                </a>
                @endif
                
                
                
            </div>
        <div class="col-lg-9">
          <div class="row">
            
            @php              
                $sql = "SELECT * FROM proizvodi$filter LIMIT $od, $po_stranici";
                $result = mysqli_query($mysqli, $sql);
            @endphp
            @while ($row = mysqli_fetch_assoc($result))
                @php
                    $url = "?pid=".$row['id'];
                @endphp
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product_item">
                    <!--
                    <ul class="badge_group unordered_list">
                        <li><span class="badge badge-danger">SALE</span></li>
                    </ul>
                    <ul class="badge_group unordered_list">
                        <li><span class="badge badge-primary">NEW</span></li>
                    </ul>
                    -->
                    <a class="item_image" href="{{$url}}">
                        <img src="{{$row['slika']}}" alt="{{$row['title']}}">
                    </a>
                    <div class="item_content">
                        <a class="item_brand" href="?b={{$row['brand']}}">{{$row['brand']}}</a>
                        <h3 class="item_title">
                            <a href="{{$url}}">
                                {{$row['title']}}
                            </a>
                        </h3>
                        

                        <div style="clear: both">
                            <ul class="breadcrumb_nav unordered_list mb-4 mt-4">
                                <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fuel-pump" viewBox="0 0 16 16">
                                    <path d="M3 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M1 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v8a2 2 0 0 1 2 2v.5a.5.5 0 0 0 1 0V8h-.5a.5.5 0 0 1-.5-.5V4.375a.5.5 0 0 1 .5-.5h1.495c-.011-.476-.053-.894-.201-1.222a.97.97 0 0 0-.394-.458c-.184-.11-.464-.195-.9-.195a.5.5 0 0 1 0-1q.846-.002 1.412.336c.383.228.634.551.794.907.295.655.294 1.465.294 2.081v3.175a.5.5 0 0 1-.5.501H15v4.5a1.5 1.5 0 0 1-3 0V12a1 1 0 0 0-1-1v4h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1zm9 0a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h8z"/>
                                    </svg>
                                    {{$row['rolling_resistance']}}
                                </li>
                                <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-volume-up" viewBox="0 0 16 16">
                                    <path d="M11.536 14.01A8.47 8.47 0 0 0 14.026 8a8.47 8.47 0 0 0-2.49-6.01l-.708.707A7.48 7.48 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303z"/>
                                    <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.48 5.48 0 0 1 11.025 8a5.48 5.48 0 0 1-1.61 3.89z"/>
                                    <path d="M10.025 8a4.5 4.5 0 0 1-1.318 3.182L8 10.475A3.5 3.5 0 0 0 9.025 8c0-.966-.392-1.841-1.025-2.475l.707-.707A4.5 4.5 0 0 1 10.025 8M7 4a.5.5 0 0 0-.812-.39L3.825 5.5H1.5A.5.5 0 0 0 1 6v4a.5.5 0 0 0 .5.5h2.325l2.363 1.89A.5.5 0 0 0 7 12zM4.312 6.39 6 5.04v5.92L4.312 9.61A.5.5 0 0 0 4 9.5H2v-3h2a.5.5 0 0 0 .312-.11"/>
                                </svg>
                                {{$row['noise']}}
                                </li>
                                <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-rain" viewBox="0 0 16 16">
                                    <path d="M4.158 12.025a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m3 0a.5.5 0 0 1 .316.633l-1 3a.5.5 0 0 1-.948-.316l1-3a.5.5 0 0 1 .632-.317m3 0a.5.5 0 0 1 .316.633l-.5 1.5a.5.5 0 0 1-.948-.316l.5-1.5a.5.5 0 0 1 .632-.317m3 0a.5.5 0 0 1 .316.633l-1 3a.5.5 0 1 1-.948-.316l1-3a.5.5 0 0 1 .632-.317m.247-6.998a5.001 5.001 0 0 0-9.499-1.004A3.5 3.5 0 1 0 3.5 11H13a3 3 0 0 0 .405-5.973M8.5 2a4 4 0 0 1 3.976 3.555.5.5 0 0 0 .5.445H13a2 2 0 0 1 0 4H3.5a2.5 2.5 0 1 1 .605-4.926.5.5 0 0 0 .596-.329A4 4 0 0 1 8.5 2"/>
                                </svg>
                                {{$row['wet_grip']}}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                                        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
                                    </svg>
                                    {{$row['speed']}}
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                    </svg>   
                                    {{$row['load_index']}}
                                </li>
                            </ul>
                        </div>

                        <div class="item_footer">
                            <div class="item_price">
                                <span class="sale_price">£{{$row['cijena']}}</span>
                            </div>
                            <a class="btn-link" href="#">
                                <span class="btn_icon"><i class="fa-regular fa-angle-right"></i></span>
                                <span class="btn_text">
                                <small>Add To Cart</small>
                                <small>Add To Cart</small>
                                </span>
                            </a>
                        </div>
                    </div>
                    <!--<ul class="cart_btns_group unordered_list_block">
                        <li><a href="#!"><i class="fa-light fa-heart"></i></a></li>
                        <li><a href="#!"><i class="fa-light fa-eye"></i></a></li>
                        <li><a href="#!"><i class="fa-light fa-code-compare"></i></a></li>
                    </ul>-->
                </div>
            </div>
            @endwhile

          </div>
          @if ($br_stranica > 1)
            <div class="pagination_wrap">
                <ul class="pagination_nav unordered_list">
                <li><a href="?p={{$stranica > 0 ? $stranica-1 : 0}}&{{$qs}}"><i class="fa-regular fa-angle-left"></i></a></li>
                @for ($i = 0; $i < $br_stranica; $i++)
                    @php
                        $aktiv = $stranica == ($i) ? ' class=active' : '';
                    @endphp
                    <li{{$aktiv}}><a href="?p={{$i}}&{{$qs}}">{{$i+1}}</a></li>
                @endfor
                <li><a href="?p={{$stranica < $br_stranica ? $stranica+1 : $br_stranica}}&{{$qs}}"><i class="fa-regular fa-angle-right"></i></a></li>
                </ul>
            </div>
          @endif
          
        </div>
        <div class="col-lg-3">
          <aside class="sidebar style_2">
            <!--<div class="widget">
              <h3 class="widget_title">Search</h3>
              <div class="form-group mb-0">
                <input type="search" name="search" class="form-control" placeholder="Search…">
              </div>
            </div>-->

            @php
            $sql = "SELECT DISTINCT(width) FROM proizvodi ORDER BY width ASC";
            $result = mysqli_query($mysqli, $sql);
            @endphp
            <div class="widget">
              <h3 class="widget_title">Width</h3>
               <!--<ul class="info_list unordered_list_block">-->
                <ul class="tags_list unordered_list">
             
                @while ($row = mysqli_fetch_assoc($result))
                <li>
                    <a href="?b={{$brand}}&w={{$row['width']}}&r={{$rim}}&ar={{$ar}}">{{$row['width']}}
                    <!--<span class="info_icon">
                      <img src="assets/images/icons/icon_square.svg">
                    </span>
                    <span class="info_text">{{$row['width']}}</span>-->
                  </a>
                </li>
                @endwhile
              </ul>
            </div>

            @php
            $sql = "SELECT DISTINCT(rim) FROM proizvodi ORDER BY rim ASC";
            $result = mysqli_query($mysqli, $sql);
            @endphp
            <div class="widget">
              <h3 class="widget_title">Rim</h3>
               <!--<ul class="info_list unordered_list_block">-->
                <ul class="tags_list unordered_list">
             
                @while ($row = mysqli_fetch_assoc($result))
                <li>
                    <a href="?b={{$brand}}&w={{$width}}&r={{$row['rim']}}&ar={{$ar}}">{{$row['rim']}}
                    <!--<span class="info_icon">
                      <img src="assets/images/icons/icon_square.svg">
                    </span>
                    <span class="info_text">{{$row['rim']}}</span>-->
                  </a>
                </li>
                @endwhile
              </ul>
            </div>

            @php
            $sql = "SELECT DISTINCT(aspect_ratio) FROM proizvodi ORDER BY aspect_ratio ASC";
            $result = mysqli_query($mysqli, $sql);
            @endphp
            <div class="widget">
              <h3 class="widget_title">Profile</h3>
               <!--<ul class="info_list unordered_list_block">-->
                <ul class="tags_list unordered_list">
             
                @while ($row = mysqli_fetch_assoc($result))
                <li>
                    <a href="?b={{$brand}}&w={{$width}}&r={{$rim}}&ar={{$row['aspect_ratio']}}">{{$row['aspect_ratio']}}
                    <!--<span class="info_icon">
                      <img src="assets/images/icons/icon_square.svg">
                    </span>
                    <span class="info_text">{{$row['aspect_ratio']}}</span>-->
                  </a>
                </li>
                @endwhile
              </ul>
            </div>

            @php
            $sql = "SELECT DISTINCT(brand) FROM proizvodi ORDER BY brand ASC";
            $result = mysqli_query($mysqli, $sql);
            @endphp
            <div class="widget">
              <h3 class="widget_title">Brands</h3>
              <!--<ul class="info_list unordered_list_block">-->
                <ul class="tags_list unordered_list">
                @while ($row = mysqli_fetch_assoc($result))
                <li>
                  <a href="?b={{$row['brand']}}&w={{$width}}&r={{$rim}}&ar={{$ar}}">
                    <!--<span class="info_icon">
                      <img src="assets/images/icons/icon_square.svg">
                    </span>
                    <span class="info_text">-->{{$row['brand']}}<!--</span>-->
                  </a>
                </li>
                @endwhile
              </ul>
            </div>

            <!--
            <div class="widget">
              <h3 class="widget_title">Popular Tags</h3>
              <ul class="tags_list unordered_list">
                <li>
                  <a href="#!">Alignment</a>
                </li>
                <li>
                  <a href="#!">Rotation</a>
                </li>
                <li>
                  <a href="#!">Repair</a>
                </li>
                <li>
                  <a href="#!">Speed</a>
                </li>
                <li>
                  <a href="#!">Servicing</a>
                </li>
                <li>
                  <a href="#!">Technology</a>
                </li>
                <li>
                  <a href="#!">Electronic</a>
                </li>
                <li>
                  <a href="#!">Tire</a>
                </li>
                <li>
                  <a href="#!">Cleaning</a>
                </li>
              </ul>
            </div>
            <div class="widget">
              <h3 class="widget_title">Filter By Price</h3>
              <div class="price-range-area clearfix">
                <div id="slider-range" class="slider-range"></div>
                <div class="price-text">
                  <span>Price:</span>
                  <input type="text" id="amount" readonly>
                </div>
              </div>
            </div>
            <div class="widget">
              <h3 class="widget_title">Feature Products</h3>
              <div class="small_products_list">
                <div class="small_products_item">
                  <a class="item_image" href="shop_details.html">
                    <img src="assets/images/products/product_img_16.png" alt="ProMotors - Product Image">
                  </a>
                  <div class="item_content">
                    <ul class="badge_group unordered_list">
                      <li><span class="badge badge-danger">SALE</span></li>
                    </ul>
                    <h3 class="item_title">
                      <a href="shop_details.html">
                        Car Shock Absorber
                      </a>
                    </h3>
                    <a class="item_brand" href="#!">HSP</a>
                    <div class="item_price">
                      <span class="sale_price">$19</span>
                      <del class="remove_price">$24</del>
                    </div>
                  </div>
                </div>
                <div class="small_products_item">
                  <a class="item_image" href="shop_details.html">
                    <img src="assets/images/products/product_img_17.png" alt="ProMotors - Product Image">
                  </a>
                  <div class="item_content">
                    <h3 class="item_title">
                      <a href="shop_details.html">
                        Silent Bloc Ø10-75mm 
                      </a>
                    </h3>
                    <a class="item_brand" href="#!">HTR</a>
                    <div class="item_price">
                      <span class="sale_price">$15</span>
                    </div>
                  </div>
                </div>
                <div class="small_products_item">
                  <a class="item_image" href="shop_details.html">
                    <img src="assets/images/products/product_img_18.png" alt="ProMotors - Product Image">
                  </a>
                  <div class="item_content">
                    <h3 class="item_title">
                      <a href="shop_details.html">
                        Ball Joint JBJ721
                      </a>
                    </h3>
                    <a class="item_brand" href="#!">TRW</a>
                    <div class="item_price">
                      <span class="sale_price">$39</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        -->

          </aside>
        </div>
      </div>
    </div>
  </section>