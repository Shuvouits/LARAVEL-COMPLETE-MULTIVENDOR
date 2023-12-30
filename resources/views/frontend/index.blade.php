
@extends('frontend.master')
@section('main')


@section('title')
    Home Easy Multi Vendor Shop 
@endsection

@include('frontend.home.home_slider')

@include('frontend.home.category_slider')

@include('frontend.home.banner') 

@include('frontend.home.new_product')
@include('frontend.home.feature_product')

@include('frontend.home.tv_category')

<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>

                @php 
                $hot_deals = \App\Models\Product::where('hot_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();
                @endphp

                <div class="product-list-small animated animated">

                    @foreach($hot_deals as $product)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{asset($product->product_thambnail)}}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">{{$product->product_name}}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    
                                    @php
                                    $reviewcount = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->latest()
                                        ->get();
                                    $avarage = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->avg('rating');
                                @endphp


                                @if ($avarage == 0)
                                @elseif($avarage == 1 || $avarage < 2)
                                    <div class="product-rating" style="width: 20%"></div>
                                @elseif($avarage == 2 || $avarage < 3)
                                    <div class="product-rating" style="width: 40%"></div>
                                @elseif($avarage == 3 || $avarage < 4)
                                    <div class="product-rating" style="width: 60%"></div>
                                @elseif($avarage == 4 || $avarage < 5)
                                    <div class="product-rating" style="width: 80%"></div>
                                @elseif($avarage == 5 || $avarage < 5)
                                    <div class="product-rating" style="width: 100%"></div>
                                @endif


                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>

                            @php
                            $amount = $product->selling_price - $product->discount_price;
                            $discount = ($amount/$product->selling_price) * 100;
                            @endphp
                        
                            

                            @if($product->discount_price == NULL)
                            <div class="product-price mt-10">
                               <span>Tk.{{ $product->selling_price }} </span>
           
                           </div>
                           @else
                              <div class="product-price mt-10">
                               <span>Tk.{{ $product->discount_price }} </span>
                               <span class="old-price">Tk.{{ $product->selling_price }}</span>
                           </div>
                           @endif


                        </div>
                    </article>
                    @endforeach
                    
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Offer </h4>

                @php 
                $special_offer = \App\Models\Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(3)->get();
                @endphp

                <div class="product-list-small animated animated">

                    @foreach($special_offer as $product)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{asset($product->product_thambnail)}}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">{{$product->product_name}}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    
                                    @php
                                    $reviewcount = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->latest()
                                        ->get();
                                    $avarage = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->avg('rating');
                                @endphp


                                @if ($avarage == 0)
                                @elseif($avarage == 1 || $avarage < 2)
                                    <div class="product-rating" style="width: 20%"></div>
                                @elseif($avarage == 2 || $avarage < 3)
                                    <div class="product-rating" style="width: 40%"></div>
                                @elseif($avarage == 3 || $avarage < 4)
                                    <div class="product-rating" style="width: 60%"></div>
                                @elseif($avarage == 4 || $avarage < 5)
                                    <div class="product-rating" style="width: 80%"></div>
                                @elseif($avarage == 5 || $avarage < 5)
                                    <div class="product-rating" style="width: 100%"></div>
                                @endif


                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>

                            @php
                            $amount = $product->selling_price - $product->discount_price;
                            $discount = ($amount/$product->selling_price) * 100;
                            @endphp
                        
                            

                            @if($product->discount_price == NULL)
                            <div class="product-price mt-10">
                               <span>Tk.{{ $product->selling_price }} </span>
           
                           </div>
                           @else
                              <div class="product-price mt-10">
                               <span>Tk.{{ $product->discount_price }} </span>
                               <span class="old-price">Tk.{{ $product->selling_price }}</span>
                           </div>
                           @endif


                        </div>
                    </article>
                    @endforeach
                    
                </div>


               
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>

                @php 
                $recent_add = \App\Models\Product::orderBy('id', 'DESC')->limit(3)->get();
                @endphp

                <div class="product-list-small animated animated">

                    @foreach($recent_add as $product)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{asset($product->product_thambnail)}}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">{{$product->product_name}}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    
                                    @php
                                    $reviewcount = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->latest()
                                        ->get();
                                    $avarage = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->avg('rating');
                                @endphp


                                @if ($avarage == 0)
                                @elseif($avarage == 1 || $avarage < 2)
                                    <div class="product-rating" style="width: 20%"></div>
                                @elseif($avarage == 2 || $avarage < 3)
                                    <div class="product-rating" style="width: 40%"></div>
                                @elseif($avarage == 3 || $avarage < 4)
                                    <div class="product-rating" style="width: 60%"></div>
                                @elseif($avarage == 4 || $avarage < 5)
                                    <div class="product-rating" style="width: 80%"></div>
                                @elseif($avarage == 5 || $avarage < 5)
                                    <div class="product-rating" style="width: 100%"></div>
                                @endif


                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>

                            @php
                            $amount = $product->selling_price - $product->discount_price;
                            $discount = ($amount/$product->selling_price) * 100;
                            @endphp
                        
                            

                            @if($product->discount_price == NULL)
                            <div class="product-price mt-10">
                               <span>Tk.{{ $product->selling_price }} </span>
           
                           </div>
                           @else
                              <div class="product-price mt-10">
                               <span>Tk.{{ $product->discount_price }} </span>
                               <span class="old-price">Tk.{{ $product->selling_price }}</span>
                           </div>
                           @endif


                        </div>
                    </article>
                    @endforeach
                    
                </div>


                
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>

                @php 
                $special_deals = \App\Models\Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();
                @endphp

                <div class="product-list-small animated animated">

                    @foreach($special_deals as $product)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="shop-product-right.html"><img src="{{asset($product->product_thambnail)}}"
                                    alt="" /></a>
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="shop-product-right.html">{{$product->product_name}}</a>
                            </h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    
                                    @php
                                    $reviewcount = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->latest()
                                        ->get();
                                    $avarage = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->avg('rating');
                                @endphp


                                @if ($avarage == 0)
                                @elseif($avarage == 1 || $avarage < 2)
                                    <div class="product-rating" style="width: 20%"></div>
                                @elseif($avarage == 2 || $avarage < 3)
                                    <div class="product-rating" style="width: 40%"></div>
                                @elseif($avarage == 3 || $avarage < 4)
                                    <div class="product-rating" style="width: 60%"></div>
                                @elseif($avarage == 4 || $avarage < 5)
                                    <div class="product-rating" style="width: 80%"></div>
                                @elseif($avarage == 5 || $avarage < 5)
                                    <div class="product-rating" style="width: 100%"></div>
                                @endif

                                
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>

                            @php
                            $amount = $product->selling_price - $product->discount_price;
                            $discount = ($amount/$product->selling_price) * 100;
                            @endphp
                        
                            

                            @if($product->discount_price == NULL)
                            <div class="product-price mt-10">
                               <span>Tk.{{ $product->selling_price }} </span>
           
                           </div>
                           @else
                              <div class="product-price mt-10">
                               <span>Tk.{{ $product->discount_price }} </span>
                               <span class="old-price">Tk.{{ $product->selling_price }}</span>
                           </div>
                           @endif


                        </div>
                    </article>
                    @endforeach
                    
                </div>


                
            </div>
        </div>
    </div>
</section>




<!--Vendor List -->

@php 
$all_vendor = \App\Models\User::where('role', 'vendor')->where('status', 'active')->orderBy('id','DESC')->limit(4)->get();
@endphp

<div class="container">

    <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
        <h3 class="">All Our Vendor List </h3>
        <a class="show-all" href="/vendor/all">
            All Vendors
            <i class="fi-rs-angle-right"></i>
        </a>
    </div>


    <div class="row vendor-grid">

        @foreach($all_vendor as $data)
        <div class="col-lg-3 col-md-6 col-12 col-sm-6 justify-content-center">
            <div class="vendor-wrap mb-40">
                <div class="vendor-img-action-wrap">
                    <div class="vendor-img">
                        @if($data->photo == null)
                        <a href="vendor-details-1.html">
                            <img class="default-img" style="border-radius: 50px; width : 100px; height : 100px; border : 3px solid gainsboro"  src="{{asset('AdminBackend/no_image.jpg')}}"
                                alt="" />
                        </a>
                        @endif 

                        @if($data->photo == !null)

                        <a href="vendor-details-1.html">
                            <img class="default-img" style="border-radius: 10px; width : 100px; height : 100px; "  src="{{asset('AdminBackend/upload/vendor_image/'.$data->photo)}}"
                                alt="" />
                        </a>
                        @endif 


                    </div>
                    <div class="product-badges product-badges-position product-badges-mrg">
                        <span class="hot">Mall</span>
                    </div>
                </div>
                <div class="vendor-content-wrap">
                    <div class="d-flex justify-content-between align-items-end mb-30">
                        <div>
                            <div class="product-category">
                                <span class="text-muted">Since 2012</span>
                            </div>
                            <h4 class="mb-5"><a href="vendor-details-1.html">{{$data->name}}</a></h4>
                            <div class="product-rate-cover">

                                @php 
                                $total_product = \App\Models\Product::where('vendor_id', $data->id)->count();
                                @endphp

                                <span class="font-small total-product">{{$total_product}} products</span>
                            </div>
                        </div>

                    </div>
                    <div class="vendor-info mb-30">
                        <ul class="contact-infor text-muted">

                            <li><img src="{{asset('Frontend/assets/imgs/theme/icons/icon-contact.svg')}}"
                                    alt="" /><strong>Call Us:</strong><span>(+88) -
                                    {{$data->phone}}</span></li>
                        </ul>
                    </div>
                    <a href="/vendor/details/{{$data->id}}" class="btn btn-xs">Visit Store <i
                            class="fi-rs-arrow-small-right"></i></a>
                </div>
            </div>
        </div>
        <!--end vendor card-->
        @endforeach
        

    </div>
</div>
<!--End Vendor List -->

@endsection