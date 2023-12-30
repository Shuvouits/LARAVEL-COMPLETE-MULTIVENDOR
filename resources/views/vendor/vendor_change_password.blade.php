@extends('vendor.vendor_dashboard')
@section('vendor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vendor Change Password</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                            href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
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
                                <form method="post"  action="/vendor/update/password">
                                    @csrf

                                    @if(session('success'))
                                    <div class="alert alert-success" role="alert">
                                        
                                        <strong>{{session('success')}}</strong>
                                    </div>


                                    @elseif(session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        <strong>{{session('error')}}</strong>
                                    </div>
                                    @endif

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Old Password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="password" name="old_password" class="form-control" placeholder="Old Password" />
                                            @error('old_password')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        </div>
                                        
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">New Password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="password" class="form-control" name="new_password" placeholder="New Password" />
                                            @error('new_password')
                                            <p class="text-danger">{{$message}}</p>
                                            @enderror
                                           
                                        </div>
                                       
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Confirm New Password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm New Password" />
                                        </div>
                                    </div>

                                    

                                    

                                    
                                  


                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Update Password" />
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

    

<script>
    // Wait for the document to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Find the alert element
        var alertElement = document.querySelector('.alert');

        // If the alert element is found, add a timeout to close it after 5 seconds
        if (alertElement) {
            setTimeout(function() {
                alertElement.style.opacity = '0'; // Fade out the alert
                setTimeout(function() {
                    alertElement.style.display = 'none'; // Hide the alert
                }, 1000); // Wait for the fade out animation to complete (adjust as needed)
            }, 5000); // 5000 milliseconds = 5 seconds
        }
    });
</script>

@endsection
