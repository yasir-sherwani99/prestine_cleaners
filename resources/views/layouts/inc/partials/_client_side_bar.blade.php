<div class="dashboard-nav">
    <div class="dashboard-nav-inner">
        <ul data-submenu-title="Main">
            <li class="{{ $pagePath == 'dashboard' ? 'active' : '' }}"><a href="{{ route('home') }}"><i class="sl sl-icon-home"></i> Dashboard</a></li>
            <li class="{{ $pagePath == 'bookings' ? 'active' : '' }}"><a href="{{ route('bookings.index') }}"><i class="fa fa-calendar-check-o"></i> Bookings</a></li>
            <li class="{{ $pagePath == 'invoices' ? 'active' : '' }}"><a href="{{ route('invoices.index') }}"><i class="sl sl-icon-doc"></i> Invoices</a></li>
        </ul>   
        <ul data-submenu-title="Account">
            <li class="{{ $pagePath == 'profile' ? 'active' : '' }}"><a href="{{ route('profile.index') }}"><i class="sl sl-icon-user"></i> My Profile</a></li>
            <li>
                <a href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                     document.getElementById('logout-form2').submit();">
                     <i class="sl sl-icon-power"></i> Logout
                </a>
            </li>
            <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </div>
</div>