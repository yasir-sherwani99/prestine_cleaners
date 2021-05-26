@extends('layouts.admin')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/forms/validation/form-validation.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/forms/extended/form-extended.css') }}">
@endsection

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Meta Tags</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Settings</a></li>
            		<li class="breadcrumb-item active">Edit Meta Tag</li>
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
	      				<h4 class="card-title">Edit Meta Tag</h4>
	    			</div>
			        <div class="card-content">
			          	<div class="card-body">
			            	<div class="card-text">
			              		<form class="form" method="POST" action="{{ route('admin.meta_tags.update', [$metatag->id]) }}" novalidate>
			              		@csrf
			              		@method('PUT')
			              		<div class="form-body">
			                		<div class="row">
			                 			<div class="col-md-12 col-12">
						                    <div class="form-group">
						                      	<label for="page" class="text-bold-600 black">Page</label>
						                      	<input type="text" id="page" class="form-control" value="{{ $metatag->page }}" readonly required data-validation-required-message="Page field is required" name="page">
						                      	<div class="help-block font-small-3"></div>
						                    </div>
			                  			</div>
			                  		</div>
			                  		<div class="row">
						                <div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="title" class="text-bold-600 black">Title <span class="danger darken-4">*</span></label>
					                      		<input type="text" id="title" class="form-control always-show-maxlength" value="{{ $metatag->title }}" required data-validation-required-message="Title field is required" name="title" maxlength="57">
					                      		<div class="help-block font-small-3">Max 57 characters</div>
					                    	</div>
					                  	</div>
			                		</div>
					                <div class="row">
					                  	<div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="description" class="text-bold-600 black">Description <span class="danger darken-4">*</span></label>
					                      		<textarea class="form-control textarea-maxlength" id="description" name="description" placeholder="Page description" maxlength="250">{{ $metatag->description }}</textarea>
					                     	 	<div class="help-block font-small-3">Max 250 characters</div>
					                    	</div>
					                  	</div>
					                </div>
					                <div class="row">
					                  	<div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="keywords" class="text-bold-600 black">Keywords <span class="danger darken-4">*</span></label>
					                      		<input type="text" id="keywords" class="form-control" value="{{ $metatag->keywords }}" required data-validation-required-message="Keywords field is required" name="keywords">
					                     	 	<div class="help-block font-small-3">e.g. cleaning, end of tenancy, carpet cleaning</div>
					                    	</div>
					                  	</div>
					                </div>
					                
			              		</div>
			          
					            <div class="form-actions text-center">
					                <button type="submit" class="btn btn-info btn-glow px-2"> 
					                 	<span class="without-load">Update</span>
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
  <script src="{{ asset('admin-assets/vendors/js/forms/extended/maxlength/bootstrap-maxlength.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin-assets/js/scripts/forms/extended/form-maxlength.js') }}" type="text/javascript"></script>
@endsection