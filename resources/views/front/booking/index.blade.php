@extends('layouts.master')

@section('style')
@endsection

@section('content')

	@include('layouts.inc.partials._banner2') 

	<!-- Start Main Content Area -->
    <section class="wizard-online-booking">
	    <div class="container">
	    	
            @if (count($errors) > 0)
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <b>Alert!</b>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @if(session()->has('alert'))
            <div class="row mb-4">
                <div class="col-md-12">
					<div class="alert alert-danger alert-dismissible" role="alert">
					    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					    <strong>Oh Snap!</strong> <span class="text-bold-600">{{ session()->get('alert') }}</span>
					</div>
				</div>
			</div>
			@endif

         	@if(session()->has('success')) 
		    <div class="row mb-5">
		      	<div class="col-md-8 col-lg-6 col-xl-5 mx-auto"> 
		        	<div class="card p-5">
	            		<div class="card-body">
	                		<div class="text-center mb-5">
	                  			<p class="text-success">
	                  				<i class="fa fa-check fa-4x"></i>
	                  			</p>
	                  			<h2 class="text-success">Awesome!</h2>
	                  			<h3 class="text-bold-500">Booking Confirmed</h3>
	                		</div>
	                		<p class="text-center mb-4">
	                			{{ session()->get('success') }}
	                		</p>
	                	</div>
	                	<div class="card-footer bg-white border-0">
	                		<a href="{{ route('booking.index') }}">
	                			<button class="btn btn-success btn-lg btn-block text-bold-600">Book Online Again</button>
	                		</a>
	              		</div>
		            </div>
		        </div> 
		    </div>
            @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>Book Online</h2>
                        <p>Book a service for your home, office or event?</p>
                    </div>
                </div>
            </div>
	    	<div class="row mb-5">
	    		<div class="col-md-8 col-lg-8">
	    			<form id="bookingForm" method="POST" action="{{ route('booking.store') }}">
	    				@csrf
				      	<div id="wizard">
				        	<h3>
				          		<div class="media">
				            		<!-- <div class="bd-wizard-step-icon"><i class="fa fa-cog"></i></div> -->
			            			<div class="media-body text-center">
			              				<div class="bd-wizard-step-title">Choose Service</div>
			              				<div class="bd-wizard-step-subtitle">Step 1</div>
			            			</div>
				          		</div>
				        	</h3>
				        	<section id="booking-step1" data-mode="async" data-url="{{ route('booking.step1') }}">
				          		
				        	</section>
				        	<h3>
				          		<div class="media">
				            		<!-- <div class="bd-wizard-step-icon"><i class="fa fa-cogs"></i></div> -->
				            		<div class="media-body text-center">
				              			<div class="bd-wizard-step-title">Service Details</div>
				              			<div class="bd-wizard-step-subtitle">Step 2</div>
				            		</div>
				          		</div>
				        	</h3>
				        	<section id="booking-step2">

				        	</section>
				        	<h3>
				          		<div class="media">
				            		<!-- <div class="bd-wizard-step-icon px-2"><i class="fa fa-file-text-o"></i></div> -->
				            		<div class="media-body text-center">
				              			<div class="bd-wizard-step-title">Service Schedule</div>
				              			<div class="bd-wizard-step-subtitle">Step 3</div>
				            		</div>
				          		</div>
				        	</h3>
				        	<section id="booking-step3" data-mode="async" data-url="{{ route('booking.step3') }}">

				        	</section>
				        	<h3>
				          		<div class="media">
				            		<!-- <div class="bd-wizard-step-icon"><i class="fa fa-check"></i></div> -->
				            		<div class="media-body text-center">
				              			<div class="bd-wizard-step-title">Login & Submit</div>
				              			<div class="bd-wizard-step-subtitle">Step 4</div>
				            		</div>
				          		</div>
				        	</h3>
				        	<section id="booking-step4" data-mode="async" data-url="{{ route('booking.step4') }}">
				          		
				        	</section>
				     	</div>
			     	</form>
			     	<form id="logout-form3" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                    </form>
			    </div>
			    <div class="col-md-4 col-lg-4">
			    	<div class="widget2 booking_summary">
                        <h3 class="widget-title text-center p-4 bg-light">Booking Summary</h3>
                        <ul class="list-unstyled mb-3">
                            <li>
                                <div class="row p-0">
                                	<div class="col-md-2 col-2 service_icon p-0">
                                		<i class="fa fa-home fa-2x"></i>
                                	</div>
                                	<div class="col-md-10 col-10 pt-1 service_name">
                                		Select Cleaning Service
                                	</div>
                                </div>	
                            </li>
                            <li>
                                <div class="row p-0">
                                	<div class="col-md-2 col-2 cost_estimation_icon p-0">
                                		<i class="fa fa-line-chart fa-2x"></i>
                                	</div>
                                	<div class="col-md-10 col-10 pt-1 cost_estimation">
                                		Cost Estimation
                                	</div>
                                </div>
                                <div class="row cost_estimation_yes d-none mt-4 mb-2">
                                	<div class="col-md-12 col-12">
                                		<div class="row border-bottom pb-2">
                                			<div class="col-md-9 col-9" style="font-weight: 600;">Item(s)</div>
                                			<div class="col-md-3 col-3" style="font-weight: 600;">Price</div>
                                		</div>
                                	</div>
                                	<div class="col-md-12 col-12 service_estimated_cost">
                                	 	 
                                	</div>
                                	<div class="col-md-12 col-12 service_total border-top">
                                		<div class="row pt-2">
                                			<div class="col-md-9 col-9" style="font-weight: 600;">
                                				Total
                                			</div>
                                			<div class="col-md-3 col-3" style="font-weight: 600;">
                                				&pound; <span id="cost_total" class="d-inline" style="font-weight: 600;">0</span>
                                			</div>
                                		</div>
                                	</div>
                                	<!-- <div class="col-md-12 col-12 service_estimated_cost_msg d-none">
                                	 <small><strong>Note</strong></small>
                                	 <small class="d-block">This is just a rough estimate, final cost will be decide after the work done.</small>
                                	</div> -->
                                </div>
                                <div class="row cost_estimation_no d-none mt-4 mb-2">
                                	<div class="col-md-12 col-12 service_estimated_cost_others">
                                		<strong>Note</strong>
                                		<p class="text-primary">Estimate and all costs depends on on-site inspection.</p>
                                	</div>
                                </div>
                            </li>
                            <li class="service_box">
                                <div class="row p-0">
                                	<div class="col-md-2 col-2 service_date_icon p-0">
                                		<i class="fa fa-clock-o fa-2x"></i>
                                	</div>
                                	<div class="col-md-10 col-10 pt-1 service_date">
                                		Choose Service Date 
                                	</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="card">
					  	<div class="card-body">
					    	<h5 class="card-title">Need Help?</h5>
					    	<p class="card-text">If you are stuck or need any help, call us on 07387 312 723</p>
					  	</div>
					</div> -->
                    
			    </div>
			</div>
			@endif    
	    </div>
	</section>
	
@endsection

@section('script')
<script>
	$(document).ready(function() {
	  	
		$('div.container .col-md-4').theiaStickySidebar({
			additionalMarginTop: 100
		});
		
	});
</script>
@endsection