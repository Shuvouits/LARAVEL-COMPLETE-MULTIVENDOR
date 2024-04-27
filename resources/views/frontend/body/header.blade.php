<!--Ajax search purpose -->

<style>
    #searchProducts {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;
    }
</style>

<script>
    function search_result_show() {
        $("#searchProducts").slideDown();
    }

    function search_result_hide() {
        $("#searchProducts").slideUp();
    }
</script>

<!-- End --->

@php
    $setting = App\Models\SiteSetting::find(1);
@endphp

<!-- Header  -->
<header class="header-area header-style-1 header-height-2">
    <div class="mobile-promotion">
        <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
    </div>
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>

                            <li><a href="page-account.html">My Cart</a></li>
                            <li><a href="shop-wishlist.html">Checkout</a></li>
                            <li><a href="shop-order.html">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>100% Secure delivery without contacting the courier</li>
                                <li>Supper Value Deals - Save more with coupons</li>
                                <li>Trendy 25silver jewelry, save up 35% off today</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>

                            <li>
                                <a class="language-dropdown-active" href="#">English <i
                                        class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    <li>
                                        <a href="#"><img
                                                src="{{ asset('Frontend/assets/imgs/theme/flag-fr.png') }}"
                                                alt="" />Français</a>
                                    </li>
                                    <li>
                                        <a href="#"><img
                                                src="{{ asset('Frontend/assets/imgs/theme/flag-dt.png') }}"
                                                alt="" />Deutsch</a>
                                    </li>
                                    <li>
                                        <a href="#"><img
                                                src="{{ asset('Frontend/assets/imgs/theme/flag-ru.png') }}"
                                                alt="" />Pусский</a>
                                    </li>
                                </ul>
                            </li>

                            <li>Need help? Call Us: <strong class="text-brand"> + 8801751720590</strong></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">

                    <a href="/"><img src="{{ asset($setting->logo) }}" alt="logo" /></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">

                        @php
                            $all_category = App\Models\Category::all();
                        @endphp

                        <form action="/product/search" method="post">
                            {{ @csrf_field() }}
                            <select class="select-active">

                                <option selected disabled value="">All Categories</option>


                                @foreach ($all_category as $data)
                                <option>
                                    <a href="/product/category/{{$data->id}}/{{$data->category_slug}}">{{$data->category_name}}</a>
                                </option>
                            @endforeach
                            



                            </select>

                            <input onfocus="search_result_show()" onblur="search_result_hide()" name="search"
                                id="search" placeholder="Search for items..." />
                            <div id="searchProducts"></div>
                        </form>
                    </div>



                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="search-location">
                                <form action="#">
                                    <select class="select-active">
                                        <option>Your Location</option>
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>Arizona</option>
                                        <option>Delaware</option>
                                        <option>Florida</option>
                                        <option>Georgia</option>
                                        <option>Hawaii</option>
                                        <option>Indiana</option>
                                        <option>Maryland</option>
                                        <option>Nevada</option>
                                        <option>New Jersey</option>
                                        <option>New Mexico</option>
                                        <option>New York</option>
                                    </select>
                                </form>
                            </div>


                            <div class="header-action-icon-2">
                                <a href="/compare">
                                    <img class="svgInject" alt="Nest"
                                        src="{{ asset('Frontend/assets/imgs/theme/icons/compare.png') }}" />

                                    @if (Auth::user())
                                        <span class="pro-count blue" id="compareQty"></span>
                                    @else
                                        <span class="pro-count blue">0</span>
                                    @endif

                                </a>
                                <a href="/compare"><span class="lable">Compare</span></a>
                            </div>



                            <div class="header-action-icon-2">
                                <a href="/product/wishlist/view">
                                    <img class="svgInject" alt="Nest"
                                        src="{{ asset('Frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />

                                    @if (Auth::user())
                                        <span class="pro-count blue" id="wishQty"></span>
                                    @else
                                        <span class="pro-count blue">0</span>
                                    @endif



                                </a>
                                <a href="/product/wishlist/view"><span class="lable">Wishlist</span></a>
                            </div>




                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="/mycart">
                                    <img alt="Nest"
                                        src="{{ asset('Frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span class="pro-count blue " id="cartQty"></span>
                                </a>
                                <a href="/mycart"><span class="lable">Cart</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <div id="miniCart"></div>

                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span id="cartSubTotal"></span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="/mycart" class="outline">View cart</a>
                                            <a href="/mycart">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @auth
                                <div class="header-action-icon-2">
                                    <a href="page-account.html">
                                        <img class="svgInject" alt="Nest"
                                            src="{{ asset('Frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
                                    <a href="page-account.html"><span class="lable ml-0">Account</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="/dashboard"><i class="fi fi-rs-user mr-10"></i>My
                                                    Account</a>
                                            </li>
                                            <li>
                                                <a href="page-account.html"><i
                                                        class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fi fi-rs-label mr-10"></i>My
                                                    Voucher</a>
                                            </li>
                                            <li>
                                                <a href="/product/wishlist/view"><i class="fi fi-rs-heart mr-10"></i>My
                                                    Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="page-account.html"><i
                                                        class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                            </li>
                                            <li>
                                                <a href="/user/logout"><i class="fi fi-rs-sign-out mr-10"></i>Sign
                                                    out</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="header-action-icon-2">
                                    <a href="/login"><span class="lable ml-0">Login</span></a>
                                    <span class="lable ml-2"> | </span>
                                    <a href="/register"><span class="lable ml-2">Register</span></a>

                                </div>

                            @endauth

                            <div class="header-action-icon-2">
                                <a href="/admin/login" target="_blank"><span class="lable ml-0">Admin Login</span></a>
                                <span class="lable ml-2"> | </span>
                                <a href="/vendor/login" target="_blank"><span class="lable ml-2">Vendor Login</span></a>

                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="/"><img src="{{ asset($setting->logo) }}"
                        alt="logo" style="margin-left : -80px" /></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span> All Categories
                            <i class="fi-rs-angle-down"></i>
                        </a>

                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                            <div class="d-flex categori-dropdown-inner">
                                @php
                                    $total_category = App\Models\Category::count();
                                    $all_category = App\Models\Category::orderBy('category_name', 'ASC')
                                        ->limit($total_category / 2)
                                        ->get();
                                    $left_all_category = App\Models\Category::orderBy('category_name', 'ASC')
                                        ->offset($total_category / 2)
                                        ->take($total_category / 2)
                                        ->get();
                                @endphp
                                <ul>

                                    @foreach ($all_category as $item)
                                        <li>
                                            <a
                                                href="/product/category/{{ $item->id }}/{{ $item->category_name }}">
                                                <img src="{{ asset($item->category_image) }}"
                                                    alt="" />{{ $item->category_name }}</a>
                                        </li>
                                    @endforeach

                                </ul>

                                <ul class="end">

                                    @foreach ($left_all_category as $item)
                                        <li>
                                            <a
                                                href="/product/category/{{ $item->id }}/{{ $item->category_name }}">
                                                <img src="{{ asset($item->category_image) }}"
                                                    alt="" />{{ $item->category_name }}</a>
                                        </li>
                                    @endforeach

                                </ul>








                            </div>






                        </div>
                    </div>


                    @php

                        $category_without_sub = App\Models\Category::where('sub_category', null)->limit(4)->get();

                        $category_with_sub = App\Models\Category::where('sub_category', 'yes')->limit(5)->get();
                        $all_subcategory = App\Models\SubCategory::all();

                    @endphp







                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>

                            <ul>

                                @foreach ($category_without_sub as $item)
                                    <li><a href="/product/category/{{ $item->id }}/{{ $item->category_slug }}">{{ $item->category_name }}
                                        </a></li>
                                @endforeach


                                @foreach ($category_with_sub as $data)
                                    <li>
                                        <a
                                            href="/product/category/{{ $data->id }}/{{ $data->category_slug }}">{{ $data->category_name }}</a>
                                        <i class="fi-rs-angle-down"></i>
                                        <ul class="sub-menu">
                                            @foreach ($all_subcategory as $value)
                                                @if ($data->id == $value->category_id)
                                                    <li>
                                                        <a
                                                            href="/product/sub-category/{{ $value->id }}/{{ $value->subcategory_slug }}">{{ $value->subcategory_name }}</a>

                                                    </li>
                                                @endif
                                            @endforeach

                                        </ul>
                                    </li>
                                @endforeach




                                <li>
                                    <a href="/blog">Blog</a>
                                </li>
                            </ul>
                        </nav>
                    </div>



                </div>


                <div class="hotline d-none d-lg-flex">
                    <img src="{{ asset('Frontend/assets/imgs/theme/icons/icon-headphone.svg') }}" alt="hotline" />

                    <p>{{ $setting->support_phone }}<span>24/7 Support Center</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">

                    <div class="header-action-2">

                        <div class="header-action-icon-2">
                            <a href="/product/wishlist/view">
                                <img class="svgInject" alt="Nest"
                                    src="{{ asset('Frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />

                                @if (Auth::user())
                                    <span class="pro-count blue" id="wishQty"></span>
                                @else
                                    <span class="pro-count blue">0</span>
                                @endif



                            </a>
                            <a href="/product/wishlist/view"><span class="lable">Wishlist</span></a>
                        </div>




                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="/mycart">
                                <img alt="Nest"
                                    src="{{ asset('Frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                <span class="pro-count blue " id="mcartQty"></span>
                            </a>
                            <a href="/mycart"><span class="lable">Cart</span></a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul>
                                    <div id="mminiCart"></div>

                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span id="cartSubTotal"></span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="/mycart" class="outline">View cart</a>
                                        <a href="/mycart">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @auth
                            <div class="header-action-icon-2">
                                <a href="page-account.html">
                                    <img class="svgInject" alt="Nest"
                                        src="{{ asset('Frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                </a>
                                <a href="page-account.html"><span class="lable ml-0">Account</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                    <ul>
                                        <li>
                                            <a href="/dashboard"><i class="fi fi-rs-user mr-10"></i>My
                                                Account</a>
                                        </li>
                                        <li>
                                            <a href="page-account.html"><i
                                                    class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fi fi-rs-label mr-10"></i>My
                                                Voucher</a>
                                        </li>
                                        <li>
                                            <a href="/product/wishlist/view"><i class="fi fi-rs-heart mr-10"></i>My
                                                Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="page-account.html"><i
                                                    class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                        </li>
                                        <li>
                                            <a href="/user/logout"><i class="fi fi-rs-sign-out mr-10"></i>Sign
                                                out</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="header-action-icon-2">
                                <a href="/login"><span class="lable ml-0">Login</span></a>
                                <span class="lable ml-2"> | </span>
                                <a href="/register"><span class="lable ml-2">Register</span></a>

                            </div>

                        @endauth


                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- End Header  -->
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="/"><img src="{{ asset($setting->logo) }}"
                    alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="/product/search" method="post" >
                    {{ @csrf_field() }}
                    <input onfocus="search_result_show()" onblur="search_result_hide()" name="search"
                                id="mobilesearch" placeholder="Search for items..." />

                                <div id="mobilesearchProducts"></div>
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">

                        <li>
                            <a href="/">Home</a>
                        </li>

                        @foreach ($category_with_sub as $data)
                        <li>
                            <a
                                href="/product/category/{{ $data->id }}/{{ $data->category_slug }}">{{ $data->category_name }}</a>
                            <i class="fi-rs-angle-down"></i>
                            <ul class="sub-menu">
                                @foreach ($all_subcategory as $value)
                                    @if ($data->id == $value->category_id)
                                        <li>
                                            <a
                                                href="/product/sub-category/{{ $value->id }}/{{ $value->subcategory_slug }}">{{ $value->subcategory_name }}</a>

                                        </li>
                                    @endif
                                @endforeach

                            </ul>
                        </li>
                    @endforeach

                       

                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img src="{{ asset('Frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('Frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('Frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('Frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}"
                        alt="" /></a>
                <a href="#"><img src="{{ asset('Frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                        alt="" /></a>
            </div>
            <div class="site-copyright">Copyright 2024 © Stack Developer All Rights Reserved.</div>
        </div>
    </div>
</div>
<!--End header-->
