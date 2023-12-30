<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('AdminBackend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Vendor</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="/vendor/dashboard">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if(Auth::user()->status=='active')

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Product Manage</div>
            </a>
            <ul>
                <li> <a href="/vendor/all-product"><i class="bx bx-right-arrow-alt"></i>All Product</a>
                </li>
                <li> <a href="/vendor/add-product"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>

            </ul>
        </li>  

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">All Order </div>
            </a>
            <ul>
                <li> <a href="/vendor-order"><i class="bx bx-right-arrow-alt"></i>Vendor Order</a>
                </li>

                <li> <a href="/vendor/return/order"><i class="bx bx-right-arrow-alt"></i>Return Order</a>
                </li>

                <li> <a href="/vendor/complete/return/order"><i class="bx bx-right-arrow-alt"></i>Complete Return Order</a>
                </li>


            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title"> Review Manage </div>
            </a>
            <ul>
                <li> <a href="{{ route('vendor.all.review') }}"><i class="bx bx-right-arrow-alt"></i>All Review</a>
                </li>



            </ul>
        </li>

        
         

        @endif 

        
       
    
    </ul>
    <!--end navigation-->
</div>