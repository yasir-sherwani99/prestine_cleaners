@extends('layouts.admin')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/forms/validation/form-validation.css') }}">
@endsection

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Admins</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Settings</a></li>
            		<li class="breadcrumb-item active">Add Admin</li>
          		</ol>
        	</div>
      	</div>
    </div>
</div>

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
        	setTimeout(function(){ toastr.error('You must fill in all of the required fields!', 'Vista Network Says', {"hideDuration": 500, positionClass: 'toast-top-right'}); }, 2000);
    	});

  </script>
@endif

<div class="content-detached content-left">
	<div class="content-body">
		<section class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
		  				<h4 class="card-title">Add Administrator</h4>
					</div>
			        <div class="card-content">
			          	<div class="card-body">
			            	<div class="card-text">
			              		<form class="form" method="POST" action="{{ route('admin.admins.store') }}" enctype="multipart/form-data" novalidate>
			              		@csrf
			              		<div class="form-body">
			                		<div class="row">
			                 			<div class="col-md-6 col-12">
						                    <div class="form-group">
						                      	<label for="first_name" class="text-bold-600 black">Name <span class="danger darken-4">*</span></label>
						                      	<input type="text" id="first_name" class="form-control" required data-validation-required-message="Name field is required" name="name">
						                      	<div class="help-block font-small-3"></div>
						                    </div>
			                  			</div>
						                <div class="col-md-6 col-12">
					                    	<div class="form-group">
					                      		<label for="email" class="text-bold-600 black">Email <span class="danger darken-4">*</span></label>
					                      		<input type="text" id="email" class="form-control" required data-validation-required-message="Email field is required" name="email">
					                      		<div class="help-block font-small-3"></div>
					                    	</div>
					                  	</div>
			                		</div>
					                <div class="row">
					                  	<div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="designation" class="text-bold-600 black">Designation <span class="danger darken-4">*</span></label>
					                      		<input type="text" id="designation" class="form-control" required data-validation-required-message="Designation field is required" name="designation">
					                     	 	<div class="help-block font-small-3"></div>
					                    	</div>
					                  	</div>
					                </div>
					                <div class="row">
						                <div class="col-md-6 col-12">
						                    <div class="form-group">
						                      	<label for="password" class="text-bold-600 black">Password <span class="danger darken-4">*</span></label>
						                      	<input type="password" id="password" class="form-control" placeholder="Password" required data-validation-required-message="Password field is required" name="password" minlength="6">
						                      	<small>Password must contain at least 6 characters.</small><br/>
						                      	<div class="help-block font-small-3"></div>
						                    </div>
						                </div>
						                <div class="col-md-6 col-12">
						                    <div class="form-group">
						                      	<label for="confirm_password" class="text-bold-600 black">Confirm Password <span class="danger darken-4">*</span></label>
						                      	<input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" data-validation-matches-match="password"
						                      data-validation-matches-message="Password & Confirm Password must be the same." name="password_confirmation">
						                      	<div class="help-block font-small-3"></div>
						                    </div>
						                </div>
						            </div>
					                <div class="row icheck_minimal skin">
					                  	<div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="status" class="text-bold-600 black">Status <span class="danger darken-4">*</span></label>
					                      		<br/>
					                      		<input type="radio" name="status" id="input-radio-5" required data-validation-required-message="Status field is required" value="1" /> <label for="input-radio-5">Active</label>
					                      		<br/>
					                      		<input type="radio" name="status" id="input-radio-6" required data-validation-required-message="Status field is required" value="0" /> <label for="input-radio-6">Inactive</label>
					                      		<div class="help-block font-small-3"></div>
					                   	 	</div>
					                  	</div>
					                </div>
			              		</div>
			          
					            <div class="form-actions text-center">
					                <button type="submit" class="btn btn-info btn-glow px-2"> 
					                 	<span class="without-load">Save</span>
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
</div> 
	

@endsection

@section('script')
  <script src="{{ asset('admin-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"
  type="text/javascript"></script>
  <script src="{{ asset('admin-assets/js/scripts/forms/validation/form-validation.js') }}"
  type="text/javascript"></script>
@endsection