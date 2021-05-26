@extends('layouts.admin')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/forms/validation/form-validation.css') }}">
@endsection

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Password</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Settings</a></li>
            		<li class="breadcrumb-item active">Password</li>
          		</ol>
        	</div>
      	</div>
    </div>
</div>

@if(session()->has('success'))
<div class="alert alert-icon-left alert-arrow-left alert-success alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="la la-thumbs-o-up text-bold-600"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
    </button>
    <strong>Well done!</strong> <span class="text-bold-600">{{ session()->get('success') }}</span>
</div>
<script>

    $(document).ready(function(){
        setTimeout(function(){ toastr.success("{{ session()->get('success') }}", 'Prestine System Says', {"hideDuration": 500, positionClass: 'toast-top-right'}); }, 2000);
    });

</script>
@endif

@if(session()->has('alert'))
<div class="alert alert-icon-left alert-arrow-left alert-danger alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="la la-thumbs-o-down text-bold-600"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
    </button>
    <strong>Oh Snap!</strong> <span class="text-bold-600">{{ session()->get('alert') }}</span>
</div>
<script>

    $(document).ready(function(){
        setTimeout(function(){ toastr.error("{{ session()->get('alert') }}", 'Prestine System Says', {"hideDuration": 500, positionClass: 'toast-top-right'}); }, 2000);
    });

</script>
@endif

@if (count($errors) > 0)
  <div class="row">
      <div class="col-md-12">
          <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</b>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </div>
      </div>
  </div>
  <script>

    $(document).ready(function(){
        setTimeout(function(){ toastr.error('You must fill in all of the required fields!', 'Prestine System Says', {"hideDuration": 500, positionClass: 'toast-top-right'}); }, 2000);
    });

  </script>
@endif

<div class="content-body">
	<section class="row">
	    <div class="col-md-8 col-12">
	      	<div class="card">
	        	<div class="card-header">
	          		<h4 class="card-title">Change Password</h4>
	          		<a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
	        	</div>
	        	<div class="card-content">
	          		<div class="card-body">
	          			<div class="card-text">
			            	<form class="form" method="POST" action="{{ route('admin.password.update', Auth::guard('admin')->user()->id) }}" novalidate>
			            	@csrf
			            	@method('PUT')
			            	<div class="form-body">
			              		<div class="row">
			                		<div class="col-md-12 col-12">
			                  			<div class="form-group">
			                    			<label for="current_password" class="text-bold-600 black">Current Password <span class="danger darken-4">*</span></label>
			                    			<input type="password" id="current_password" class="form-control" placeholder="Current Password" required data-validation-required-message="Current password field is required" name="passwordold">
			                    			<div class="help-block font-small-3"></div>
			                  			</div>
			                		</div>
			              		</div>
			              		<div class="row">
			                		<div class="col-md-12 col-12">
			                  			<div class="form-group">
			                    			<label for="new_password" class="text-bold-600 black">New Password <span class="danger darken-4">*</span></label>
			                    			<input type="password" id="new_password" class="form-control" placeholder="New Password" required data-validation-required-message="New password field is required" name="password" minlength="6">
			                    			<small>Password must contain at least 6 characters.</small><br/>
			                    			<div class="help-block font-small-3"></div>
			                  			</div>
			                		</div>
			              		</div>
			              		<div class="row">
			                		<div class="col-md-12 col-12">
			                  			<div class="form-group">
			                    			<label for="confirm_password" class="text-bold-600 black">Confirm Password <span class="danger darken-4">*</span></label>
			                    			<input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" data-validation-matches-match="password" data-validation-matches-message="Password & Confirm Password must be the same." name="password_confirmation">
			                    			<div class="help-block font-small-3"></div>
			                  			</div>
			                		</div>
			              		</div>
			            	</div>
			        
			            	<div class="form-actions text-center">
			              		<button type="submit" class="btn btn-info round btn-glow px-2"> 
			               			<span class="without-load">Change Password</span>
			              		</button>
			            	</div>
			            	</form>
			          	</div>
	          		</div>
	          	</div>
	        </div>
	    </div>
	</section>
</div>

@endsection

@section('script')
  <script src="{{ asset('admin-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"
  type="text/javascript"></script>
  <script src="{{ asset('admin-assets/js/scripts/forms/validation/form-validation.js') }}"
  type="text/javascript"></script>
@endsection



