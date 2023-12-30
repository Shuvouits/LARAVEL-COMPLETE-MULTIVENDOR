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
                                        <h5>Password Settings</h5>
                                    </div>
                                    <div class="card-body">

                                        <form method="post" action="/user/update/password">
                                            @csrf
                                            <div class="row">

                                                @if (session('success'))
                                                    <div class="alert alert-success" role="alert">

                                                        <strong>{{ session('success') }}</strong>
                                                    </div>
                                                @elseif(session('error'))
                                                    <div class="alert alert-danger" role="alert">

                                                        <strong>{{ session('error') }}</strong>
                                                    </div>
                                                @endif


                                                <div class="form-group col-md-12">
                                                    <label>Old Password <span class="required">*</span></label>
                                                    <input type="password" name="old_password"
                                                        class="form-control" placeholder="Old Password"
                                                        required />
                                                    @error('old_password')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>


                                                <div class="form-group col-md-12">
                                                    <label>New Password <span class="required">*</span></label>
                                                    <input type="password" class="form-control"
                                                        name="new_password" placeholder="New Password" required />
                                                    @error('new_password')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="c-password">Confirm New Password <span
                                                            class="required">*</span></label>
                                                    <input type="password" id="c-password"
                                                        name="new_password_confirmation" class="form-control"
                                                        placeholder="Confirm New Password" required />
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

   
@endsection




