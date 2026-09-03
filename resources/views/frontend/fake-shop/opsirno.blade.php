@php
$sql = "SELECT * FROM proizvodi WHERE id = $proizvod_id";
$result = mysqli_query($mysqli, $sql);   
@endphp
@if ($result && mysqli_num_rows($result) > 0)
    @if ($row = mysqli_fetch_assoc($result))

        <section class="details_section shop_details section_space_lg">
            <div class="container">
                <div class="section_space_sm pt-0">
                    <div class="row">
                    <div class="col-lg-6">
                        <div class="image_gallery_carousel">
                        <div class="details_image_carousel">
                            <div class="gallery_image">
                            <img src="{{$row['slika']}}" alt="{{$row['title']}}">
                            </div>
                        </div>
                        <!--<div class="details_image_carousel_nav">
                                <div class="gallery_image">
                                <img src="assets/images/products/product_img_1.png" alt="ProMotors - Product Image">
                                </div>
                                <div class="gallery_image">
                                <img src="assets/images/products/product_img_4.png" alt="ProMotors - Product Image">
                                </div>
                                <div class="gallery_image">
                                <img src="assets/images/products/product_img_2.png" alt="ProMotors - Product Image">
                                </div>
                                <div class="gallery_image">
                                <img src="assets/images/products/product_img_17.png" alt="ProMotors - Product Image">
                                </div>
                                <div class="gallery_image">
                                <img src="assets/images/products/product_img_7.png" alt="ProMotors - Product Image">
                                </div>
                                <div class="gallery_image">
                                <img src="assets/images/products/product_img_8.png" alt="ProMotors - Product Image">
                                </div>
                                <div class="gallery_image">
                                <img src="assets/images/products/product_img_13.png" alt="ProMotors - Product Image">
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="details_content ps-lg-4">
                        <ul class="breadcrumb_nav unordered_list mb-4">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="shop.html">Our Shop</a></li>
                            <li>{{$row['title']}}</li>
                        </ul>
                        <h1 class="details_item_title">{{$row['title']}}</h1>

                        <div style="clear: both">
                            <ul class="breadcrumb_nav unordered_list mb-4">
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
                        <div style="clear: both; height:30px"></div>
                        <div class="item_price">
                            <span class="sale_price">£{{$row['cijena']}}</span>
                            <!--<del class="remove_price">$76</del>-->
                        </div>
                        <!--
                        <ul class="rating_star unordered_list mb-4">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                        -->
                        
                        
                        

                        <ul class="product_details_info_list unordered_list_block text-uppercase">
                            <li><span>Sku: </span>{{$row['sifra1']}}</li>
                            <li>
                                <span>Manufacturer: </span>
                                <a href="/our-shop?b={{$row['brand']}}">{{$row['brand']}}</a>
                            </li>
                            <li><span>Width: </span>{{$row['width']}}</li>
                            <li><span>Profile: </span>{{$row['aspect_ratio']}}</li>
                            <li><span>Rim: </span>{{$row['rim']}}</li>
                            </li>
                        </ul>

                        <div style="clear: both"></div>
                        <p>
                            
                            




                            @php
                                /*
                            $sifra1 = $data[0];
                                    $sifra2 = $data[1];
                                    $sifra3 = $data[2];
                                    $title = $data[3];
                                    $kategorija = $data[4];
                                    $slika = $data[5];
                                    $cijena = $data[6];
                                    $width = $data[7];
                                    $aspect_ratio = $data[8];
                                    $rim = $data[9];
                                    $speed = $data[10];
                                    $load_index = $data[11];
                                    $reinforced = $data[12];
                                    $runflat = $data[13];
                                    $rolling_resistance = $data[14];
                                    $wet_grip = $data[15];
                                    $noise = $data[16];
                                    $noise_class = $data[17];
                                    $ec_vehicle_class = $data[18];
                                    $prod_available = $data[19];
                                    $brand = $data[20];
                                    $brand_group = $data[21];
                                    $model_name = $data[22];
                                */
                            @endphp
                        </p>
                        <ul class="cart_btns_group unordered_list mb-4">
                            <li>
                            <div class="quantity_form">
                                <button type="button" class="input_number_decrement">
                                <i class="fa-regular fa-minus"></i>
                                </button>
                                <input class="input_number" type="text" value="1">
                                <button type="button" class="input_number_increment">
                                <i class="fa-regular fa-plus"></i>
                                </button>
                            </div>
                            </li>
                            <li>
                            <a class="btn btn-primary" href="#!">
                                <span class="btn_text">Buy Now</span>
                            </a>
                            </li>
                        </ul>
                        
                        </div>
                    </div>
                    </div>
                </div>
                <!--<div class="product_additional_info">
                    <ul class="nav tab_nav style_3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="active" data-bs-toggle="tab" data-bs-target="#tab_description" type="button" role="tab" aria-selected="true">
                        Description
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button data-bs-toggle="tab" data-bs-target="#tab_additional_information" type="button" role="tab" aria-selected="false">
                        Additional Information
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button data-bs-toggle="tab" data-bs-target="#tab_reviews" type="button" role="tab" aria-selected="false">
                        Reviews
                        </button>
                    </li>
                    </ul>
                    <div class="tab-content p-0 bg-transparent">
                    <div class="tab-pane fade show active" id="tab_description" role="tabpanel">
                        <h3 class="details_info_title">Product Description</h3>
                        <p class="p-0">
                        One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus voluptates nisi hic alias libero explicabo reiciendis sint ut quo nulla ipsa aliquid neque molestias et qui sunt. Odit, molestiae. One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus voluptates nisi hic alias libero explicabo reiciendis sint ut quo nulla ipsa aliquid neque molestias et qui sunt. Odit, molestiae.
                        </p>
                        <p class="mb-0 p-0">
                        One Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, iste, architecto ullam tenetur quia nemo ratione tempora consectetur quos minus voluptates nisi hic alias libero explicabo reiciendis sint ut quo nulla ipsa aliquid neque molestias et qui sunt. Odit, molestiae.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="tab_additional_information" role="tabpanel">
                        <ul class="additional_info_list unordered_list_block">
                        <li>
                            <span>Repair Kit Type</span>
                            <span>Maintenance Kit</span>
                        </li>
                        <li>
                            <span>Number of Pieces</span>
                            <span>1</span>
                        </li>
                        <li>
                            <span>Package Depth (cm)</span>
                            <span>22.61 cm</span>
                        </li>
                        <li>
                            <span>Package Depth (in)</span>
                            <span>8.90 in</span>
                        </li>
                        <li>
                            <span>Package Height (cm)</span>
                            <span>6.86 cm</span>
                        </li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tab_reviews" role="tabpanel">
                        <div class="review_form">
                        <form action="#">
                            <div class="form-group">
                            <label>Your Name</label>
                            <ul class="rating_star unordered_list">
                                <li><a href="#!"><i class="fas fa-star"></i></a></li>
                                <li><a href="#!"><i class="fas fa-star"></i></a></li>
                                <li><a href="#!"><i class="fas fa-star"></i></a></li>
                                <li><a href="#!"><i class="fas fa-star"></i></a></li>
                                <li><a href="#!"><i class="fas fa-star"></i></a></li>
                            </ul>
                            </div>
                            <div class="row mb-4">
                            <div class="col-12">
                                <div class="form-group mb-0">
                                <label for="input_comment">Your Comment</label>
                                <textarea name="comment" class="form-control" id="input_comment" placeholder="Write Your Comment"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                <label for="input_name">Your Name</label>
                                <input type="text" name="name" class="form-control" id="input_name" placeholder="Enter Your Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-0">
                                <label for="input_email_2">Your Email</label>
                                <input type="email" name="email" class="form-control" id="input_email_2" placeholder="Enter Your Email">
                                </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                            <span class="btn_text">Submit Review</span>
                            </button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>-->
            </div>
        </section>

    @endif
  @endif