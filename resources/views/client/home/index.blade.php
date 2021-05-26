@extends('layouts.app')

@section('content')

<!-- Titlebar -->
<div id="titlebar">
	<div class="row">
		<div class="col-md-12">
			<h2>Howdy, {{ Auth::user()->name }}!</h2>
			<!-- Breadcrumbs -->
			<nav id="breadcrumbs">
				<ul>
					<li><a href="{{ url('/') }}">Home</a></li>
					<li>Dashboard</li>
				</ul>
			</nav>
		</div>
	</div>
</div>

<!-- Notice -->
@if(session()->has('success-new'))
<div class="row">
	<div class="col-md-12">
		<div class="notification success closeable margin-bottom-30">
			<p>{!! session()->get('success-new') !!}</p>
			<a class="close" href="#"></a>
		</div>
	</div>
</div>
@endif

@if(session()->has('success'))
<div class="row">
	<div class="col-md-12">
		<div class="notification success closeable margin-bottom-30">
			<p>{{ session()->get('success') }}</p>
			<a class="close" href="#"></a>
		</div>
	</div>
</div>
@endif

@include('client.home.inc.stats')

<div class="row">
	<!-- Bookings -->
	<div class="col-lg-6 col-md-12">
		@include('client.home.inc.recent_bookings')
	</div>
	
	<!-- Invoices -->
	<div class="col-lg-6 col-md-12">
		@include('client.home.inc.recent_invoices')
	</div>
</div>
@endsection


