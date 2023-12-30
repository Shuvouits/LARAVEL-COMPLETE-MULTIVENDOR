@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Brand</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="/all/brand"  class="btn btn-primary">All Brand</a>
                  
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
                                <form method="post" id="myForm"   action="/brand/store" enctype="multipart/form-data">
                                    @csrf

                                   

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Brand Name</h6>
                                        </div>
                                        <div class=" form-group col-sm-9 text-secondary">
                                            <input type="text" name="brand_name" class="form-control" placeholder="Type Brand Name" />
                                        </div>
                                        
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Photo</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="file" class="form-control" name="brand_image" id="image"/>
                                        </div>
                                       
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">

                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img style="display: none" id="showImage"
                                                src="{{ !empty($admin_data->photo) ? url('AdminBackend/upload/admin_image/'.$admin_data->photo) : url('AdminBackend/no_image.jpg') }}"
                                                alt="Admin" width="110" style="border-radius: 10px">


                                        </div>
                                    </div>

                                   

                                    

                                    

                                    
                                  


                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            @if(Auth::user()->can('brand.add'))
                                            <input type="submit" class="btn btn-primary px-4" value="Add Brand" />
                                            @else 
                                            <input type="" class="btn btn-primary px-4" value="Add Brand" />

                                            @endif
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

    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
              
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
                $('#showImage').css("display", "block");
                $('#showImage').css("border-radius", "10px");
            })
        })
    </script>  

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                brand_name: {
                    required : true,
                }, 

                brand_image: {
                    required : true,
                }, 
            },
            messages :{
                brand_name: {
                    required : 'Please Enter Brand Name',
                },

                brand_image: {
                    required : 'Please Select Brand Image',
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
