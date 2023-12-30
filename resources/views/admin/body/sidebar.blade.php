<div class="sidebar-wrapper" data-simplebar="true" style="overflow-y: auto; overflow-x : hidden">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('AdminBackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="/admin/dashboard">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

      


        
        @if(Auth::user()->can('brand.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>

                <li> <a href="/all/brand"><i class="bx bx-right-arrow-alt"></i>All Brand</a>
                </li>
            

                <li> <a href="/add/brand"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                </li>


            </ul>
        </li>
        @endif

    

    
        @if(Auth::user()->can('cat.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
            
                <li> <a href="/all/category"><i class="bx bx-right-arrow-alt"></i>All Category</a>
                </li>
        

        
                <li> <a href="/add/category"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li>
            


            </ul>
        </li>
        @endif

        @if(Auth::user()->can('subcategory.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Sub Category</div>
            </a>
            <ul>
                <li> <a href="/all/sub-category"><i class="bx bx-right-arrow-alt"></i>All SubCategory</a>
                </li>
                <li> <a href="/add/sub-category"><i class="bx bx-right-arrow-alt"></i>Add SubCategory</a>
                </li> 


            </ul>
        </li>
        @endif 

        @if(Auth::user()->can('vendor.menu'))

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Vendor Manage</div>
            </a>
            <ul>
                <li> <a href="/active/vendor"><i class="bx bx-right-arrow-alt"></i>Active Vendor</a>
                </li>
                <li> <a href="/inactive/vendor"><i class="bx bx-right-arrow-alt"></i>Inactive Vendor</a>
                </li>
            </ul>
        </li>
        @endif 

        @if(Auth::user()->can('product.menu'))

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Product Manage</div>
            </a>
            <ul>
                <li> <a href="/all-product"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                </li>
                <li> <a href="/add-product"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>

            </ul>
        </li>  

        @endif


        @if(Auth::user()->can('slider.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Slider Manage</div>
            </a>
            <ul>
                <li> <a href="/all/slider"><i class="bx bx-right-arrow-alt"></i>All Slider</a>
                </li>
                <li> <a href="/add/slider"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                </li>

            </ul>
        </li>
        @endif

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Banner Manage</div>
            </a>
            <ul>
                <li> <a href="/all/banner"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
                </li>
                <li> <a href="/add/banner"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>

            </ul>
        </li> 


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Coupon Manage</div>
            </a>
            <ul>
                <li> <a href="/all/coupon"><i class="bx bx-right-arrow-alt"></i>All Coupon</a>
                </li>
                <li> <a href="/add/coupon"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Shipping Area</div>
            </a>
            <ul>
                <li> <a href="/all/division"><i class="bx bx-right-arrow-alt"></i>All Division</a>
                </li>
                <li> <a href="/all/district"><i class="bx bx-right-arrow-alt"></i>All District</a>
                </li>

                <li> <a href="/all/state"><i class="bx bx-right-arrow-alt"></i>All State</a>
                </li>

            </ul>
        </li>  

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Order Manage </div>
            </a>
            <ul>
                <li> <a href="/pending-order"><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
                </li>

                <li> <a href="/admin/confirmed/order"><i class="bx bx-right-arrow-alt"></i>Confirmed Order</a>
                </li>
                <li> <a href="/admin/processing/order"><i class="bx bx-right-arrow-alt"></i>Processing Order</a>
                </li>
                <li> <a href="/admin/delivered/order"><i class="bx bx-right-arrow-alt"></i>Delivered Order</a>
                </li>


            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Return Order </div>
            </a>
            <ul>
                <li> <a href="/return/request"><i class="bx bx-right-arrow-alt"></i>Return Request</a>
                </li>
                <li> <a href="/complete/return/request"><i class="bx bx-right-arrow-alt"></i>Complete Request</a>
                </li> 
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Reports Manage </div>
            </a>
            <ul>
                <li> <a href="/report/view"><i class="bx bx-right-arrow-alt"></i>Report View</a>
                </li>

                <li> <a href="/order/by/user"><i class="bx bx-right-arrow-alt"></i>Order By User</a>
                </li>
                
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">User Manage</div>
            </a>
            <ul>
                <li> <a href="/all/user"><i class="bx bx-right-arrow-alt"></i>All User</a>
                </li>

                    <li> <a href="/all/vendor"><i class="bx bx-right-arrow-alt"></i>All Vendor</a>
                </li>


            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Blog Manage</div>
            </a>
            <ul>
                <li> <a href="/admin/blog/category"><i class="bx bx-right-arrow-alt"></i>All Blog Categroy</a>
                </li>

                    <li> <a href="/admin/blog/post"><i class="bx bx-right-arrow-alt"></i>All Blog Post</a>
                </li>


            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Review Manage</div>
            </a>
            <ul>
                <li> <a href="{{ route('pending.review') }}"><i class="bx bx-right-arrow-alt"></i>Pending Review</a>
                </li>
    
                    

                <li> <a href="{{ route('publish.review') }}"><i class="bx bx-right-arrow-alt"></i>Publish Review</a>
                </li>
    
    
            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Setting Manage</div>
            </a>
            <ul>
                <li> <a href="/site/setting"><i class="bx bx-right-arrow-alt"></i>Site Setting</a>
                </li>

                <li> <a href="/seo/setting"><i class="bx bx-right-arrow-alt"></i>Seo Setting</a>
    
    
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Stock Manage</div>
            </a>
            <ul>
                <li> <a href="/product/stock"><i class="bx bx-right-arrow-alt"></i>Product Stock</a>
                </li>

                <li> <a href="/seo/setting"><i class="bx bx-right-arrow-alt"></i>Seo Setting</a>
    
    
            </ul>
        </li> 

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Roles & Permission</div>
            </a>
            <ul>
                <li> <a href="/all/permission"><i class="bx bx-right-arrow-alt"></i>All Permission</a>
                </li>

                <li> <a href="/add/permission"><i class="bx bx-right-arrow-alt"></i>Add Permission</a>

                <li> <a href="/all/roles"><i class="bx bx-right-arrow-alt"></i>All Roles</a>

                <li> <a href="/add/roles"><i class="bx bx-right-arrow-alt"></i>Add Roles</a>
                
                <li> <a href="/all/roles/permission"><i class="bx bx-right-arrow-alt"></i>All Roles & Permission</a></li>

                <li> <a href="/add/roles/permission"><i class="bx bx-right-arrow-alt"></i>Roles in Permission</a></li>

                
                    
            </ul>
        </li>  


        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-line-chart"></i>
                </div>
                <div class="menu-title">Admin Manage </div>
            </a>
            <ul>
                <li> <a href="{{ route('all.admin') }}"><i class="bx bx-right-arrow-alt"></i>All Admin</a>
                </li>
                <li> <a href="/add/admin"><i class="bx bx-right-arrow-alt"></i>Add Admin</a>
                </li>


            </ul>
        </li>




        




        


       
        
    </ul>
    <!--end navigation-->
</div>
