@extends('vendor.vendor_dashboard')
@section('vendor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Product</h5>
                <hr />

                <form id="myForm" method="post" action="/vendor/update/product">
                    @csrf

                    <input type="hidden" name="id" value="{{ $products->id }}">

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">


                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Name</label>
                                        <input type="text" name="product_name" class="form-control"
                                            id="inputProductTitle" value="{{ $products->product_name }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Tags</label>
                                        <input type="text" name="product_tags" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $products->product_tags }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Size</label>
                                        <input type="text" name="product_size" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $products->product_size }} ">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Color</label>
                                        <input type="text" name="product_color" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $products->product_color }}">
                                    </div>



                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea name="short_descp"   style="height: 600px;" class="form-control" id="inputProductDescription" rows="3">
                                              {{ $products->short_descp }}
				                       </textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>
                                        <textarea id="mytextarea" name="long_descp" style="height: 600px;">
				                           {!! $products->long_descp !!}
                                        </textarea>
                                    </div>






                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">

                                        <div class="form-group col-md-6">
                                            <label for="inputPrice" class="form-label">Product Price</label>
                                            <input type="text" name="selling_price" class="form-control" id="inputPrice"
                                                value="{{ $products->selling_price }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Discount Price </label>
                                            <input type="text" name="discount_price" class="form-control"
                                                id="inputCompareatprice" value="{{ $products->discount_price }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" name="product_code" class="form-control"
                                                id="inputCostPerPrice" value="{{ $products->product_code }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                            <input type="text" name="product_qty" class="form-control"
                                                id="inputStarPoints" value="{{ $products->product_qty }}">
                                        </div>


                                        <div class="form-group col-12">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select name="brand_id" class="form-select" id="inputProductType">
                                                <option></option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        {{ $brand->id == $products->brand_id ? 'selected' : '' }}>
                                                        {{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputVendor" class="form-label">Product Category</label>
                                            <select name="category_id" class="form-select" id="inputVendor">
                                                <option></option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ $cat->id == $products->category_id ? 'selected' : '' }}>
                                                        {{ $cat->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputCollection" class="form-label">Product SubCategory</label>
                                            <select name="subcategory_id" class="form-select" id="inputCollection">
                                                <option></option>
                                                @foreach ($subcategory as $subcat)
                                                    <option value="{{ $subcat->id }}"
                                                        {{ $subcat->id == $products->subcategory_id ? 'selected' : '' }}>
                                                        {{ $subcat->subcategory_name }}
                                                @endforeach

                                            </select>
                                        </div>


                                       


                                        <div class="col-12">

                                            <div class="row g-3">

                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="hot_deals" type="checkbox"
                                                            value="1" id="flexCheckDefault"
                                                            {{ $products->hot_deals == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault"> Hot
                                                            Deals</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="featured" type="checkbox"
                                                            value="1" id="flexCheckDefault"
                                                            {{ $products->featured == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault">Featured</label>
                                                    </div>
                                                </div>




                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_offer"
                                                            type="checkbox" value="1" id="flexCheckDefault"
                                                            {{ $products->special_offer == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Offer</label>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_deals"
                                                            type="checkbox" value="1" id="flexCheckDefault"
                                                            {{ $products->special_deals == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Deals</label>
                                                    </div>
                                                </div>



                                            </div> <!-- // end row  -->

                                        </div>

                                        <hr>


                                        <div class="col-12">
                                            <div class="d-grid">
                                                <input type="submit" class="btn btn-primary px-4"
                                                    value="Save Changes" />

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div>
            </div>

            </form>

        </div>

        <!---image Thumbnail --->
        <div class="card">
            <div class="card-header">
                <h3 class="title">Update Main Image Thumbnail</h3>

            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="/vendor/update/product/thumbnail">
                    @csrf
                    <input type="hidden" name="id" value="{{ $products->id }}" />
                    <input type="hidden" name="old_img" value="{{ $products->product_thambnail }}" />
                    <div class="mb-3">

                        <input class="form-control" type="file" name="product_thambnail" id="formFile" required>
                        <img id="mainImage" src="{{ asset($products->product_thambnail) }}"
                            style=" margin-top : 10px; width: 150px; height : 150px; border-radius : 10px; border : 1px solid gainsboro" />
                    </div>
                    <input type="submit" class="btn btn-primary" value="Update Thumbnail" />

                </form>


            </div>
        </div>

        <!----multiple image ---->
        <div class="page-content">
            <h6 class="mb-0 text-uppercase">Update Multi Image </h6>
            <hr>
            <div class="card">
                <div class="card-body">
                    <table class="table mb-0 table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#Sl</th>
                                <th scope="col">Image</th>
                                <th scope="col">Change Image </th>
                                <th scope="col">Delete </th>
                            </tr>
                        </thead>
                        <tbody>

                            <form method="post" action="/vendor/update/product/multiimage" enctype="multipart/form-data">
                                @csrf

                                @foreach ($multiImgs as $key => $img)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>

                                            <img id="showImage{{ $img->id }}" src="{{ asset($img->photo_name) }}" style="width:70; height: 70px; border : 1px solid gainsboro; border-radius : 5px">
                                        </td>



                                        <td> <input type="file" class="form-group"
                                                name="multi_img[{{ $img->id }}]" id="image{{ $img->id }}">
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-primary px-4" value="Update Image " />
                                            <a href="/vendor/product/multiimg/delete/{{ $img->id }}" class="btn btn-danger"
                                                id="delete"> Delete </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    short_descp: {
                        required: true,
                    },
                    product_thambnail: {
                        required: true,
                    },
                    multi_img: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    product_code: {
                        required: true,
                    },
                    product_qty: {
                        required: true,
                    },
                    brand_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    subcategory_id: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Please Enter Product Name',
                    },
                    short_descp: {
                        required: 'Please Enter Short Description',
                    },
                    product_thambnail: {
                        required: 'Please Select Product Thambnail Image',
                    },
                    multi_img: {
                        required: 'Please Select Product Multi Image',
                    },
                    selling_price: {
                        required: 'Please Enter Selling Price',
                    },
                    product_code: {
                        required: 'Please Enter Product Code',
                    },
                    product_qty: {
                        required: 'Please Enter Product Quantity',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>


<script>
    $(document).ready(function() {
        $('#formFile').change(function(e) {

            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0'])
            $('#mainImage').css("display", "block");
            $('#mainImage').css("border-radius", "10px");
        })
    })
</script>

    @foreach ($multiImgs as $key => $img)
        <script>
            $(document).ready(function() {
                $('#image{{ $img->id }}').change(function(e) {

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#showImage{{ $img->id }}').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0'])
                    $('#showImage{{ $img->id }}').css("display", "block");
                    $('#showImage{{ $img->id }}').css("border-radius", "10px");
                })
            })
        </script>
    @endforeach





  


<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subcategory_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script> 

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                product_name: {
                    required: true,
                },
                short_descp: {
                    required: true,
                },
                product_thambnail: {
                    required: true,
                },
                multi_img: {
                    required: true,
                },
                selling_price: {
                    required: true,
                },
                product_code: {
                    required: true,
                },
                product_qty: {
                    required: true,
                },
                brand_id: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                subcategory_id: {
                    required: true,
                }
            },
            messages: {
                product_name: {
                    required: 'Please Enter Product Name',
                },
                short_descp: {
                    required: 'Please Enter Short Description',
                },
                product_thambnail: {
                    required: 'Please Select Product Thambnail Image',
                },
                multi_img: {
                    required: 'Please Select Product Multi Image',
                },
                selling_price: {
                    required: 'Please Enter Selling Price',
                },
                product_code: {
                    required: 'Please Enter Product Code',
                },
                product_qty: {
                    required: 'Please Enter Product Quantity',
                },
               
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>


@endsection
