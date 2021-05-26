@extends('layouts.master')

@section('content')

	<!--  Slider Start -->
	@include('front.home.inc.slider_2')
	<!--  Slider End -->

	<!--  Icon-Boxes Section Start -->
	@include('front.home.inc.icon-boxes')
	<!--  Icon-Boxes Section End -->

	<!--  About Section Start -->
	@include('front.home.inc.about')
	<!--  About Section End -->

	<!--  Work Section Start -->
	@include('front.home.inc.work')
	<!--  Work Section End -->

	<!--  Services Sections Start -->
	@include('front.home.inc.services_3')
	<!--  Services Sections End -->

	<!-- Counter Sections Start -->
	@include('front.home.inc.counter')
	<!-- Counter Sections End -->

	<!-- Features Sections Start -->
	@include('front.home.inc.features')
	<!-- Features Sections End -->

	<!--  Subscribe Section Start -->
	@include('front.home.inc.subscribe')
	<!--  Subscribe Section End -->

    <!-- Testimonial Sections Start -->
	@include('front.home.inc.testimonial_2')
	<!-- Testimonial Sections End -->

	<!-- Our Clients Area Start -->
    @include('front.home.inc.clients')
    <!-- Our Clients Area End -->

@endsection

