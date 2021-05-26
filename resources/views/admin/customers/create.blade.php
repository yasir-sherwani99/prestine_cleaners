@extends('layouts.admin')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/forms/validation/form-validation.css') }}">
@endsection

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Add Customer</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Customers</a></li>
            		<li class="breadcrumb-item active">Add Customer</li>
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
	      				<h4 class="card-title">Add Customer</h4>
	    			</div>
			        <div class="card-content">
			          	<div class="card-body">
			            	<div class="card-text">
			              		<form class="form" method="POST" action="{{ route('admin.customers.store') }}" novalidate>
			              		@csrf
			              		<div class="form-body">
			                		<div class="row">
			                 			<div class="col-md-12 col-12">
						                    <div class="form-group">
						                      	<label for="name" class="text-bold-600">Name <span class="danger darken-4">*</span></label>
						                      	<input type="text" name="name" id="name" class="form-control" placeholder="Complete name" required data-validation-required-message="Name field is required">
						                      	<div class="help-block font-small-3"></div>
						                    </div>
			                  			</div>
			                		</div>
					                <div class="row">
					                	<div class="col-md-6 col-12">
					                    	<div class="form-group">
					                      		<label for="email" class="text-bold-600">Email <span class="danger darken-4">*</span></label>
					                      		<input type="email" name="email" id="email" class="form-control" placeholder="Email" required data-validation-required-message="Email field is required">
					                      		<small>Enter unique email of customer</small>
					                      		<div class="help-block font-small-3"></div>
					                    	</div>
					                  	</div>
					                  	<div class="col-md-6 col-12">
					                    	<div class="form-group">
					                      		<label for="phone" class="text-bold-600">Phone </label>
					                      		<input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
					                    	</div>
					                  	</div>
					                </div>
					                <div class="row">
					                  	<div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="address" class="text-bold-600">Address</label>
					                      		<input type="text" name="address" id="address" class="form-control" placeholder="Address">
					                    	</div>
					                  	</div>
					                </div>
					                <div class="row">
					                  	<div class="col-md-6 col-12">
					                    	<div class="form-group">
					                      		<label for="post_code" class="text-bold-600">Post Code</label>
					                      		<input type="text" name="post_code" id="post_code" class="form-control" placeholder="Post Code">
					                    	</div>
					                  	</div>
					                  	<div class="col-md-6 col-12">
					                    	<div class="form-group">
					                      		<label for="city" class="text-bold-600">City</label>
					                      		<input type="text" name="city" id="city" class="form-control" placeholder="City">
					                    	</div>
					                  	</div>
					                </div>
					                
			              		</div>
			          
					            <div class="form-actions text-center">
					                <button type="submit" class="btn btn-info btn-glow px-2"> 
					                 	<span class="without-load">Add New Customer</span>
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
	<script src="{{ asset('admin-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('admin-assets/js/scripts/forms/validation/form-validation.js') }}"
  type="text/javascript"></script>
@endsection