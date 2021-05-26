<div class="container agreement">
    <div class="row">
        <div class="col-lg-12">
        	@if (Route::has('login'))
                @auth
        			<h4 class="mb-5">Client Details</h4>
		        	
		        	@include('front.booking.inc.sections.customer_details')
				@else
					<h4 class="mb-5">Login Details</h4>

					@include('front.booking.inc.sections.customer')

		 			@include('front.booking.inc.sections.login_details')

					@include('front.booking.inc.sections.signup_details')
				@endauth
			@endif

	        <div class="choose_aggreement checkbox_error">
	        	<div class="row">
        			<div class="col-md-12">	
        			<!-- <h4 class="mb-5">Accept Agreement</h4> -->
			        	<div class="form-check">
				  			<label class="form-check-label">
				    			<input type="checkbox" class="form-check-input" name="agreement" id="agreement" value="checkedValue" checked>
				    				I hereby declare that I had read all the <a href="{{ route('terms_conditions') }}" target="_blank">terms and conditions</a>  and all the details provided by me in this form are true.
				  			</label>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>