<!-- Modal -->

@php
    $all_products = App\Models\Product::all();
    
@endphp

@foreach ($all_products as $product)
    <!-- Quick view -->
    <div class="modal fade custom-modal" id="quickViewModal{{ $product->id }}" tabindex="-1"
        aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="{{ asset($product->product_thambnail) }}" alt="product image" />
                                    </figure>

                                    @php
                                        
                                        $multi_img = App\Models\MultiImg::where('product_id', $product->id)->get();
                                        
                                    @endphp


                                    @foreach ($multi_img as $data)
                                        <figure class="border-radius-10">
                                            <img src="{{ asset($data->photo_name) }}" alt="product image" />
                                        </figure>
                                    @endforeach



                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    <div>
                                        <img src="{{ asset($product->product_thambnail) }}">
                                    </div>

                                    @foreach ($multi_img as $data)
                                        <div>
                                            <img src="{{ asset($data->photo_name) }}" alt="product image" />
                                        </div>
                                    @endforeach


                                </div>

                                <br>


                                <div class="font-xs">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="mr-50 float-start">
                                                <li class="mb-5">Brand: <span
                                                        class="text-brand">{{ $product['brand']['brand_name'] }}</span>
                                                </li>
                                                <li class="mb-5">Category:<span class="text-brand">
                                                        {{ $product['category']['category_name'] }}</span></li>
                                                <li>SubCategory: <span
                                                        class="text-brand">{{ $product['subcategory']['subcategory_name'] }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="float-start">
                                                <li class="mb-5">Product Code: <a
                                                        href="#">{{ $product->product_code }}</a></li>

                                                <li class="mb-5">Tags: <a href="#" rel="tag">
                                                        {{ $product->product_tags }}</a></li>

                                                <li>Stock:<span
                                                        class="in-stock text-brand ml-5">({{ $product->product_qty }})
                                                        Items In Stock</span></li>
                                            </ul>
                                        </div>

                                    </div>


                                </div>



                            </div>
                            <!-- End Gallery -->
                        </div>

                        @php
                            $amount = $product->selling_price - $product->discount_price;
                            $discount = ($amount / $product->selling_price) * 100;
                            
                        @endphp

                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <span class="stock-status out-stock">

                                    @if ($product->discount_price == null)
                                        <span class="new">New</span>
                                    @else
                                        <span class="hot">{{ round($discount) }}%</span>
                                    @endif


                                </span>
                                <h4 class="title-detail"><a href="shop-product-right.html"
                                        class="text-heading">{{ $product->product_name }}</a></h4>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div>



                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">

                                        @if ($product->discount_price == null)
                                            <span>${{ $product->selling_price }}</span>
                                        @else
                                            <div class="product-price">
                                                <span>${{ $product->discount_price }}</span>
                                                <span class="old-price">${{ $product->selling_price }}</span>
                                            </div>
                                        @endif

                                    </div>
                                </div>






                                @php
                                    
                                    $size = $product->product_size;
                                    $product_size = explode(',', $size);
                                    
                                    $color = $product->product_color;
                                    $product_color = explode(',', $color);
                                    
                                @endphp

                                <form class="productCart">
                                    {{@csrf_field()}}

                                    <input type="hidden" name="product_id" value="{{$product->id}}" />

                                    <input type="hidden" name="vendor_id" value="{{$product->vendor_id}}" />

                                    @if ($product->product_size == null)
                                    @else
                                        <div class="attr-detail attr-size mb-30">
                                            <strong class="mr-10" style="width:50px;">Size : </strong>
                                            <select class="form-control unicase-form-control" name="product_size"  id="size">
                                                <option selected="" disabled="">--Choose Size--</option>
                                                @foreach ($product_size as $size)
                                                    <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
    
    
                                    @if ($product->product_color == null)
                                    @else
                                        <div class="attr-detail attr-size mb-30">
                                            <strong class="mr-10" style="width:50px;">Color:</strong>
                                            <select class="form-control unicase-form-control"  name="product_color" id="color" >
                                                <option selected="" disabled="">--Choose Color--</option>
                                                @foreach ($product_color as $color)
                                                    <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

    
    
                                    <div class="detail-extralink mb-30">
                                        <div class="detail-qty border radius">
                                            <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>

                                            <input type="text" name="quantity" class="qty-val" value="1"
                                                min="1" required>
                                            <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                        </div>
                                        <div class="product-extra-link2">
                                            <button type="submit"  class="button button-add-to-cart" id="myButton">
                                                <i class="fi-rs-shopping-cart"></i>Add to cart
                                            </button>
    
                                        </div>
                                    </div>

                                </form>

                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal -->
@endforeach


 
