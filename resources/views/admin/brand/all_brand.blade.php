@extends('admin.admin_dashboard')

@section('admin')


<!--start page wrapper -->
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Brand</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Brand</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="/add/brand"  class="btn btn-primary">Add Brand</a>
               
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Brand Data</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach($all_brand as $count=> $item)
                        <tr>
                            <td>{{ $count + 1 }}</td>
                            <td>{{ $item->brand_name }}</td>
                            <td>
                                <img src="{{ asset($item->brand_image) }}" style="width: 70px; height: 70px; border-radius:10px; border : 1px solid gainsboro" />
                            </td>
                            <td>
                                @if(Auth::user()->can('brand.edit'))
                                <a href="/edit/brand/{{ $item->id }}" class="btn btn-info">Edit</a>
                                @else
                                <a href="#" class="btn btn-info">Edit</a>
                                @endif 

                                @if(Auth::user()->can('brand.delete'))
                                <a href="/delete/brand/{{ $item->id }}" id="delete" class="btn btn-danger" style="margin-left: 10px">Delete</a>
                                @else 
                                <a href="#" id="delete" class="btn btn-danger" style="margin-left: 10px">Delete</a>
                                @endif 


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                   
                </table>
            </div>
        </div>
    </div>
    
</div>
<!--end page wrapper -->


@endsection