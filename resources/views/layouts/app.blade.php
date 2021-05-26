<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.inc.partials._client_head')

<body>
    <!-- Wrapper -->
    <div id="wrapper">
        
        <!-- Header Container / Start -->
        @include('layouts.inc.partials._client_header')
        <div class="clearfix"></div>
        <!-- Header Container / End -->

        <!-- Dashboard -->
        <div id="dashboard">
            <!-- Responsive Navigation Trigger -->
            <a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>

            @include('layouts.inc.partials._client_side_bar')

            <div class="dashboard-content">
                @yield('content')                
                @include('layouts.inc.partials._client_footer')  
            </div>
        </div>
        
    </div>

    @include('layouts.inc.partials._client_script')    
</body>
</html>
