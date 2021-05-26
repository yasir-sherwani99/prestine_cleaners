@extends('layouts.master')

@section('content')

	<!-- Start Main Content Area -->
    <section class="error-section text-center">
        <div class="container">
           <div class="row"> 
                <div class="col-lg-12"> 
                    <h1>404 Error</h1>
                    <h3>Page Not Found</h3>
                    <p class="return">It looks like you’re try to access a page that either has been deleted or never existed.</p>
                    <a class="qout-btn green-btn" href="{{ url('/') }}"><i class="fa fa-arrow-circle-left"></i> Go back HOME Page</a>
                </div>
            </div> 
        </div>
    </section>
    <!-- End Main Content Area -->

@endsection