<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ request()->path() == 'admin_panel/dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="la la-home"></i><span class="menu-title">Dashboard</span>
                </a>
            </li>
            @php
                $bookings = \App\Booking::where('is_booked', 0)->count(); 
            @endphp
            <li class="navigation-header">
                <span>General</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Bookings"></i>
            </li>
            <li class="nav-item {{ request()->path() == 'admin_panel/bookings' || request()->routeIs('admin.bookings.details') || request()->path() == 'admin_panel/bookings/calendar' || request()->routeIs('admin.bookings.create') || request()->path() == 'admin_panel/bookings/log' ? 'active' : '' }}">
                <a href="#">
                    <i class="la la-calendar-check-o"></i><span class="menu-title">Bookings</span>@if($bookings != 0)<span class="badge badge badge-pill badge-danger float-right mr-2">{{ $bookings }}</span>@endif
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->path() == 'admin_panel/bookings' || request()->routeIs('admin.bookings.details') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.bookings.index') }}">New Bookings
                            @if($bookings != 0)<span class="badge badge badge-pill badge-danger float-right mr-2">{{ $bookings }}</span>@endif
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('admin.bookings.create') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.bookings.create') }}">Add New Booking</a>
                    </li>
                    <li class="{{ request()->path() == 'admin_panel/bookings/calendar' ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.bookings.calendar') }}">Booking Calendar</a>
                    </li>
                    <li class="{{ request()->path() == 'admin_panel/bookings/log' ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.bookings.log') }}">Bookings Log</a>
                    </li>
                </ul>
            </li>

<!--             <li class="navigation-header">
                <span>Invoices</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Invoices"></i>
            </li> -->
            <li class="nav-item {{ request()->path() == 'admin_panel/invoices' || request()->routeIs('admin.invoices.show') || request()->routeIs('admin.invoices.create') ||  request()->routeIs('admin.invoices.edit') || request()->routeIs('admin.invoices.customers') ? 'active' : '' }}">
                <a href="#">
                    <i class="la la-file-text"></i><span class="menu-title">Invoices</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->path() == 'admin_panel/invoices' || request()->routeIs('admin.invoices.show') || request()->routeIs('admin.invoices.edit') || request()->routeIs('admin.invoices.customers') || request()->routeIs('admin.invoices.create') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.invoices.index') }}">Invoices List</a>
                    </li>
                </ul>
            </li>
        
<!--             <li class="navigation-header">
                <span>Customers</span>
                <i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Customers"></i>
            </li> -->
            <li class="nav-item {{ request()->path() == 'admin_panel/customers' || request()->routeIs('admin.customers.edit') ? 'active' : '' }}"><a href="#"><i class="la la-users"></i><span class="menu-title">Customers</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->path() == 'admin_panel/customers' || request()->routeIs('admin.customers.edit') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.customers.index') }}">Customers List</a>
                    </li>
                    <li class="{{ request()->path() == 'admin_panel/customer/create' ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.customers.create') }}">Add New Customer</a>
                    </li>
                </ul>
            </li>
        
 <!--            <li class="navigation-header">
                <span>Messages</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Messages"></i>
            </li> -->
            <li class="nav-item {{ request()->path() == 'admin_panel/messages' || request()->routeIs('admin.messages.details') ? 'active' : '' }}"><a href="#"><i class="la la-envelope"></i><span class="menu-title">Messages</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->path() == 'admin_panel/messages' || request()->routeIs('admin.messages.details') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.messages.index') }}">View Messages</a>
                    </li>
                </ul>
            </li>

            <li class=" navigation-header">
                <span>Settings</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Settings"></i>
            </li>
            <li class="nav-item {{ request()->path() == 'admin_panel/services' || request()->path() == 'admin_panel/admins' || request()->path() == 'admin_panel/admin/create' || request()->path() == 'admin_panel/password' || request()->routeIs('admin.admins.edit') || request()->path() == 'admin_panel/social' || request()->path() == 'admin_panel/items_prices' || request()->path() == 'admin_panel/meta_tags' || request()->routeIs('admin.meta_tags.edit') || request()->path() == 'admin_panel/snippets' || request()->path() == 'admin_panel/snippet/create' || request()->routeIs('admin.snippet.edit') ? 'active' : '' }}"><a href="#"><i class="la la-cogs"></i><span class="menu-title">Settings</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->path() == 'admin_panel/services' ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.services.index') }}">Services</a>
                    </li>
                    <li class="{{ request()->path() == 'admin_panel/meta_tags' || request()->routeIs('admin.meta_tags.edit') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.meta_tags.index') }}">Meta Tags</a>
                    </li>
                    <li class="{{ request()->path() == 'admin_panel/snippets' || request()->path() == 'admin_panel/snippet/create' || request()->routeIs('admin.snippet.edit') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.snippet.index') }}">Snippets</a>
                    </li>
                    <li class="{{ request()->path() == 'admin_panel/items_prices' ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.items_prices.index') }}">Cleaning Prices</a>
                    </li>
                    <li class="{{ request()->path() == 'admin_panel/admins' || request()->path() == 'admin_panel/admin/create' || request()->routeIs('admin.admins.edit') ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.admins.index') }}">Admins</a>
                    </li>
                    <li class="{{ request()->path() == 'admin_panel/social' ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.social.index') }}">Social Media</a>
                    </li>
                    <li class="{{ request()->path() == 'admin_panel/password' ? 'active' : '' }}">
                        <a class="menu-item" href="{{ route('admin.password.index') }}">Password</a>
                    </li>
                </ul>
            </li>
                
            <li class=" nav-item">
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();"><i class="la la-sign-out"></i><span class="menu-title">Sign Out</span></a>
                <form id="logout-form-admin" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>