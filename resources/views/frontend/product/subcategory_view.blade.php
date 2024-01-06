@extends('frontend.master')

@section('main')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

@section('title')
    {{ $breadsubcat->category->category_name }} > {{ $breadsubcat->subcategory_name }} Subcategory
@endsection



<main class="main">
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">{{ $breadsubcat->subcategory_name }}</h1>
                        <div class="breadcrumb">
                            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>

                            <span style="color : red"> {{ $breadsubcat->category->category_name }} </span> <span>
                                {{ $breadsubcat->subcategory_name }} </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product" id="targetElement">
                        <p id="product-found">We found <strong class="text-brand">{{ count($products) }}</strong> items
                            for you!</p>
                    </div>


                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">

                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a href="#" id="featured" data-value="{{ $id }}">Featured</a>
                                    </li>
                                    <li><a href="#" id="low-to-high" data-value="{{ $id }}">Price: Low
                                            to
                                            High</a></li>
                                    <li><a href="#" id="high-to-low" data-value="{{ $id }}">Price: High
                                            to
                                            Low</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row product-grid" id="withoutajax">

                    @foreach ($products as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img" src="{{ asset($product->product_thambnail) }}"
                                                alt="" />

                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                                                class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                                class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;
                                    @endphp


                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if ($product->discount_price == null)
                                            <span class="new">New</span>
                                        @else
                                            <span class="hot"> {{ round($discount) }} %</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">{{ $product->category->category_name }}</a>
                                    </div>
                                    <h2><a href="shop-product-right.html">{{ $product->product_name }}</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>

                                    <div>

                                        @if ($product->vendor_id == null)
                                            <span class="font-small text-muted">By <a
                                                    href="vendor-details-1.html">Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="vendor-details-1.html">{{ $product->vendor->name }}</a></span>
                                        @endif
                                    </div>
                                    <div class="product-card-bottom">


                                        @if ($product->discount_price == null)
                                            <div class="product-price">
                                                <span>${{ $product->selling_price }}</span>

                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>${{ $product->discount_price }}</span>
                                                <span class="old-price">${{ $product->selling_price }}</span>
                                            </div>
                                        @endif


                                        <div class="add-cart">
                                            <a class="add" href="shop-cart.html"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!--end product card-->



                </div>

                <!-- Ajax filter -->

                <div id="data" class="row product-grid">


                </div>
                <!--end Ajax product card-->


                <!--product grid-->


                <!--End Deals-->


            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">

                <!-- Fillter By Price -->
                <div class="sidebar-widget price_range range mb-30">
                    <h5 class="section-title style-1 mb-30">Fill by price</h5>

                    <div class="price-filter">
                        <div class="price-filter-inner">
                            <div id="slider-range" class="mb-20"></div>
                            <div class="d-flex justify-content-between">
                                <div class="caption">From: <strong id="slider-range-value1"
                                        class="text-brand"></strong></div>
                                <div class="caption">To: <strong id="slider-range-value2"
                                        class="text-brand"></strong></div>
                            </div>
                        </div>
                    </div>


                    <br>
                    <a href="#" id="price-filter" data-value="{{ $id }}"
                        class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>
                        Fillter</a>
                </div>

                <!-- Fillter By Brand -->
                <div class="list-group">
                    <div class="list-group-item mb-10 mt-10">
                        <h5 class="section-title style-1 mb-30">Fill by brand</h5>

                        <div class="custome-checkbox">
                            @foreach ($brands as $item)
                                <input class="form-check-input brand-checkbox" type="checkbox"
                                    id="exampleCheckbox{{ $loop->index + 1 }}" name="brands[]"
                                    value="{{ $item->brand->id }}" />
                                <label class="form-check-label"
                                    for="exampleCheckbox{{ $loop->index + 1 }}"><span>{{ $item->brand->brand_name }}
                                        {{ $item->brand->id }}</span></label>
                                <input type="hidden" name="subcat" data-value="{{ $id }}" />
                                <br />
                            @endforeach

                        </div>

                    </div>
                </div>
                <br>

                <!--category widget --->
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>

                        @foreach ($categories as $item)
                            <li>
                                <a href="/product/category/{{ $item->id }}/{{ $item->category_name }}"> <img
                                        src={{ asset($item->category_image) }}
                                        alt="" />{{ $item->category_name }}</a><span
                                    class="count">{{ $item->products->count() }}</span>
                            </li>
                        @endforeach

                    </ul>
                </div>



            </div>
        </div>
    </div>




</main>

<!---filter mark --->

<script>
    $(document).ready(function() {
        $('.sort-by-dropdown ul li a').click(function(event) {
            event.preventDefault();
            $('.sort-by-dropdown ul li a').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>

<!---end -->


<!---price low to high --->

<script>
    $(document).ready(function() {
        // AJAX request on Get Items button click
        $('#low-to-high').click(function() {
            $('#withoutajax').hide();
            $('#product-found').hide();
            $('html, body').animate({
                scrollTop: 260
            }, 'slow');
            var value = $(this).data('value');
            $.ajax({
                type: 'GET',
                url: '/products/subcat/low-to-high/' + value,
                success: function(response) {
                    // Handle the response (list of items)
                    console.log(response);

                    var productsCount = response.products.length;

                    var rows = ""

                    $.each(response.products, function(key, value) {

                        var discountBadge = "";
                        if (value.discount_percent === null) {
                            discountBadge = '<span class="new">New</span>';
                        } else {
                            discountBadge = '<span class="hot">' + value
                                .discount_percent + '%</span>';
                        }

                        var owner = ""

                        if (value.vendor_id === null) {
                            owner =
                                '<span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>';
                        } else {

                            owner =
                                '<span class="font-small text-muted">By <a href="vendor-details-1.html">' +
                                value.vendor_name + '</a></span>';

                        }

                        var price = ""

                        if (value.discount_price === null) {
                            price = '<div class="product-price"><span>' + value
                                .selling_price + '</span> </div>'
                        } else {
                            price = '<div class="product-price"> <span>' + value
                                .discount_price +
                                '</span> <span class="old-price">' + value
                                .selling_price + '</span> </div>'
                        }


                        rows += `

                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img" src="/${value.product_image}"
                                                alt="" />

                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                                                class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                                class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    


                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        ${discountBadge}
                                    </div>

                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">{{ $product->category->category_name }}</a>
                                    </div>
                                    <h2><a href="shop-product-right.html">${value.product_name}</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>

                                    <div>

                                        
                                      ${owner}
                                        
                                    </div>
                                    <div class="product-card-bottom">


                                       ${price}


                                        <div class="add-cart">
                                            <a class="add" href="shop-cart.html"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        `;
                    });

                    // Display products in the productContainer div
                    $('#data').html(rows);

                    var countData = '<p>We found <strong class="text-brand">' +
                        productsCount + '</strong> items for you!</p>'
                    $('#targetElement').html(countData);

                },
                error: function(error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });



        // Other event handlers for Update and Delete buttons
    });
</script>

<!--end -->

<!---price high to low  --->

<script>
    $(document).ready(function() {
        // AJAX request on Get Items button click
        $('#high-to-low').click(function() {
            $('#withoutajax').hide();
            $('#product-found').hide();
            $('html, body').animate({
                scrollTop: 260
            }, 'slow');
            var value = $(this).data('value');
            $.ajax({
                type: 'GET',
                url: '/products/subcat/high-to-low/' + value,
                success: function(response) {
                    // Handle the response (list of items)
                    console.log(response);

                    var productsCount = response.products.length;

                    var rows = ""

                    $.each(response.products, function(key, value) {

                        var discountBadge = "";
                        if (value.discount_percent === null) {
                            discountBadge = '<span class="new">New</span>';
                        } else {
                            discountBadge = '<span class="hot">' + value
                                .discount_percent + '%</span>';
                        }

                        var owner = ""

                        if (value.vendor_id === null) {
                            owner =
                                '<span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>';
                        } else {

                            owner =
                                '<span class="font-small text-muted">By <a href="vendor-details-1.html">' +
                                value.vendor_name + '</a></span>';

                        }

                        var price = ""

                        if (value.discount_price === null) {
                            price = '<div class="product-price"><span>' + value
                                .selling_price + '</span> </div>'
                        } else {
                            price = '<div class="product-price"> <span>' + value
                                .discount_price +
                                '</span> <span class="old-price">' + value
                                .selling_price + '</span> </div>'
                        }


                        rows += `

                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img" src="/${value.product_image}"
                                                alt="" />

                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                                                class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                                class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    


                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        ${discountBadge}
                                    </div>

                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">{{ $product->category->category_name }}</a>
                                    </div>
                                    <h2><a href="shop-product-right.html">${value.product_name}</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>

                                    <div>

                                        
                                      ${owner}
                                        
                                    </div>
                                    <div class="product-card-bottom">


                                       ${price}


                                        <div class="add-cart">
                                            <a class="add" href="shop-cart.html"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        `;
                    });

                    // Display products in the productContainer div
                    $('#data').html(rows); 

                    var countData = '<p>We found <strong class="text-brand">' +
                        productsCount + '</strong> items for you!</p>'
                    $('#targetElement').html(countData);

                },
                error: function(error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });



        // Other event handlers for Update and Delete buttons
    });
</script>

<!--end -->

<!---filter featured  --->

<script>
    $(document).ready(function() {
        // AJAX request on Get Items button click
        $('#featured').click(function() {
            $('#withoutajax').hide();
            $('#product-found').hide();
            $('html, body').animate({
                scrollTop: 260
            }, 'slow');
            var value = $(this).data('value');
            $.ajax({
                type: 'GET',
                url: '/products/subcat/featured/' + value,
                success: function(response) {
                    // Handle the response (list of items)
                    console.log(response);

                    var productsCount = response.products.length;

                    var rows = ""

                    $.each(response.products, function(key, value) {

                        var discountBadge = "";
                        if (value.discount_percent === null) {
                            discountBadge = '<span class="new">New</span>';
                        } else {
                            discountBadge = '<span class="hot">' + value
                                .discount_percent + '%</span>';
                        }

                        var owner = ""

                        if (value.vendor_id === null) {
                            owner =
                                '<span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>';
                        } else {

                            owner =
                                '<span class="font-small text-muted">By <a href="vendor-details-1.html">' +
                                value.vendor_name + '</a></span>';

                        }

                        var price = ""

                        if (value.discount_price === null) {
                            price = '<div class="product-price"><span>' + value
                                .selling_price + '</span> </div>'
                        } else {
                            price = '<div class="product-price"> <span>' + value
                                .discount_price +
                                '</span> <span class="old-price">' + value
                                .selling_price + '</span> </div>'
                        }


                        rows += `

                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img" src="/${value.product_image}"
                                                alt="" />

                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                                                class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                                class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    


                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        ${discountBadge}
                                    </div>

                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">{{ $product->category->category_name }}</a>
                                    </div>
                                    <h2><a href="shop-product-right.html">${value.product_name}</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>

                                    <div>

                                        
                                      ${owner}
                                        
                                    </div>
                                    <div class="product-card-bottom">


                                       ${price}


                                        <div class="add-cart">
                                            <a class="add" href="shop-cart.html"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        `;
                    });

                    // Display products in the productContainer div
                    $('#data').html(rows);

                    var countData = '<p>We found <strong class="text-brand">' +
                        productsCount + '</strong> items for you!</p>'
                    $('#targetElement').html(countData);

                },
                error: function(error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });



        // Other event handlers for Update and Delete buttons
    });
</script>

<!--end -->

<!---filter bar product -->

<script>
    $(document).ready(function() {

        $('#price-filter').click(function() {

            $('#withoutajax').hide();
            $('#product-found').hide();
            var value = $(this).data('value');

            var minValueText = $("#slider-range-value1").text(); // Accessing text content using .text()
            var maxValueText = $("#slider-range-value2").text();

            var minValue = parseFloat(minValueText.replace('$', '').replace(/,/g, ''));
            var maxValue = parseFloat(maxValueText.replace('$', '').replace(/,/g, ''));



            $.ajax({
                type: 'POST',
                url: '/products/subcat/price-filter/' + value,
                data: {
                    minPrice: minValue,
                    maxPrice: maxValue
                },

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    // Handle the response (list of items)
                    console.log(response);

                    var productsCount = response.products.length;

                    console.log(productsCount)

                    var rows = ""

                    $.each(response.products, function(key, value) {

                        var discountBadge = "";
                        if (value.discount_percent === null) {
                            discountBadge = '<span class="new">New</span>';
                        } else {
                            discountBadge = '<span class="hot">' + value
                                .discount_percent + '%</span>';
                        }

                        var owner = ""

                        if (value.vendor_id === null) {
                            owner =
                                '<span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>';
                        } else {

                            owner =
                                '<span class="font-small text-muted">By <a href="vendor-details-1.html">' +
                                value.vendor_name + '</a></span>';

                        }

                        var price = ""

                        if (value.discount_price === null) {
                            price = '<div class="product-price"><span>' + value
                                .selling_price + 'Tk</span> </div>'
                        } else {
                            price = '<div class="product-price"> <span>' + value
                                .discount_price +
                                'Tk</span> <span class="old-price">' + value
                                .selling_price + 'Tk</span> </div>'
                        }


                        rows += `

                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img" src="/${value.product_image}"
                                                alt="" />

                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                                                class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                                                class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    


                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        ${discountBadge}
                                    </div>

                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">{{ $product->category->category_name }}</a>
                                    </div>
                                    <h2><a href="shop-product-right.html">${value.product_name}</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>

                                    <div>

                                        
                                      ${owner}
                                        
                                    </div>
                                    <div class="product-card-bottom">


                                       ${price}


                                        <div class="add-cart">
                                            <a class="add" href="shop-cart.html"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        `;
                    });

                    // Display products in the productContainer div
                    $('#data').html(rows);

                    var countData = '<p>We found <strong class="text-brand">' +
                        productsCount + '</strong> items for you!</p>'
                    $('#targetElement').html(countData);

                },
                error: function(error) {
                    // Handle errors
                    console.error(error);
                }
            });



        })

    });
</script>

<!--End -->

<!---filter by brand -->
<script>
    $(document).ready(function() {
        $('.brand-checkbox').change(function() {

            $('#withoutajax').hide();
            $('#product-found').hide();

            var value = $('input[name="subcat"]').data('value');
            console.log(value)
            var selectedBrands = [];

            $('.brand-checkbox:checked').each(function() {
                selectedBrands.push($(this).val());
            });

            console.log(selectedBrands)

            // Perform AJAX request with selected brand IDs
            $.ajax({
                type: 'POST',
                url: '/products/subcat/brand-filter/' + value,
                data: {
                    brand_ids: selectedBrands
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);

                    var productsCount = response.products.length;

                    console.log(productsCount)

                    var rows = ""

                    $.each(response.products, function(key, value) {

                        var discountBadge = "";
                        if (value.discount_percent === null) {
                            discountBadge = '<span class="new">New</span>';
                        } else {
                            discountBadge = '<span class="hot">' + value
                                .discount_percent + '%</span>';
                        }

                        var owner = ""

                        if (value.vendor_id === null) {
                            owner =
                                '<span class="font-small text-muted">By <a href="vendor-details-1.html">Owner</a></span>';
                        } else {

                            owner =
                                '<span class="font-small text-muted">By <a href="vendor-details-1.html">' +
                                value.vendor_name + '</a></span>';

                        }

                        var price = ""

                        if (value.discount_price === null) {
                            price = '<div class="product-price"><span>' + value
                                .selling_price + 'Tk</span> </div>'
                        } else {
                            price = '<div class="product-price"> <span>' + value
                                .discount_price +
                                'Tk</span> <span class="old-price">' + value
                                .selling_price + 'Tk</span> </div>'
                        }


                        rows += `

    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
        <div class="product-cart-wrap mb-30">
            <div class="product-img-action-wrap">
                <div class="product-img product-img-zoom">
                    <a href="shop-product-right.html">
                        <img class="default-img" src="/${value.product_image}"
                            alt="" />

                    </a>
                </div>
                <div class="product-action-1">
                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i
                            class="fi-rs-heart"></i></a>
                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i
                            class="fi-rs-shuffle"></i></a>
                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                        data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                </div>

                


                <div class="product-badges product-badges-position product-badges-mrg">
                    ${discountBadge}
                </div>

            </div>
            <div class="product-content-wrap">
                <div class="product-category">
                    <a href="shop-grid-right.html">{{ $product->category->category_name }}</a>
                </div>
                <h2><a href="shop-product-right.html">${value.product_name}</a></h2>
                <div class="product-rate-cover">
                    <div class="product-rate d-inline-block">
                        <div class="product-rating" style="width: 90%"></div>
                    </div>
                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                </div>

                <div>

                    
                  ${owner}
                    
                </div>
                <div class="product-card-bottom">


                   ${price}


                    <div class="add-cart">
                        <a class="add" href="shop-cart.html"><i
                                class="fi-rs-shopping-cart mr-5"></i>Add
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

    `;
                    });

                    // Display products in the productContainer div
                    $('#data').html(rows);

                    var countData = '<p>We found <strong class="text-brand">' +
                        productsCount + '</strong> items for you!</p>'
                    $('#targetElement').html(countData);




                },
                error: function(error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });
    });
</script>


<!--end -->





@endsection
