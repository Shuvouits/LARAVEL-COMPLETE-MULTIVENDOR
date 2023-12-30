@php
    $route = Route::current()->getName();
@endphp


<div class="col-md-3">
    <div class="dashboard-menu">
        <ul class="nav flex-column" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ $route == 'dashboard' ? 'active' : '' }} " href="/user/dashboard"><i
                        class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'order' ? 'active' : '' }} " href="/user/order"><i
                        class="fi-rs-shopping-bag mr-10"></i>Orders</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $route == 'return.order.page' ? 'active' : '' }}"
                    href="{{ route('return.order.page') }}"><i class="fi-rs-shopping-bag mr-10"></i>Return Orders</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.track.order' ? 'active' : '' }}"
                    href="{{ route('user.track.order') }}"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your
                    Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab"
                    aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link {{ $route == 'accountDetails' ? 'active' : '' }}" href="/user/account/details"><i
                        class="fi-rs-user mr-10"></i>Account details</a>
            </li>



            <li class="nav-item">
                <a class="nav-link {{ $route == 'passwordSettings' ? 'active' : '' }} "
                    href="/user/password/settings"><i class="fi-rs-user mr-10"></i>Password Settings</a>
            </li>



            <li class="nav-item">
                <a class="nav-link {{ $route == 'orderViewDetail' ? 'active' : '' }} " href="/user/logout"><i
                        class="fi-rs-sign-out mr-10"></i>Logout</a>

            </li>
        </ul>
    </div>
</div>
