@extends('layouts.master')

@section('content')

	@include('layouts.inc.partials._banner2')

	@include('front.about.inc.working-info')

	<div class="home-separator"></div>

	<!-- About Us Area Start  -->
	@include('front.about.inc.about_us')
	<!-- About Us Area End -->

	<!-- Why Choose Us Area Start -->
	@include('front.about.inc.why_choose_us')
	<!-- Why Choose Us Area End -->

@endsection