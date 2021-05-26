@extends('layouts.app')

@section('content')

<!-- Titlebar -->
<div id="titlebar">
	<div class="row">
		<div class="col-md-12">
			<h2>My Profile</h2>
			<!-- Breadcrumbs -->
			<nav id="breadcrumbs">
				<ul>
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ route('home') }}">Dashboard</a></li>
					<li>My Profile</li>
				</ul>
			</nav>
		</div>
	</div>
</div>

@if (count($errors) > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="notification error closeable margin-bottom-30">
                <b>Alert!</b>
				@foreach ($errors->all() as $error)
                	<p>{{ $error }}</p>
                @endforeach
				<a class="close" href="#"></a>
            </div>
        </div>
    </div>
@endif

<div class="row">

	<!-- Profile -->
	<div class="col-lg-12 col-md-12">
		<div class="dashboard-list-box margin-top-0">
			<h4 class="gray">Profile Details</h4>
			<div class="dashboard-list-box-static">
				
				<!-- Details -->
				<form method="post" action="{{ route('profile.store') }}">
					@csrf
					<div class="my-profile">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<label>Your Name</label>
								<input value="{{ $customer->name }}" name="customer_name" type="text" required>
							</div>
							<div class="col-md-6 col-lg-6">
								<label>Phone</label>
								<input value="{{ $customer->phone }}" name="customer_phone" type="text" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<label>Address</label>
								<input value="{{ $customer->address }}" name="customer_address" type="text" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<label>Postal Code / Zip</label>
								<input value="{{ $customer->post_code }}" name="customer_post_code" type="text" required>
							</div>
							<div class="col-md-6 col-lg-6">
								<label>City</label>
								<input value="{{ $customer->city }}" name="customer_city" type="text" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12 text-center">
								<button type="submit" class="button margin-top-15">Save Changes</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection