@extends('layouts.admin')

@section('content')

<div class="content-header row">
	<div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
		<h3 class="content-header-title mb-0 d-inline-block">Booking Details</h3>
		<div class="row breadcrumbs-top d-inline-block">
			<div class="breadcrumb-wrapper col-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Bookings</a></li>
					<li class="breadcrumb-item active">Booking Details</li>
				</ol>
			</div>
		</div>
	</div>
	@if($booking->is_booked == 0)
	<div class="content-header-right col-md-6 col-12 text-center text-md-right mb-1">
		<div class="row justify-content-end">
			<div class="col-md-auto col-6 pr-0">
				<form class="form" method="POST" action="{{ route('admin.bookings.status', ['id' => $booking->id]) }}" novalidate>
					@method('PUT')
					@csrf
					<input type="hidden" name="booking_status" value="1">
					<button type="submit" class="btn btn-success btn-min-width font-medium-1 text-bold-600"><i class="la la-check"></i>&nbsp;Approve</button>
				</form>
			</div>
			<div class="col-md-auto col-6">
				<form class="form" method="POST" action="{{ route('admin.bookings.status', ['id' => $booking->id]) }}" novalidate>
					@method('PUT')
					@csrf
					<input type="hidden" name="booking_status" value="2">
					<button type="submit" class="btn btn-danger btn-min-width font-medium-1 text-bold-600"><i class="la la-times"></i>&nbsp;Cancel</button>
				</form>
			</div>
		</div>
	</div>
	@endif
</div>
<div class="content-body">
	<section class="row">
		<div class="col-12 col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Booking Details</h4>
				</div>
				<div class="card-body">
					<div id="booking-client-info" class="mt-3">
						<div class="row">
							<div class="col-md-6 col-12 text-center text-md-left">
								<p class="text-muted">Bill To</p>
								<ul class="px-0 list-unstyled">
									<li class="text-bold-600">Mr/Ms. {{ $booking->user->name }}</li>
									<li>{{ $booking->user->email }}</li>
									<li>{{ $booking->user->phone }}</li>
									<!-- <li><i class="la la-map-marker"></i>&nbsp;{{ $booking->user->post_code }}</li> -->
								</ul>
							</div>
							<div class="col-md-6 col-12 text-center text-md-right">
								<ul class="list-unstyled">
			                  		<li><span class="text-bold-600">Booking Date: </span>{{ date('F d, Y H:i A', strtotime($booking->created_at)) }}</li>
			                  		<?php
			                  			$service_date = $booking->cleaning_start_date . ' ' . $booking->cleaning_start_time;
			                  		?>
			                  		<li><span class="text-bold-600">Service Date: </span>{{ date('F d, Y h:i A', strtotime($service_date)) }}</li>
			                  		<li>
			                  			<span class="text-bold-600">Status: </span>
			                  			@if($booking->is_booked == 0)
											<span>Pending</span>
										@elseif($booking->is_booked == 1)
											<span>Approved</span>
										@else
											<span>Cancelled</span>
										@endif
			                  		</li>
			                  	</ul>
							</div>
						</div>
					</div>
		
					<div id="services-details" class="pt-2">
						<div class="row">
							<div class="col-md-12 col-12">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th class="w-50 pl-0">Service</th>
												<th class="w-50">Details</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th class="pl-0">Where would you like us to provide service ?</th>
												<td>
													<i class="la la-map-marker"></i>&nbsp;{{ $booking->cleaning_area_post_code }}
												</td>
											</tr>
											<tr>
												<th class="pl-0">What kind of cleaning service required ?</th>
												<td>
													<mark>{{ $booking->service->title }}</mark>
												</td>
											</tr>
											@if(isset($booking->service_cost) && !empty($booking->service_cost))
											<tr>
												<th class="pl-0">Quoted Price</th>
												<td class="text-bold-600 text-success">
													<i class="la la-gbp mr-1"></i>{{ $booking->service_cost }}
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->furnished) && !empty($booking->booking_detail->furnished))
											<tr>
												<th class="pl-0">Is your property furnished ?</th>
												<td>
													{{ ucfirst($booking->booking_detail->furnished) }}
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->property_type) && !empty($booking->booking_detail->property_type))
											<tr>
												<th class="pl-0">Please tell us about you place ?</th>
												<?php
													$property_type = str_replace('-', ' ', $booking->booking_detail->property_type); 
												?>
												<td>
													{{ ucwords($property_type) }}
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->house_parts) && !empty($booking->booking_detail->house_parts))
											<tr>
												<?php
													$house_parts = json_decode($booking->booking_detail->house_parts, true);
												?>
												<th class="pl-0">Which of the following apply to your house ?</th>
												<td>
													<ul class="list-group">
														@foreach($house_parts as $key => $house)
														<li class="list-group-item">
															@if(getTitle($key) == "Bedrooms")
																<i class="la la-bed mr-1"></i>
															@elseif(getTitle($key) == "Bathrooms")
																<i class="la la-wheelchair mr-1"></i>
															@else
																<i class="la la-building mr-1"></i>
															@endif
															{{ getTitle($key) }} 
															<span class="badge badge-secondary badge-pill float-right">{{ $house }}</span>
														</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->property_inside_design) && !empty($booking->booking_detail->property_inside_design))
											<tr>
												<?php
													$property_inside_design = json_decode($booking->booking_detail->property_inside_design, true);
												?>
												<th class="pl-0">Which of the following apply to your property ?</th>
												<td>
													<p>Also needs cleaning in the following areas:</p>
													<ul>
														@foreach($property_inside_design as $key => $design)
															<li>{{ getTitle($design) }}</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->carpet_service) && !empty($booking->booking_detail->carpet_service))
											<tr>
												<th class="pl-0">How would you like your carpets to be cleaned ?</th>
												<td>
													@if($booking->booking_detail->carpet_service == 'no_carpet')
														<span>I don't have the carpet</span>
													@elseif($booking->booking_detail->carpet_service == 'machine')
														<span>Machine cleaned</span>
													@else
														<span>Hoovered only</span>
													@endif
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->carpet_house_location) && !empty($booking->booking_detail->carpet_house_location))
											<tr>
												<?php
													$carpet_house_location = json_decode($booking->booking_detail->carpet_house_location, true);
												?>
												<th class="pl-0">What areas need carpet cleaning ?</th>
												<td>
													<p>Carpet Cleaning Areas</p>
													<ul class="list-group">
														@foreach($carpet_house_location as $key => $carpet_location)
															<li class="list-group-item">
																<i class="la la-home mr-1"></i>{{ getTitle($key) }} 
																<span class="badge badge-secondary badge-pill float-right">{{ $carpet_location }}</span>
															</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->rug_size) && !empty($booking->booking_detail->rug_size))
											<tr>
												<?php
													$rug_size = json_decode($booking->booking_detail->rug_size, true);
												?>
												<th class="pl-0">If there are any rugs to be cleaned ?</th>
												<td>
													<p>Rugs to be cleaned.</p>
													<ul class="list-group">
														@foreach($rug_size as $key => $rug)            	
															<li class="list-group-item">
																<i class="la la-reorder mr-1"></i>
																{{ getTitle($key) }} 
																<span class="badge badge-secondary badge-pill float-right">{{ $rug }}</span>
															</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->upholstery_items) && !empty($booking->booking_detail->upholstery_items))
											<tr>
												<?php
													$upholstery_items = json_decode($booking->booking_detail->upholstery_items, true);
												?>
												<th class="pl-0">Would you like to upholstery to be cleaned ?</th>
												<td>
													<p>Upholstery items of be cleaned.</p>
													<ul class="list-group">
														@foreach($upholstery_items as $key => $upholstery)
															<li class="list-group-item">
																<i class="la la-coffee mr-1"></i>
																{{ getTitle($key) }} 
																<span class="badge badge-secondary badge-pill float-right">{{ ucfirst($upholstery) }} {{ $key == "curtain" ? ' Length' : '' }}</span>
															</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->extra_items) && !empty($booking->booking_detail->extra_items))
											<tr>
												<?php
													$extra_items = json_decode($booking->booking_detail->extra_items, true);
												?>
												<th class="pl-0">Would you also like to add ?</th>
												<td>
													<p>Extra cleaning required in following areas.</p>
													<ul>
														@foreach($extra_items as $key => $extra)
															<li>{{ getTitle($extra) }}</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->carpet_rug_material) && !empty($booking->booking_detail->carpet_rug_material))
											<tr>
												<?php
													$carpet_rug_material = json_decode($booking->booking_detail->carpet_rug_material, true);
												?>
												<th class="pl-0">What fibres are your carpet/rugs made of ?</th>
												<td>
													<p>Carpet Fibre</p>
													<ul>
														@foreach($carpet_rug_material as $key => $carpet_material)
															@if($carpet_material == 'standard')
																<li>Standard/fabric, synthetic etc</li>
															@endif
															@if($carpet_material == 'delicate')
																<li>Delicate/wool, cotton etc</li>
															@endif
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->furniture_items) && !empty($booking->booking_detail->furniture_items))
											<tr>
												<?php
													$furniture_items = json_decode($booking->booking_detail->furniture_items, true);
												?>
												<th class="pl-0">What kind of Sofas/Chairs would you like cleaned ?</th>
												<td>
													<p>Sofa Services</p>
													<ul class="list-group">
														@foreach($furniture_items as $key => $furniture)
															<li class="list-group-item">
																<i class="la la-coffee mr-1"></i>
																{{ getTitle($key) }}
																<span class="badge badge-secondary badge-pill float-right">{{ $furniture }}</span>
															</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->furniture_material) && !empty($booking->booking_detail->furniture_material))
											<tr>
												<?php
													$furniture_material = json_decode($booking->booking_detail->furniture_material, true);
												?>
												<th class="pl-0">What kind of material are your furniture items ?</th>
												<td>
													<p>Furniture Material</p>
													<ul>
														@foreach($furniture_material as $key => $furniture_material)
														<li>
															{{ ucfirst($furniture_material) }}
															@if($furniture_material == 'other') 
																({{ $booking->booking_detail->furniture_material_others }})
																<!-- <input type="text" value="{{ $booking->booking_detail->furniture_material_others }}" readonly> -->
															@endif
														</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->mattress_size) && !empty($booking->booking_detail->mattress_size))
											<tr>
												<?php
													$mattress_size = json_decode($booking->booking_detail->mattress_size, true);
												?>
												<th class="pl-0">Would you like to add mattress cleaning ?</th>
												<td>
													<p>Mattress Cleaning</p>
													<ul class="list-group">
														@foreach($mattress_size as $key => $mattress)
															<li class="list-group-item">
																<i class="la la-crosshairs mr-1"></i>{{ getTitle($key) }}
																<span class="badge badge-secondary badge-pill float-right">{{ $mattress }}</span>
															</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->curtain_size) && !empty($booking->booking_detail->curtain_size))
											<tr>
												<?php
													$curtain_size = json_decode($booking->booking_detail->curtain_size, true);
												?>
												<th class="pl-0">Would you like to add curtain cleaning ?</th>
												<td>
													<p>Curtain Cleaning</p>
													<ul class="list-group">
														@foreach($curtain_size as $key => $curtain)
															<li class="list-group-item">
																<i class="la la-folder-open"></i>
																{{ getTitle($key)   }}
																<span class="badge badge-secondary badge-pill float-right">{{ $curtain }}</span>
															</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->highest_window_location) && !empty($booking->booking_detail->highest_window_location))
											<tr>
												<th class="pl-0">On which floor is the highest window ?</th>
												<?php
													$highest_window_location = str_replace('-', ' ', $booking->booking_detail->highest_window_location); 
												?>
												<td>{{ ucwords($highest_window_location) }}</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->window_sides) && !empty($booking->booking_detail->window_sides))
											<tr>
												<th class="pl-0">Which sides of the windows should we clean ?</th>
												<td>{{ getTitle($booking->booking_detail->window_sides) }}</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->window_qty) && !empty($booking->booking_detail->window_qty))
											<tr>
												<th class="pl-0">How many windows do you have ?</th>
												<td>{{ $booking->booking_detail->window_qty }}</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->window_others) && !empty($booking->booking_detail->window_others))
											<tr>
												<?php
													$window_others = json_decode($booking->booking_detail->window_others, true);
												?>
												<th class="pl-0">Would you also like us to clean ?</th>
												<td>
													<p>Extra Windows Cleaning</p>
													<ul class="list-group">
														@foreach($window_others as $key => $window_other)
															<li class="list-group-item">
																<i class="la la-windows mr-1"></i>
																{{ getTitle($key) }} 
																<span class="badge badge-secondary badge-pill float-right">{{ $window_other == 0 ? '' : $window_other }}</span>
															</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->oven_type) && !empty($booking->booking_detail->oven_type))
											<tr>
												<?php
													$oven_type = json_decode($booking->booking_detail->oven_type, true);
												?>
												<th class="pl-0">What type is your oven/cooker ?</th>
												<td>
													<p>Oven/Cooker Type</p>
													<ul class="list-group">
														@foreach($oven_type as $key => $oven)
															<li class="list-group-item">
																<i class="la la-user-md mr-1"></i>
																{{ getTitle($key) }}
																<span class="badge badge-secondary badge-pill float-right">{{ $oven }}</span>
															</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->kitchen_accessory) && !empty($booking->booking_detail->kitchen_accessory))
											<tr>
												<?php
													$kitchen_accessory = json_decode($booking->booking_detail->kitchen_accessory, true);
												?>
												<th class="pl-0">Would you like to add any of the following ?</th>
												<td>
													<p>Kitchen Accessories</p>
													<ul class="list-group">
														@foreach($kitchen_accessory as $key => $kitchen)
															<li class="list-group-item">
																<i class="la la-stethoscope mr-1"></i>
																{{ getTitle($key) }}
																<span class="badge badge-secondary badge-pill float-right">{{ $kitchen }}</span>
															</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->kitchen_items) && !empty($booking->booking_detail->kitchen_items))
											<tr>
												<?php
													$kitchen_items = json_decode($booking->booking_detail->kitchen_items, true);
												?>
												<th class="pl-0">For a spotless kitchen we also recommend/add ?</th>
												<td>
													<p>Kitchen Extras</p>
													<ul class="list-group">
														@foreach($kitchen_items as $key => $kitchen_item)
															<li class="list-group-item">
																<i class="la la-stethoscope mr-1"></i>
																{{ getTitle($key) }}
																<span class="badge badge-secondary badge-pill float-right">{{ $kitchen_item }}</span>
															</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->kitchen_appliances) && !empty($booking->booking_detail->kitchen_appliances))
											<tr>
												<th class="pl-0">How would you like your kitchen cupboards and appliances to be cleaned ?</th>
												<?php
													$kitchen_appliances = str_replace('-', ' ', $booking->booking_detail->kitchen_appliances); 
												?>
												<td>{{ ucwords($kitchen_appliances) }}</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->cleaning_schedule) && !empty($booking->booking_detail->cleaning_schedule))
											<tr>
												<th class="pl-0">How often would you like the service ?</th>
												<td>{{ ucfirst($booking->booking_detail->cleaning_schedule) }}</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->pets) && !empty($booking->booking_detail->pets))
											<tr>
												<th class="pl-0">Do you have any pets ?</th>
												<td>{{ ucfirst($booking->booking_detail->pets) }}</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->iron) && !empty($booking->booking_detail->iron))
											<tr>
												<th class="pl-0">Do you require any irnoning ?</th>
												<td>{{ ucfirst($booking->booking_detail->iron) }}</td>
											</tr>
											@endif
											@if(isset($booking->booking_detail->office_rooms) && !empty($booking->booking_detail->office_rooms))
											<tr>
												<?php
													$office_rooms = json_decode($booking->booking_detail->office_rooms, true);
												?>
												<th class="pl-0">Which of the following apply to your office ?</th>
												<td>
													<ul class="list-group">
														@foreach($office_rooms as $key => $office)
															<li class="list-group-item">
																<i class="la la-building mr-1"></i>
																{{ getTitle($key) }}
																<span class="badge badge-secondary badge-pill float-right">{{ $office }}</span>
															</li>
														@endforeach
													</ul>
												</td>
											</tr>
											@endif

											@if(isset($booking->additional_notes) && !empty($booking->additional_notes))
											<tr>
												<?php
													$additional_notes = json_decode($booking->additional_notes, true);
												?>
												<th class="pl-0">Additional Information ?</th>
												<td>{!! $booking->additional_notes !!}</td>
											</tr>
											@endif
										</tbody>
									</table>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@section('script')
<script>

	$(document).ready(function() {
		$('form').submit(function(){
			if(confirm('Are you sure you want to change booking status?'))
			{ 
				return true;
			}else{
				return false;
			} 
		});
	});

</script>
@endsection