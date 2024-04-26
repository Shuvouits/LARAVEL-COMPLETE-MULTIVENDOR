
@extends('vendor.vendor_dashboard')
@section('vendor')
<div class="page-content">

    @if(Auth::user()->status === 'active')
	<h4>Vendor Account is <span class="text-success">Active</span> </h4>
	@else
	<h4>Vendor Account is <span class="text-danger">InActive</span> </h4>
	<p class="text-danger"><b> Plz wait admin will check and approve your account</b></p>
	@endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 bg-gradient-deepblue">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">${{$total_price}}</h5>
                        <div class="ms-auto">
                            <i class='bx bx-cart fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Orders</p>
                        <p class="mb-0 ms-auto">+4.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-orange">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">$8323</h5>
                        <div class="ms-auto">
                            <i class='bx bx-dollar fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Total Revenue</p>
                        <p class="mb-0 ms-auto">+1.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">{{$number_of_user}}</h5>
                        <div class="ms-auto">
                            <i class='bx bx-group fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Visitors</p>
                        <p class="mb-0 ms-auto">+5.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 text-white">5630</h5>
                        <div class="ms-auto">
                            <i class='bx bx-envelope fs-3 text-white'></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 55%"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center text-white">
                        <p class="mb-0">Messages</p>
                        <p class="mb-0 ms-auto">+2.2%<span><i class='bx bx-up-arrow-alt'></i></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

   


   


  



    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Orders Summary</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Order id</th>
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($all_order as $item)

                        <tr>
                            <td>#{{$item->order_id}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="recent-product-img">
                                        
                                        <img src="{{asset($item->product->product_thambnail)}}" alt="">
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-1 font-14">{{$item->product->product_name}}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{$item->order->user->name}}</td>
                            <td>{{$item->created_at->format('d M Y')}}
                            </td>
                            <td>${{$item->price}}</td>
                            <td>
                                <div class="badge rounded-pill bg-light-info text-info w-100">{{$item->order->status}}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex order-actions"> <a href="javascript:;"
                                        class=""><i class="bx bx-cog"></i></a>
                                    <a href="javascript:;" class="ms-4"><i
                                            class="bx bx-down-arrow-alt"></i></a>
                                </div>
                            </td>
                        </tr>

                        @endforeach


                       
                       
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection