@extends('frontend.master')

@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            
                            @include('frontend.userdashboard.sidebar')
                            <div class="col-md-9">

                                <div class="card">
                                    <div class="card-header">
                                        <h5>Account Details</h5>
                                    </div>
                                    <div class="card-body">

                                        <form method="post" action="/user/profile/store"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>First Name <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="name"
                                                        value="{{ $user_data->name }}" type="text" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Last Name <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="username"
                                                        value="{{ $user_data->username }}" />
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Email Address <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="email"
                                                        type="email" value="{{ $user_data->email }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Phone <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="phone"
                                                        type="text" value="{{ $user_data->phone }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Address <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="address"
                                                        type="text" value="{{ $user_data->address }}" />
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Photo <span class="required">*</span></label>
                                                    <input class="form-control" name="photo" id="image"
                                                        type="file" />
                                                </div>





                                                <div class="form-group col-md-12">

                                                    <img id="showImage"
                                                        src="{{ !empty($user_data->photo) ? url('AdminBackend/upload/user_image/' . $user_data->photo) : url('AdminBackend/no_image.jpg') }}"
                                                        alt="Admin" width="110"
                                                        style="border-radius: 10px">
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit"
                                                        class="btn btn-fill-out submit font-weight-bold"
                                                        name="submit" value="Submit">Save Change</button>
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
    </main>

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
@endsection




