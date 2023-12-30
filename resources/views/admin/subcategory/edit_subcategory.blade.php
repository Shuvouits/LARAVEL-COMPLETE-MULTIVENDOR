{{-- @extends('admin.admin_dashboard')
@section('admin')
<form method="post" action="/data">
    @csrf  

    <input type="text" name="data" placeholder="data"  />
    <input type="submit" value="submit" />

</form>
@endSection --}}

@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">SubCategory</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit SubCategory</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="/all/brand"  class="btn btn-primary">All SubCategory</a>
                  
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                   
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" method="post" action="/update/sub-category">

                                    @csrf

                                   
                                    <input type="hidden" name="id" value="{{ $subcategory_data->id }}">

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Category Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="category_id" class="form-select mb-3"
                                                aria-label="Default select example">
                                                <option selected="">Open this select menu</option>

                                                @foreach ($category_data as $item)
                                                    <option value="{{ $item->id }}" {{ $item->id == $subcategory_data->category_id ? 'selected' : '' }}>{{ $item->category_name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
		                           

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">SubCategory Name </h6>
                                        </div>
                                        <div class=" form-group col-sm-9 text-secondary">
                                            <input type="text" name="subcategory_name" class="form-control" value="{{ $subcategory_data->subcategory_name }}" />
                                        </div>
                                        
                                    </div>


                                  

                                  


                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Update SubCategory" />
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


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                category_name: {
                    required : true,
                }, 

               
            },
            messages :{
                category_name: {
                    required : 'Please Enter Category Name',
                },

               
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

  
@endsection
