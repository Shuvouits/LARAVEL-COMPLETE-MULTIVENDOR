@php
    $seo = App\Models\Seo::find(1);
@endphp
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="title" content="{{ $seo->meta_title }}" />
    <meta name="author" content="{{ $seo->meta_author }}" />
    <meta name="keywords" content="{{ $seo->meta_keyword }}" />
    <meta name="description" content="{{ $seo->meta_description }}" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('Frontend/assets/imgs/banner/favicon.png') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/plugins/slider-range.css') }}" />
    <link rel="stylesheet" href="{{ asset('Frontend/assets/css/main.css?v=5.3') }}" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>

<style>
    .hero-slider-1 .single-hero-slider {
        height: 700px !important;

    }
</style>

<body>
    <!-- Modal -->

    <!-- Quick view -->
    @include('frontend.body.quickview')

    @include('frontend.body.header')

    <main class="main">
        @yield('main')

    </main>

    @include('frontend.body.footer')

    <!-- Preloader Start -->

    {{--   

         <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('Frontend/assets/imgs/theme/loading.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
        
        
    --}}






    <!-- Vendor JS-->
    <script src="{{ asset('Frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    {{-- <script src="{{ asset('Frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script> --}}
    <script src="{{ asset('Frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/slider-range.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('Frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('Frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('Frontend/assets/js/shop.js?v=5.3') }}"></script>
    <script src="{{ asset('Frontend/assets/js/script.js') }}"></script>

    <!---Sweetalert code -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

    <!--Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <!-- Add to cart Ajax Start -->
    <script>
        $(document).ready(function() {
            $('.productCart').submit(function(e) {
                e.preventDefault();


                $.ajax({
                    type: 'POST',
                    url: '{{ route('product.cart') }}',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Check if the response indicates success (you can define your own criteria)
                        if (response.success) {
                            // Close the modal
                            $('.custom-modal').click();
                            miniCart();

                            // Show a SweetAlert2 success toast
                            Swal.fire({
                                toast: 'true',
                                position: 'top-end',
                                icon: 'success',
                                title: 'Product added to cart successfully!',
                                showConfirmButton: false,
                                timer: 3000
                            });


                        } else {
                            // Handle other cases if needed
                        }

                        // Optionally, you can log the entire response to the console
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle any errors here
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>


    <!-- End Ajax -->

    <!--cart data fetch -->

    <script type="text/javascript">
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {
                    console.log(response)

                    $('span[id="cartSubTotal"]').text(response.cartTotal);
                    $('span[id="mcartSubTotal"]').text(response.cartTotal);
                    $('#cartQty').text(response.cartQty);
                    $('#mcartQty').text(response.cartQty)

                    var miniCart = ""

                    $.each(response.carts, function(key, value) {
                        miniCart += ` 
                        <li>
                <div class="shopping-cart-img">
                    <a href="shop-product-right.html"><img alt="Nest" src="/${value.options.image} " style="width:50px;height:50px;" /></a>
                </div>
                <div class="shopping-cart-title" style="margin: -73px 74px 14px; width" 146px;>
                    <h4><a href="shop-product-right.html"> ${value.name} </a></h4>
                    <h4><span>${value.qty} × </span>${value.price}</h4>
                </div>
                <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                    <a  type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)" ><i class="fi-rs-cross-small"></i></a>
                </div>
            </li> 
        </ul>
        
         `

         


                    })
                    $('#miniCart').html(miniCart);
                    $('#mminiCart').html(miniCart);

                }
            })
        }

        miniCart();
    </script>

    <!--End -->

    <!--Cart Remove -->
    <script>
        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product/remove/' + rowId,
                dataType: 'json',
                success: function(data) {

                    if (data.success) {

                        miniCart();

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'success',
                            title: 'Product has removed successfully!',
                            showConfirmButton: false,
                            timer: 3000
                        });

                    }
                }
            })
        }
    </script>

    <!--  End  -->


    <!-- Wishlist Add -->
    <script type="text/javascript">
        function addToWishList(product_id) {
            console.log(product_id)

            $.ajax({ // Use $.ajax instead of $ajax
                type: "POST",
                dataType: "JSON",
                url: "/add-to-wishlist/" + product_id, // Correct the URL 

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // Include the CSRF token
                },


                success: function(data) {

                    wishlist();

                    if (data.success) {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 3000
                        });

                        $('#wishListQty').text(data.count);

                    } else {

                        // Show a SweetAlert2 error toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'error', // Use 'error' for the icon name
                            title: data.error,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    }

                }
            });


        }
    </script>
    <!-- End -->







    <!--- get wishlist product -->
    <script type="text/javascript">
        function wishlist() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-wishlist-product/",
                success: function(response) {

                    $('#wishQty').text(response.wishQty);

                    var rows = ""

                    $.each(response.wishlist, function(key, value) {
                        rows += `

                        <tr class="pt-30">
                                    <td class="custome-checkbox pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                            id="exampleCheckbox1" value="" />
                                        <label class="form-check-label" for="exampleCheckbox1"></label>

                                        
                                        
                                    </td>
                                    <td class="image product-thumbnail pt-40"><img src="/${value.product.product_thambnail}"
                                            alt="#" /></td>
                                    <td class="product-des product-name">
                                        <h6><a class="product-name mb-10" href="shop-product-right.html">${value.product.product_name}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        
                                            ${value.product.discount_price == 'null' ? `<h4 class="text-brand">${value.product.selling_price}</h4>` : `${value.product.discount_price}`}
                                            
                                        
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <span class="stock-status in-stock mb-0">
                                            ${value.product.status == 1 ? `In Stock` : `Out of Stock`}
                                            
                                              
                                        </span>
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        <button class="btn btn-sm">Add to cart</button>
                                    </td>
                                    <td class="action text-center" data-title="Remove">
                                        <a href="#" class="text-body"   id="${value.id}" onclick="wishlistRemove(this.id)" ><i class="fi-rs-trash"></i></a>
                                    </td>
                                </tr>
                        
                        `
                    })

                    $('#wishlist').html(rows);


                }
            })
        }
        wishlist();
    </script>

    <!-- End -->

    <!-- remove product wishlist -->

    <script>
        function wishlistRemove(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/wishlist-remove/" + id,

                success: function(data) {
                    wishlist();

                    if (data.success) {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 3000
                        });



                    }
                }
            })
        }
    </script>

    <!-- End -->

    <!-- insert add compare -->
    <script>
        function addToCompare(product_id) {
            console.log(product_id);
            $.ajax({
                type: "POST",
                dataType: 'json',

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                url: "/add-to-compare/" + product_id,



                success: function(data) {

                    compare();

                    if (data.success) {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    } else {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'error',
                            title: data.error,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    }
                }
            })
        }
    </script>
    <!-- End -->

    <!-- get compare product -->
    <script type="text/javascript">
        function compare() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-compare-product/",
                success: function(response) {

                    $('#compareQty').text(response.compareQty);



                    var rows = ""
                    $.each(response.compare, function(key, value) {
                        rows += `
                                <tr class="pr_title">
                                    <td class="row_img"><img src="/${value.product.product_thambnail} " style="width:300px; height:300px;"  alt="compare-img" /></td>
                                    <td class="product_name">
                                        <h6><a href="shop-product-full.html" class="text-heading">${value.product.product_name} </a></h6>
                                    </td>
                                    <td class="product_price">
                      ${value.product.discount_price == null
                        ? `<h4 class="price text-brand">$${value.product.selling_price}</h4>`
                        :`<h4 class="price text-brand">$${value.product.discount_price}</h4>`
                        } 
                                    </td>

                                    <td class="row_text font-xs">
                                        <p class="font-sm text-muted"> ${value.product.short_descp}</p>
                                    </td>

                                    <td class="row_stock">
                                ${value.product.product_qty > 0 
                                ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                :`<span class="stock-status out-stock mb-0">Stock Out </span>`
                               } 
                              </td>

                              <td class="row_remove">
                    

                    <a type="submit" class="text-muted"  id="${value.id}" onclick="compareRemove(this.id)"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>

                </td>


                                   
                                </tr>
                               
                                
                               
                               
                                
             `
                    });
                    $('#compare').html(rows);
                }
            })
        }
        compare();
    </script>
    <!-- end -->

    <!-- Compare Remove -->

    <script>
        function compareRemove(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/compare-remove/" + id,
                success: function(data) {
                    compare();

                    if (data.success) {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    } else {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'error',
                            title: data.error,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    }



                }
            })
        }
    </script>


    <!--  // Start Load MY Cart // -->
    <script type="text/javascript">
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/get-cart-product',
                dataType: 'json',
                success: function(response) {
                    console.log(response)

                    var rows = ""
                    $.each(response.carts, function(key, value) {
                        rows += `<tr class="pt-30">
           <td class="custome-checkbox pl-30">
                
           </td>
           <td class="image product-thumbnail pt-40"><img src="/${value.options.image} " alt="#"></td>
           <td class="product-des product-name">
               <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">${value.name} </a></h6>
               
               
           </td>
           <td class="price" data-title="Price">
               <h4 class="text-body">$${value.price} </h4>
           </td>
             <td class="price" data-title="Price">
             ${value.options.color == null
               ? `<span>.... </span>`
               : `<h6 class="text-body">${value.options.color} </h6>`
             } 
           </td>
              <td class="price" data-title="Price">
             ${value.options.size == null
               ? `<span>.... </span>`
               : `<h6 class="text-body">${value.options.size} </h6>`
             } 
           </td>
           <td class="text-center detail-info" data-title="Stock">
               <div class="detail-extralink mr-15">
                   <div class="detail-qty border radius">
                       

                       <a type="submit" class="qty-down" id="${value.rowId}" onclick="cartDecrement(this.id)"><i class="fi-rs-angle-small-down"></i></a>
                      
     <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">
                       

                       <a  type="submit" class="qty-up" id="${value.rowId}" onclick="cartIncrement(this.id)"><i class="fi-rs-angle-small-up"></i></a>

                   </div>
               </div>
           </td>
           <td class="price" data-title="Price">
               <h4 class="text-brand">$${value.subtotal} </h4>
           </td>
           <td class="action text-center" data-title="Remove">
            
            <a type="submit" class="text-body"  id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fi-rs-trash"></i></a>
            </td>
       </tr>`
                    });
                    $('#cartPage').html(rows);
                }
            })
        }
        cart();
    </script>
    <!--  // End Load MY Cart // -->

    <!--Cart Remove -->

    <script>
        function cartRemove(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/cart-remove/" + id,
                success: function(data) {
                    couponCalculation();
                    cart();
                    miniCart();

                    // Start Message 

                    if (data.success) {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    } else {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'error',
                            title: data.error,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    }

                    // End Message  
                }
            })
        }
    </script>

    <!--End -->

    <!--Cart Decrement Start -->

    <script>
        function cartDecrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-decrement/" + rowId,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    cart();
                    miniCart();
                }
            });
        }
    </script>

    <!----End--->

    <!--Cart Increment Start -->
    <script>
        function cartIncrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-increment/" + rowId,
                dataType: 'json',
                success: function(data) {
                    couponCalculation();
                    cart();
                    miniCart();
                }
            });
        }
    </script>
    <!---End---->


    <!-- Start Coupon -->

    <script type="text/javascript">
        function applyCoupon() {
            var coupon_name = $('#coupon_name').val();
            $.ajax({
                type: "POST",
                dataType: 'json',

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                data: {
                    coupon_name: coupon_name
                },
                url: "/coupon-apply",
                success: function(data) {


                    couponCalculation();

                    if (data.validity == true) {
                        $('#couponField').hide();
                    }


                    if (data.success) {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    } else {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'error',
                            title: data.error,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    }


                }
            })
        }
    </script>

    <!--   End Apply Coupon  -->


    <!--  Start CouponCalculation Method  -->

    <script>
        function couponCalculation() {
            $.ajax({
                type: 'GET',
                url: "/coupon-calculation",
                dataType: 'json',
                success: function(data) {

                    //console.log('couponcalculation')

                    if (data.total) {

                        $('#couponCalField').html(

                            `

                        <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Subtotal</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$${data.total}</h4>
                    </td>
                </tr>
                 
                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Grand Total</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$${data.total}</h4>
                    </td>
                </tr>
                        
                        `


                        )

                    } else {
                        $('#couponCalField').html(
                            `<tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Subtotal</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$${data.subtotal}</h4>
                    </td>
                </tr>
                 
                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Coupon </h6>
                    </td>
                    <td class="cart_total_amount">
                        <h6 class="text-brand text-end">${data.coupon_name} <a type="submit" onclick="couponRemove()"><i class="fi-rs-trash"></i> </a> </h6>
                    </td>
                </tr>
                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Discount Amount  </h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$${data.discount_amount}</h4>
                    </td>
                </tr>
                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Grand Total </h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$${data.total_amount}</h4>
                    </td>
                </tr> `
                        )
                    }

                }
            })


        }

        couponCalculation();
    </script>

    <!-- Start CouponCalculation Method  -->

    <!--- Coupon Remove Start --->

    <script type="text/javascript">
        function couponRemove() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/coupon-remove",
                success: function(data) {
                    couponCalculation();
                    $('#couponField').show();


                    if (data.success) {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    } else {

                        // Show a SweetAlert2 success toast
                        Swal.fire({
                            toast: 'true',
                            position: 'top-end',
                            icon: 'error',
                            title: data.error,
                            showConfirmButton: false,
                            timer: 3000
                        });

                    }



                }
            })
        }
    </script>

    <!--- Coupon Remove End  --->













</body>

</html>
