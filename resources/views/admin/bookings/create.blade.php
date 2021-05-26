@extends('layouts.admin')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/forms/selects/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/forms/validation/form-validation.css') }}">
@endsection

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Add Booking</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Bookings</a></li>
            		<li class="breadcrumb-item active">Add Booking</li>
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
		  				<h4 class="card-title">Add Booking</h4>
					</div>
			        <div class="card-content">
			          	<div class="card-body">
			            	<div class="card-text">
			              		<form class="form" method="POST" action="{{ route('admin.bookings.store') }}" novalidate>
			              		@csrf
			              		<div class="form-body">
			                		<div class="row">
			                 			<div class="col-md-8 col-8">
						                    <div class="form-group">
						                      	<label for="customer_id" class="text-bold-600">Customer <span class="danger darken-4">*</span></label>
						                      	<select class="select2 form-control" name="customer_id" id="customer_id" style="width: 100% !important;">
					                				<optgroup label="Customers">
					                					<option value="{{ isset($customer) ? $customer->id : '' }}">{{ isset($customer) ? $customer->name : 'Select Customer' }}</option>
					                					@foreach($users as $user)
								                          	<option value="{{ $user->id }}">{{ $user->name }}</option>
								          				@endforeach
							                        </optgroup>    
							                    </select>
							                    <div class="help-block font-small-3 text-left"></div>
						                    </div>
			                  			</div>
			                  			<div class="col-md-4 col-4" style="padding-top: 8px;">
			                  				<a href="{{ route('admin.customers.create') }}" class="btn btn-secondary btn-sm my-2 text-bold-600 font-medium-3"> 
					                 			<i class="la la-plus"></i> New Customer
					                		</a>
			                  			</div>
			                  		</div>
			                  		<div class="row">
			                  			<div class="col-md-12 col-12">
					                    	<div class="form-group">
					                      		<label for="cleaning_area_address" class="text-bold-600">Where would service will be provided? <span class="danger darken-4">*</span></label>
					                      		<input type="text" name="cleaning_area_address" id="cleaning_area_address" class="form-control" placeholder="Cleaning site address" value="{{ isset($customer->address) ? $customer->address : '' }}" required minlength="10" maxlength="255" data-validation-required-message="This field is required">
					                      		<small>Full address including post code</small>
					                      		<div class="help-block font-small-3"></div>
					                    	</div>
			                  			</div>
			                  		</div>
			                  		<div class="row">
						                <div class="col-md-6 col-12">
					                    	<div class="form-group">
					                      		<label for="service_id" class="text-bold-600">Service <span class="danger darken-4">*</span></label>
					                      		<select class="form-control" name="service_id" id="service_id" required data-validation-required-message="This field is required">
				                					<option value="">Select Service</option>
				                					@foreach($services as $service)
							                          	<option value="{{ $service->id }}">{{ $service->title }}</option>
							          				@endforeach    
							                    </select>
					                      		<div class="help-block font-small-3"></div>
					                    	</div>
					                  	</div>
			                		</div>
			                		<div class="row">
						                <div class="col-md-6 col-12">
					                    	<div class="form-group">
					                      		<label for="service_cost" class="text-bold-600">Service Cost</label>
					                      		<div class="input-group">
							                        <div class="input-group-prepend">
							                          	<span class="input-group-text" id="service_cost">
							                          		<i class="la la-gbp"></i>
							                          	</span>
							                        </div>
							                        <input type="number" name="service_cost" class="form-control" aria-describedby="service_cost">
							                    </div>
					                      		<div class="help-block font-small-3"></div>
					                    	</div>
					                  	</div>
			                		</div>
			                		<div class="row">
										<div class="col-md-6 col-12">
											<div class="form-group">
												<label for="cleaning_start_date" class="text-bold-600">What is the cleaning start date? <span class="danger darken-4">*</span></label>
												<input type="date" id="cleaning_start_date" name="cleaning_start_date" class="form-control" value="{{ old('cleaning_start_date') }}" required data-validation-required-message="This field is required">
												<div class="help-block font-small-3"></div> 
											</div>
										</div>
										<div class="col-md-6 col-12">
											<div class="form-group">
												<label for="cleaning_start_time" class="text-bold-600">What is the cleaning start time? <span class="danger darken-4">*</span></label>
												<select name="cleaning_start_time" id="cleaning_start_time" class="form-control" required data-validation-required-message="This field is required">
													<option value="{{ old('cleaning_start_time') }}">{{ old('cleaning_start_time') != NULL ? old('cleaning_start_time') : 'Select Time' }}</option>
													<option value="08:00 AM">08:00 AM</option>
													<option value="08:30 AM">08:30 AM</option>
													<option value="09:00 AM">09:00 AM</option>
													<option value="09:30 AM">09:30 AM</option>
													<option value="10:00 AM">10:00 AM</option>
													<option value="10:30 AM">10:30 AM</option>
													<option value="11:00 AM">11:00 AM</option>
													<option value="11:30 AM">11:30 AM</option>
													<option value="12:00 PM">12:00 PM</option>
													<option value="12:30 PM">12:30 PM</option>
													<option value="01:00 PM">01:00 PM</option>
													<option value="01:30 PM">01:30 PM</option>
													<option value="02:00 PM">02:00 PM</option>
													<option value="02:30 PM">02:30 PM</option>
													<option value="03:00 PM">03:00 PM</option>
													<option value="03:30 PM">03:30 PM</option>
													<option value="04:00 PM">04:00 PM</option>
													<option value="04:30 PM">04:30 PM</option>
													<option value="05:00 PM">05:00 PM</option>
													<option value="05:30 PM">05:30 PM</option>
													<option value="06:00 PM">06:00 PM</option>
													<option value="06:30 PM">06:30 PM</option>
													<option value="07:00 PM">07:00 PM</option>
												</select>
												<div class="help-block font-small-3"></div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-12">
											<div class="form-group">
												<label for="additional_info" class="text-bold-600">Additional Notes</label>
												<textarea name="additional_info" id="additional_info" class="form-control" rows="5" placeholder="Additional information">{{ old('additional_info') }}</textarea> 
											</div>
										</div>
									</div>
			              		</div>
			          
					            <div class="form-actions text-center">
					                <button type="submit" class="btn btn-info btn-glow px-2"> 
					                 	<span class="without-load">Create New Booking</span>
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
  	<script src="{{ asset('admin-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('admin-assets/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

	<script type="text/javascript">

	    CKEDITOR.replace('additional_info', {

	      	removeButtons: 'Source,Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Find,Replace,SelectAll,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Subscript,Superscript,CopyFormatting,RemoveFormat,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Flash,SpecialChar,PageBreak,Iframe,Maximize,ShowBlocks,About,Image,Styles,Format,Font,FontSize,TextColor,Outdent,Indent,Blockquote,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,BGColor,Smiley',

	      	height: 250

	    });

	    $(document).ready(function() {
	    	$("#customer_id").on('change', function(){
	    		var customer_id = $("#customer_id").val();
	    		$.ajax({
	    			method: 'GET',
	    			url: '/admin_panel/booking/getAddress/' + customer_id,
	    			success: function(response) {
	    				if(response.status == "fail") {
	    					alert('Address not found');
	    				} else {
	    					$("#cleaning_area_address").val(response.address);
	    				}
	    			}
	    		});
	    	});
	    });

	</script>
@endsection