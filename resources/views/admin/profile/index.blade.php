@extends('layouts.admin')

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Profile</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">My Account</a></li>
            		<li class="breadcrumb-item active">Profile</li>
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

<div class="content-body">
	<section class="row">
	    <div class="col-12">
	      	<div class="card">
	        	<div class="card-header">
	          		<h4 class="card-title">Profile</h4>
	          		<a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
	        	</div>
	        	<div class="card-content">
	          		<div class="card-body">
	          			<form class="form" method="POST" action="#" enctype="multipart/form-data" novalidate>
              			@method('PUT')
              			@csrf
              			<div class="form-body">
                			<div class="row">
                  				<div class="col-md-6 col-12">
                    				<div class="form-group">
                      					<label for="full_name" class="text-bold-600 black">Name <span class="danger darken-4">*</span></label>
                      					<input type="text" id="full_name" class="form-control" value="{{ $admin->name }}" required data-validation-required-message="Full name field is required" name="full_name">
                     					<div class="help-block font-small-3"></div>
                    				</div>
                    			</div>
                  				<div class="col-md-6 col-12">
                    				<div class="form-group">
                      					<label for="email" class="text-bold-600 black">Email <span class="danger darken-4">*</span></label>
                      					<input type="text" id="email" class="form-control" value="{{ $admin->email }}" required data-validation-required-message="Email field is required" name="email">
                      					<div class="help-block font-small-3"></div>
                    				</div>
                  				</div>
                			</div>
                			<div class="row icheck_minimal skin">
                  				<div class="col-md-12 col-12">
                    				<div class="form-group">
                      					<label for="status" class="text-bold-600 black">Status <span class="danger darken-4">*</span></label>
                      					<br/>
	                      				<input type="radio" name="status" id="input-radio-5" required data-validation-required-message="Status field is required" value="1" {{ $admin->status == 1 ? 'checked' : '' }} /> <label for="input-radio-5">Active</label>
	                      				<br/>
	                      				<input type="radio" name="status" id="input-radio-6" required data-validation-required-message="Status field is required" value="0" {{ $admin->status == 0 ? 'checked' : '' }} /> <label for="input-radio-6">Inactive</label>
                      					<div class="help-block font-small-3"></div>
                    				</div>
                  				</div>
                			</div>
              			</div>
              			<div class="form-actions text-center">
			                <button type="submit" class="btn btn-info round btn-glow px-2">
			                   	<span class="loading-spinner" style="display: none;"><i class="la la-refresh spinner"></i>&nbsp;Processing... Please wait.</span> 
			                 	<span class="without-load">Update</span>
			                </button>
			             </div>
            			</form>
	            	</div>
	        	</div>
	      	</div>
	    </div>
	</section>
</div>

@endsection
