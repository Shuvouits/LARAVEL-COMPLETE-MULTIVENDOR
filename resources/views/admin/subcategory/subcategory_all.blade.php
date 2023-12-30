@extends('admin.admin_dashboard')

@section('admin')


<!--start page wrapper -->
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">SubCategory</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Subcategory</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="/add/sub-category"  class="btn btn-primary">Add SubCategory</a>
               
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All SubCategory Data</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>SubCategory Name</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach($all_subcategory as $count=> $item)
                        <tr>
                            <td>{{ $count + 1 }}</td>
                            <td> {{ $item['category']['category_name'] }}</td>
                            <td>{{ $item->subcategory_name }}</td>
                           
                            <td>
                                <a href="/edit/sub-category/{{ $item->id }}" class="btn btn-info">Edit</a>
                                <a href="/delete/sub-category/{{ $item->id }}" id="delete" class="btn btn-danger" style="margin-left: 10px">Delete</a>
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