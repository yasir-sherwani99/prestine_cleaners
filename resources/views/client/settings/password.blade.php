@extends('layouts.app')

@section('content')

<!-- Titlebar -->
<div id="titlebar">
	<div class="row">
		<div class="col-md-12">
			<h2>Password</h2>
			<!-- Breadcrumbs -->
			<nav id="breadcrumbs">
				<ul>
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ route('home') }}">Dashboard</a></li>
					<li>Password</li>
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

@if(session()->has('danger'))
	<div class="row">
		<div class="col-md-12">
			<div class="notification error closeable margin-bottom-30">
				<p>{{ session()->get('danger') }}</p>
				<a class="close" href="#"></a>
			</div>
		</div>
	</div>
@endif

<div class="row">

	<!-- Profile -->
	<div class="col-lg-6 col-md-6">
		<div class="dashboard-list-box margin-top-0">
			<h4 class="gray">Change Password</h4>
			<div class="dashboard-list-box-static">
				
				<!-- Details -->
				<form method="post" action="{{ route('password.update', Auth::user()->id) }}">
					@csrf
					@method('PUT')
					<div class="my-profile">
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<label>Current Password</label>
								<input name="passwordold" type="password" placeholder="Current Password" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<label>New Password</label>
								<input name="password" type="password" placeholder="New Password" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<label>Confirm New Password</label>
								<input name="password_confirmation" type="password" placeholder="Confirm Password" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12 text-center">
								<button type="submit" class="button margin-top-15">Change Password</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection