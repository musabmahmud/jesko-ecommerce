@extends('frontend.master')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Products</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end -->

    <!-- Product Details Area Start -->
    <div class="product-details-area pt-100px pb-100px" id="productDetails">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-xs-12 mb-lm-30px mb-md-30px mb-sm-30px">
                    <!-- Swiper -->
                    <div class="swiper-container zoom-top">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide zoom-image-hover">
                                <img class="img-responsive m-auto" src="{{ asset('products') }}/{{ $pdtDetail->thumbnail }}"
                                    alt="">
                            </div>
                            @foreach ($pdtDetail->gallery as $gallery)
                                <div class="swiper-slide zoom-image-hover">
                                    <img class="img-responsive m-auto"
                                        src="{{ asset('galleries') }}/{{ $gallery->gallery_name }}"
                                        alt="{{ $pdtDetail->product_name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-container zoom-thumbs mt-3 mb-3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img class="img-responsive m-auto" src="{{ asset('products') }}/{{ $pdtDetail->thumbnail }}"
                                    alt="">
                            </div>
                            @foreach ($pdtDetail->gallery as $gallery)
                                <div class="swiper-slide">
                                    <img class="img-responsive m-auto"
                                        src="{{ asset('galleries') }}/{{ $gallery->gallery_name }}"
                                        alt="{{ $pdtDetail->product_name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="product-details-content quickview-content">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('success') }}
                        </div>
                        @elseif (session('error'))
                            <div class="alert bg-color">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('error') }}
                            </div>
                        @endif
                        <h2>{{ $pdtDetail->product_name }}</h2>
                        <div class="pricing-meta">
                            <span class="price"></span>
                            <span class="offer_price">
                                @if (collect($pdtDetail->attribute)->min('offer_price') < collect($pdtDetail->attribute)->min('price'))
                                    <s>${{ collect($pdtDetail->attribute)->min('price') }}</s> ${{ collect($pdtDetail->attribute)->min('offer_price') }}
                                @else
                                    {{ collect($pdtDetail->attribute)->min('price') }}
                                @endif
                            </span>
                        </div>
                        <div class="pro-details-rating-wrap">
                            <div class="rating-product">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span class="read-review"><a class="reviews" href="#">( 5 Customer Review )</a></span>
                        </div>
                        <form action="{{route('cart.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $pdtDetail->id }}"/>
                            
                        <div class="pro-details-color-info d-flex align-items-center">
                            <span>Color</span>
                            <div class="pro-details-color product-color">
                                <ul>
                                    @foreach ($groups as $group)
                                    <li><input type="radio" value="{{ $group[0]->color_id }}"
                                        data-product="{{ $pdtDetail->id }}" id="cid{{ $group[0]->id }}" name="color_id" class="color_id">
                                        <label for="cid{{ $group[0]->id }}">{{ $group[0]->color->color_name }}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        
                        @error('color_id')
                        <div class="alert bg-color">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ $message }} *
                        </div>
                        @enderror
                        <!-- Sidebar single item -->
                        <div class="pro-details-size-info d-flex align-items-center">
                            <span>Size</span>
                            <div class="pro-details-size product-size">
                            </div>
                        </div>
                        @error('size')
                                    <div class="alert bg-color">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        {{ $message }} *
                                    </div>
                                @enderror
                        <p class="m-0">{{ $pdtDetail->summary }}</p>
                        @error('quantity')
                            <div class="alert bg-color">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ $message }} *
                            </div>
                        @enderror
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="quantity" value="1"/>
                            </div>
                            <div class="pro-details-cart">
                                <button class="add-cart" type="submit" name="submit"> Add To
                                    Cart</button>
                            </div>
                            <div class="pro-details-compare-wishlist pro-details-wishlist ">
                                <a href="wishlist.html"><i class="pe-7s-like"></i></a>
                            </div>
                            <div class="pro-details-compare-wishlist pro-details-compare">
                                <a href="compare.html"><i class="pe-7s-refresh-2"></i></a>
                            </div>
                        </div>
                        </form>
                        <div class="pro-details-sku-info pro-details-same-style  d-flex">
                            <span>Brands: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#">{{ $pdtDetail->brand->brand_name }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-categories-info pro-details-same-style d-flex">
                            <span>Categories: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#">{{ $pdtDetail->category->category_name }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-social-info pro-details-same-style d-flex">
                            <span>Share: </span>
                            <ul class="d-flex">
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- product details description area start -->
    <div class="description-review-area pb-100px" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="description-review-wrapper">
                <div class="description-review-topbar nav">
                    <a data-bs-toggle="tab" href="#des-details2">Information</a>
                    <a class="active" data-bs-toggle="tab" href="#des-details1">Description</a>
                    <a data-bs-toggle="tab" href="#des-details3">Reviews (02)</a>
                </div>
                <div class="tab-content description-review-bottom">
                    <div id="des-details2" class="tab-pane">
                        <div class="product-anotherinfo-wrapper text-start">
                            <ul>
                                <li><span>Weight</span> {{ $pdtDetail->weight }}g</li>
                                <li><span>Materials</span> {{ $pdtDetail->materials }}</li>
                                <li><span>Other Info</span> {{ $pdtDetail->short_info }}</li>
                            </ul>
                        </div>
                    </div>
                    <div id="des-details1" class="tab-pane active">
                        <div class="product-description-wrapper">
                            <p>{{ $pdtDetail->description }}</p>
                        </div>
                    </div>
                    <div id="des-details3" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="review-wrapper">
                                    <div class="single-review">
                                        <div class="review-img">
                                            <img src="{{ asset('frontend') }}/images/review-image/1.png" alt="" />
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        <h4>White Lewis</h4>
                                                    </div>
                                                    <div class="rating-product">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="review-left">
                                                    <a href="#">Reply</a>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>
                                                    Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                    cubilia Curae Suspendisse viverra ed viverra. Mauris ullarper
                                                    euismod vehicula. Phasellus quam nisi, congue id nulla.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-review child-review">
                                        <div class="review-img">
                                            <img src="{{ asset('frontend') }}/images/review-image/2.png" alt="" />
                                        </div>
                                        <div class="review-content">
                                            <div class="review-top-wrap">
                                                <div class="review-left">
                                                    <div class="review-name">
                                                        <h4>White Lewis</h4>
                                                    </div>
                                                    <div class="rating-product">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="review-left">
                                                    <a href="#">Reply</a>
                                                </div>
                                            </div>
                                            <div class="review-bottom">
                                                <p>Vestibulum ante ipsum primis aucibus orci luctustrices posuere
                                                    cubilia Curae Sus pen disse viverra ed viverra. Mauris ullarper
                                                    euismod vehicula.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="ratting-form-wrapper pl-50">
                                    <h3>Add a Review</h3>
                                    <div class="ratting-form">
                                        <form action="#">
                                            <div class="star-box">
                                                <span>Your rating:</span>
                                                <div class="rating-product">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="rating-form-style">
                                                        <input placeholder="Name" type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="rating-form-style">
                                                        <input placeholder="Email" type="email" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="rating-form-style form-submit">
                                                        <textarea name="Your Review" placeholder="Message"></textarea>
                                                        <button class="btn btn-primary btn-hover-color-primary "
                                                            type="submit" value="Submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product details description area end -->

    <!-- Related product Area Start -->
    <div class="related-product-area pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center mb-30px0px line-height-1">
                        <h2 class="title m-0">Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="new-product-slider swiper-container slider-nav-style-1 small-nav">
                <div class="new-product-wrapper swiper-wrapper">
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend') }}/images/product-image/8.jpg" alt="Product" />
                                    <img class="hover-image" src="{{ asset('frontend') }}/images/product-image/6.jpg"
                                        alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                            class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 100%"></span>
                                    </span>
                                    <span class="rating-num">( 5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                        Coat
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend') }}/images/product-image/9.jpg" alt="Product" />
                                    <img class="hover-image" src="{{ asset('frontend') }}/images/product-image/5.jpg"
                                        alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="sale">-10%</span>
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                            class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 80%"></span>
                                    </span>
                                    <span class="rating-num">( 4 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                        Tights</a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                    <span class="old">$48.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend') }}/images/product-image/10.jpg" alt="Product" />
                                    <img class="hover-image" src="{{ asset('frontend') }}/images/product-image/2.jpg"
                                        alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="sale">-7%</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                            class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 90%"></span>
                                    </span>
                                    <span class="rating-num">( 4.5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Long
                                        Sleeve
                                        Shirts</a></h5>
                                <span class="price">
                                    <span class="new">$30.50</span>
                                    <span class="old">$38.00</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend') }}/images/product-image/11.jpg" alt="Product" />
                                    <img class="hover-image" src="{{ asset('frontend') }}/images/product-image/11.jpg"
                                        alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="new">Sale</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                            class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 70%"></span>
                                    </span>
                                    <span class="rating-num">( 3.5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Parrera
                                        Sunglasses -
                                        Lomashop</a></h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend') }}/images/product-image/3.jpg" alt="Product" />
                                    <img class="hover-image" src="{{ asset('frontend') }}/images/product-image/4.jpg"
                                        alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="sale">-10%</span>
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                            class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 80%"></span>
                                    </span>
                                    <span class="rating-num">( 4 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Ardene Microfiber
                                        Tights</a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                    <span class="old">$48.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                    <div class="new-product-item swiper-slide">
                        <!-- Single Prodect -->
                        <div class="product">
                            <div class="thumb">
                                <a href="single-product.html" class="image">
                                    <img src="{{ asset('frontend') }}/images/product-image/1.jpg" alt="Product" />
                                    <img class="hover-image" src="{{ asset('frontend') }}/images/product-image/2.jpg"
                                        alt="Product" />
                                </a>
                                <span class="badges">
                                    <span class="new">New</span>
                                </span>
                                <div class="actions">
                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                            class="pe-7s-like"></i></a>
                                    <a href="#" class="action quickview" data-link-action="quickview" title="Quick view"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                            class="pe-7s-search"></i></a>
                                    <a href="compare.html" class="action compare" title="Compare"><i
                                            class="pe-7s-refresh-2"></i></a>
                                </div>
                                <button title="Add To Cart" class=" add-to-cart">Add
                                    To Cart</button>
                            </div>
                            <div class="content">
                                <span class="ratings">
                                    <span class="rating-wrap">
                                        <span class="star" style="width: 100%"></span>
                                    </span>
                                    <span class="rating-num">( 5 Review )</span>
                                </span>
                                <h5 class="title"><a href="single-product.html">Women's Elizabeth
                                        Coat
                                    </a>
                                </h5>
                                <span class="price">
                                    <span class="new">$38.50</span>
                                </span>
                            </div>
                        </div>
                        <!-- Single Prodect -->
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-buttons">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <script src="{{ asset('frontend') }}/js/vendor/vendor.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/plugins.min.js"></script>

    <!-- Main Js -->
    <script src="{{ asset('frontend') }}/js/main.js"></script>
@endsection

@section('footer_js')
    <script>
        $('.color_id').change(function() {
            var colorId = $(this).val();
            var productId = $(this).attr('data-product');

            $.ajax({
                type: "GET",
                url: "{{ url('get/color/size') }}/" + colorId + '/' + productId,
                success: function(res) {
                    if (res) {
                        $('.product-size').html(res);
                        $('.sizecheck').change(function() {
                            var price = $(this).attr('data-price');
                            var quantity = $(this).attr('data-quantity');
                            var offer = $(this).attr('data-offerprice');
                            if (price > offer) {
                                $('.offer_price').empty();
                                $('.price').html('<s>$' + price +'</s> $' + offer);
                            } else {
                                $('.price').html('$' + price);
                            }
                            // $('.quantityofsize').html(' (' + quantity + ' available)');
                        })
                    } else {

                    }
                }
            })
        })
    </script>
@endsection
