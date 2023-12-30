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
                            {{--<div class="col-md-3">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                                href="#dashboard" role="tab" aria-controls="dashboard"
                                                aria-selected="false"><i
                                                    class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders"
                                                role="tab" aria-controls="orders" aria-selected="false"><i
                                                    class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab"
                                                href="#track-orders" role="tab" aria-controls="track-orders"
                                                aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track
                                                Your Order</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address"
                                                role="tab" aria-controls="address" aria-selected="true"><i
                                                    class="fi-rs-marker mr-10"></i>My Address</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab"
                                                href="#account-detail" role="tab" aria-controls="account-detail"
                                                aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="view-detail-tab" data-bs-toggle="tab"
                                                href="#view-detail" role="tab" aria-controls="view-detail"
                                                aria-selected="true"><i class="fi-rs-user mr-10"></i>View details</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab"
                                                href="#password-setting" role="tab" aria-controls="password-setting"
                                                aria-selected="true"><i class="fi-rs-user mr-10"></i>Password Settings</a>
                                        </li>

                                        

                                        <li class="nav-item">
                                            <a class="nav-link" href="/user/logout"><i
                                                    class="fi-rs-sign-out mr-10"></i>Logout</a>

                                        </li>
                                    </ul>
                                </div>
                            </div> --}} 
                            @include('frontend.userdashboard.sidebar')
                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content pl-50">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                        aria-labelledby="dashboard-tab">
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
                                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Your Orders</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Sl</th>
                                                                <th>Date</th>
                                                                <th>Totaly</th>
                                                                <th>Payment</th>
                                                                <th>Invoice</th>
                                                                <th>Status</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $key => $order)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td> {{ $order->order_date }}</td>
                                                                    <td> ${{ $order->amount }}</td>
                                                                    <td> {{ $order->payment_method }}</td>
                                                                    <td> {{ $order->invoice_no }}</td>
                                                                    <td>
                                                                        @if ($order->status == 'pending')
                                                                            <span
                                                                                class="badge rounded-pill bg-warning">Pending</span>
                                                                        @elseif($order->status == 'confirm')
                                                                            <span
                                                                                class="badge rounded-pill bg-info">Confirm</span>
                                                                        @elseif($order->status == 'processing')
                                                                            <span
                                                                                class="badge rounded-pill bg-danger">Processing</span>
                                                                        @elseif($order->status == 'deliverd')
                                                                            <span
                                                                                class="badge rounded-pill bg-success">Deliverd</span>
                                                                        @endif


                                                                    </td>


                                                                    <td><a href="/order/view/details/{{$order->id}}" class="btn-sm btn-success"><i
                                                                                class="fa fa-eye"></i> View</a>
                                                                        <a href="#" class="btn-sm btn-danger"><i
                                                                                class="fa fa-download"></i> Invoice</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="track-orders" role="tabpanel"
                                        aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">Orders tracking</h3>
                                            </div>
                                            <div class="card-body contact-from-area">
                                                <p>To track your order please enter your OrderID in the box below and press
                                                    "Track" button. This was given to you on your receipt and in the
                                                    confirmation email you should have received.</p>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <form class="contact-form-style mt-30 mb-50" action="#"
                                                            method="post">
                                                            <div class="input-style mb-20">
                                                                <label>Order ID</label>
                                                                <input name="order-id"
                                                                    placeholder="Found in your order confirmation email"
                                                                    type="text" />
                                                            </div>
                                                            <div class="input-style mb-20">
                                                                <label>Billing email</label>
                                                                <input name="billing-email"
                                                                    placeholder="Email you used during checkout"
                                                                    type="email" />
                                                            </div>
                                                            <button class="submit submit-auto-width"
                                                                type="submit">Track</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="address" role="tabpanel"
                                        aria-labelledby="address-tab">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card mb-3 mb-lg-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">Billing Address</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>
                                                            3522 Interstate<br />
                                                            75 Business Spur,<br />
                                                            Sault Ste. <br />Marie, MI 49783
                                                        </address>
                                                        <p>New York</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Shipping Address</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>
                                                            4299 Express Lane<br />
                                                            Sarasota, <br />FL 34249 USA <br />Phone: 1.941.227.4444
                                                        </address>
                                                        <p>Sarasota</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                        aria-labelledby="account-detail-tab">
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

                                    <div class="tab-pane fade" id="view-detail" role="tabpanel"
                                        aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>View Details</h5>
                                            </div>
                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table class="table table-bordered table-hover table-striped">
                                                            <thead>
                                                                <th>Data</th>
                                                                <th>User</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Hello</td>
                                                                    <td>Laptop</td>
                                                                </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <div class="col-md-6"></div>

                                                </div>

                                                
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="password-setting" role="tabpanel"
                                        aria-labelledby="password-setting-tab">
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



{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
