@extends('layouts.admin')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/forms/validation/form-validation.css') }}">
@endsection

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Snippets</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Settings</a></li>
            		<li class="breadcrumb-item active">Snippets</li>
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
              	<ul>
              		@foreach ($errors->all() as $error)
                  		<li>{{ $error }}</li>
              		@endforeach
              	</ul>
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
	      				<h4 class="card-title">Snippets</h4>
	    			</div>
			        <div class="card-content">
			          	<div class="card-body">
			            	<div class="card-text">
			              		<form class="form" method="POST" action="{{ route('admin.snippet.store') }}" novalidate>
			              		@csrf
			              		<div class="form-body">
			                		<div class="row">
			                 			<div class="col-md-12 col-12">
						                    <div class="form-group">
						                      	<label for="name" class="text-bold-600 black">Snippet Name <span class="danger darken-4">*</span></label>
						                      	<input type="text" id="name" class="form-control" required data-validation-required-message="Snippet Name field is required" name="name" placeholder="e.g Google Adwords">
						                      	<div class="help-block font-small-3"></div>
						                    </div>
			                  			</div>
			                  		</div>
			                  		<div class="row">
						                <div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="site_display" class="text-bold-600 black">Site Display <span class="danger darken-4">*</span></label>
					                      		<select class="form-control" name="site_display" id="site_display" required data-validation-required-message="Site display field is required">
					                      			<option value="site_wide">Site Wide</option>
					                      			<option value="page">Specific Page</option>
					                      		</select>
					                      		<div class="help-block font-small-3"></div>
					                    	</div>
					                  	</div>
			                		</div>
			                		<div class="row d-none" id="page_section">
						                <div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="page" class="text-bold-600 black">Page <span class="danger darken-4">*</span></label>
					                      		<select class="form-control" name="page" id="page" required data-validation-required-message="Page field is required">
					                      			<option value="home">Home Page</option>
					                      			<option value="about">About Page</option>
					                      			<option value="services">Services Page</option>
					                      			<option value="areas">Areas Page</option>
					                      			<option value="faq">FAQ Page</option>
					                      			<option value="contact">Contact Page</option>
					                      			<option value="booking">Booking Page</option>
					                      			<option value="login">Login Page</option>
					                      			<option value="register">Sign up Page</option>
					                      			<option value="forgot">Forgot Password Page</option>
					                      		</select>
					                      		<div class="help-block font-small-3"></div>
					                    	</div>
					                  	</div>
			                		</div>
			                		<div class="row">
						                <div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="location" class="text-bold-600 black">Location <span class="danger darken-4">*</span></label>
					                      		<select class="form-control" name="location" required data-validation-required-message="Location field is required">
					                      			<option value="header">Header</option>
					                      			<option value="footer">Footer</option>
					                      		</select>
					                      		<div class="help-block font-small-3"></div>
					                    	</div>
					                  	</div>
			                		</div>
			                		<div class="row">
						                <div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="status" class="text-bold-600 black">Status <span class="danger darken-4">*</span></label>
					                      		<select class="form-control" name="status" required data-validation-required-message="Status field is required">
					                      			<option value="1">Active</option>
					                      			<option value="0">Inactive</option>
					                      		</select>
					                      		<div class="help-block font-small-3"></div>
					                    	</div>
					                  	</div>
			                		</div>
					                <div class="row">
					                  	<div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="code" class="text-bold-600 black">Snippet / Code <span class="danger darken-4">*</span></label>
					                      		<textarea name="code" class="form-control" rows="10" required data-validation-required-message="Snippet / Code field is required"></textarea>
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
  <script>
  	$(document).ready(function() {
  		$("#site_display").on('change', function() {
  			var display = $("#site_display").val();
  			if(display == 'page') {
  				$("#page_section").removeClass('d-none');
  			} else {
  				$("#page_section").addClass('d-none');
  			}
  		});
  	});
  </script>
@endsection