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

                                        <h3 class="mb-0">Hello {{ $user_data->name }}</h3>
                                        <br>
                                        <img src=" {{ !empty($user_data->photo) ? url('AdminBackend/upload/user_image/' . $user_data->photo) : url('AdminBackend/no_image.jpg') }}"
                                            alt="Admin" class="rounded-circle p-1 bg-primary" width="110"
                                            height="110">
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            From your account dashboard. you can easily check &amp; view your <a
                                                href="#">recent orders</a>,<br />
                                            manage your <a href="#">shipping and billing addresses</a> and <a
                                                href="#">edit your password and account details.</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    
@endsection




