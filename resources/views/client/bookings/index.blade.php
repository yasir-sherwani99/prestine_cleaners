@extends('layouts.app')

@section('content')

<!-- Titlebar -->
<div id="titlebar">
	<div class="row">
		<div class="col-md-12">
			<h2>Bookings</h2>
			<!-- Breadcrumbs -->
			<nav id="breadcrumbs">
				<ul>
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ route('home') }}">Dashboard</a></li>
					<li>Bookings</li>
				</ul>
			</nav>
		</div>
	</div>
</div>

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

<div class="row">
			
	<!-- Listings -->
	<div class="col-lg-12 col-md-12">
		<div class="dashboard-list-box margin-top-0">

			<!-- Sort by -->
			<div class="sort-by">
				<div class="sort-by-select">
					<select data-placeholder="Default order" class="chosen-select-no-single">
						<option>Any Status</option>	
						<option>Approved</option>
						<option>Pending</option>
						<option>Canceled</option>
					</select>
				</div>
			</div>

			<h4>Bookings List</h4>
			<ul>
				@if(!$bookings->isEmpty())
					@foreach($bookings as $book)
						
						<?php
						
							if($book->is_booked == 0){
								$book_class = 'pending-booking';
								$status = 'Pending';
							}
							elseif($book->is_booked == 1){
								$book_class = 'approved-booking';
								$status = 'Approved';
							}
							else{
								$book_class = 'canceled-booking';
								$status = 'Canceled';
							}
						?>	

						<li class="{{ $book_class }}">
							<div class="list-box-listing bookings">
								<div class="list-box-listing-img"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=120" alt=""></div>
								<div class="list-box-listing-content">
									<div class="inner">
										<h3>{{ $book->service->title }} <span class="booking-status">{{ $status }}</span></h3>

										<div class="inner-booking-list">
											<h5>Booking Date:</h5>
											<ul class="booking-list">
												<li class="highlighted">{{ date('d F Y, h:i A', strtotime($book->created_at)) }}</li>
											</ul>
										</div>

										<div class="inner-booking-list">
											<h5>Service Date:&nbsp;&nbsp;</h5>
											<ul class="booking-list">
												<?php
													$service_date = $book->cleaning_start_date . ' ' . $book->cleaning_start_time; 
												?>
												<li class="highlighted">{{ date('d F Y, h:i A', strtotime($service_date)) }}</li>
											</ul>
										</div>
													
										<div class="inner-booking-list">
											<h5>Cleaning Place:</h5>
											<ul class="booking-list">
												<li><i class="sl sl-icon-location"></i> {{ $book->cleaning_area_post_code }}</li>
											</ul>
										</div>		

										<div class="inner-booking-list">
											<h5>Client:</h5>
											<ul class="booking-list">
												<li>Prestine Cleaners</li>
												<li>info@prestinecleaners.co.uk</li>
												<li>07387 312 723</li>
											</ul>
										</div>

										<!-- <a href=".small-dialog_{{ $book->id }}" class="rate-review popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a> -->

										<!-- Reply to review popup -->
										<div id="small-dialog" class="zoom-anim-dialog mfp-hide small-dialog_{{ $book->id }}">
											<div class="small-dialog-header">
												<h3>Send Message</h3>
											</div>
											<div class="message-reply margin-top-0">
												<form method="post" action="#">
													@csrf
													<input type="hidden" name="booking_id" value="{{ $book->id }}">
													<input type="hidden" name="user_id" value="{{ $book->user_id }}">
													<textarea cols="40" rows="3" maxlength="500" required placeholder="Your Message to Yasir"></textarea>
													<small style="display: block; margin-top: -20px;">Maximum 500 characters including spaces.</small>
													<button class="button" type="submit">Send</button>
												</form>
											</div>
										</div>

									</div>
								</div>
							</div>
							@if($book->is_booked == 0)
							<div class="buttons-to-right">
								<a href="{{ route('booking.cancel', $book->id) }}" class="button gray reject"><i class="sl sl-icon-close"></i> Cancel</a>
								<!-- <a href="#" class="button gray approve"><i class="sl sl-icon-check"></i> Approve</a> -->
							</div>
							@endif
						</li>
					@endforeach
				@else
					<li class="pending-booking">
						There is no booking to show here ...
					</li>
				@endif
			</ul>
		</div>
	</div>
</div>

@endsection
@section('script')
<script>

	$(document).ready(function() {
		$('.reject').on('click', function(){
			if(confirm('Are you sure you want to cancel this booking?'))
			{ 
				return true;
			}else{
				return false;
			} 
		});
	});

</script>
@endsection