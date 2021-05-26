<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.inc.partials._head')

<body data-spy="scroll" data-offset="70">
    <!-- Preloader start -->
    <div class="preloader-wrap">
        <div class="d-table">
            <div class="d-tablecell">
                <img src="{{ asset('assets/img/loader.gif') }}" />
                <p>Loading...</p>
            </div>
        </div>
    </div>
    <!-- Preloader end --> 

    <!-- Header Section -->
	@include('layouts.inc.partials._header')

	<!-- Main Menu -->
	@include('layouts.inc.partials._menu')

	@yield('content')

    <!--  Modals -->
    @include('layouts.inc.modals.login')
    @include('layouts.inc.modals.subscriber_success')

    <!-- Estimate Section Start -->
    @include('layouts.inc.partials._estimate')   
    <!-- End Estimate Section -->

	<!--  Footer Section -->
	@include('layouts.inc.partials._footer')

    <!-- Start scroll to top feature -->
    <a href="#" id="back-to-top" title="Back to Top">
        <i class="fa fa-long-arrow-up"></i>
    </a>
    <!-- End scroll to top feature -->

    @include('layouts.inc.partials._script')

</body>
</html>
