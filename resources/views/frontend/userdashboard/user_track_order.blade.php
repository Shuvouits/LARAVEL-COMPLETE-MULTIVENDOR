@extends('frontend.master')

@section('main')
    @section('title')
     User Order Track
    @endsection
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
                                        <h5>Track Your Order</h5>
                                    </div>

                                    <div class="card-body">
                                    
                                        <form method="post" action="{{ route('order.tracking') }}" > 
                                            @csrf 
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Invoice Code <span class="required">*</span></label>
                                                    <input  class="form-control" name="code" type="text" placeholder="Your Order Invoice Number" required="" /> 
                                            
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-fill-out submit font-weight-bold" name="submit" value="Submit">Track Order</button>
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
