@extends('layouts.master')

@section('content')

	@include('layouts.inc.partials._banner2')

	<!-- Start Main Content Area -->
    <section class="cleaning-content-block" style="background-color: #f2f3f8 !important;">
        <div class="container">
        	<div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>Price List</h2>
                        <p>Checkout the price list of different services that we offer.</p>
                    </div>
                </div>
            </div>
        	<div class="product-details-area">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-xl-4">
                        <!-- required for floating -->
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tabs-left p-0">
                            <li class="nav-item border">
                                <a class="active" href="#end_of_tenancy" data-toggle="tab">
                        			<span><i class="flaticon-right-arrow mr-3"></i>End of Tenancy Cleaning</span>
                            	</a>
                            </li>
                            <li class="nav-item border">
                                <a href="#carpet_cleaning" data-toggle="tab">
                                	<span><i class="flaticon-right-arrow mr-3"></i>Carpet Cleaning</span>
                                </a>
                            </li>
                            <li class="nav-item border">
                                <a href="#upholstery_cleaning" data-toggle="tab">
                                	<span><i class="flaticon-right-arrow mr-3"></i>Upholstery Cleaning</span>
                            	</a>
                            </li>
                            <li class="nav-item border">
                                <a href="#window_cleaning" data-toggle="tab">
                                	<span><i class="flaticon-right-arrow mr-3"></i>Window Cleaning</span>
                                </a>
                            </li>
                            <li class="nav-item border">
                                <a href="#oven_cleaning" data-toggle="tab">
                                	<span><i class="flaticon-right-arrow mr-3"></i>Oven Cleaning</span>
                                </a>
                            </li>
                            <li class="nav-item border">
                                <a href="#one_off_cleaning" data-toggle="tab">
                                	<span><i class="flaticon-right-arrow mr-3"></i>One Off Cleaning</span>
                                </a>
                            </li>
                            <li class="nav-item border">
                                <a href="#office_cleaning" data-toggle="tab">
                                	<span><i class="flaticon-right-arrow mr-3"></i>Office Cleaning</span>
                                </a>
                            </li>
                            <li class="nav-item border">
                                <a href="#after_builders_cleaning" data-toggle="tab">
                                	<span><i class="flaticon-right-arrow mr-3"></i>After Builders Cleaning</span>
                                </a>
                            </li>
                            <li class="nav-item border">
                                <a href="#mattress_cleaning" data-toggle="tab">
                                	<span><i class="flaticon-right-arrow mr-3"></i>Mattress Cleaning</span>
                                </a>
                            </li>
                            <li class="nav-item border">
                                <a href="#sofa_cleaning" data-toggle="tab">
                                	<span><i class="flaticon-right-arrow mr-3"></i>Sofa Cleaning</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8 col-lg-8 col-xl-8">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="end_of_tenancy">
                                <h3>End of Tenancy Cleaning</h3>
                                <p>
                                	Our end of lease service is a thorough cleaning of your rental property, designed to meet the highest standards, help you pass the final inspection, and get your deposit money back.
                                </p>
	                            <div class="table-responsive">
	                                <table class="table table-sm table-hover">
		                                <tbody>
		                                	<tr>
		                                		<th colspan="4" class="p-2 bg-light">House/Flat</th>
		                                	</tr>
		                                	@foreach($prices as $price)
		                                		@if($price->item_id == 16 || $price->item_id == 1)
				                                	<?php
				                                		if($price->id == 65)
				                						continue;
				                                	?>
				                                	<tr>
				                                		<td style="width: 35%;">{{ $price->title }}</td>
				                                		<td style="width: 20%;">x 1</td>
				                                		<td style="width: 30%;" class="text-right">&pound; {{ $price->price }}</td>
				                                		<td style="width: 15%;">&nbsp;</td>
				                                	</tr>
				                                @endif
		                                	@endforeach
		                                	<tr>
		                                		<th colspan="4" class="p-2 bg-light">House Interior</th>
		                                	</tr>
		                                	@foreach($prices as $price)
		                                		@if($price->item_id == 10)
				                                	<tr>
				                                		<td>{{ $price->title }}</td>
				                                		<td>x 1</td>
				                                		<td class="text-right">&pound; {{ $price->price }}</td>
				                                		<td>&nbsp;</td>
				                                	</tr>
				                                @endif
		                                	@endforeach
		                                	<tr>
		                                		<th colspan="4" class="p-2 bg-light">House Exterior</th>
		                                	</tr>
		                                	@foreach($prices as $price)
		                                		@if($price->item_id == 11)
				                                	<tr>
				                                		<td>{{ $price->title }}</td>
				                                		<td>x 1</td>
				                                		<td class="text-right">&pound; {{ $price->price }}</td>
				                                		<td>&nbsp;</td>
				                                	</tr>
				                                @endif
		                                	@endforeach
		                                </tbody>
	                                </table>
	                            </div>
	                            <p>
                            		<b>*</b> All Cleaning Materials and Equipment are included in the price.
                            	</p>
                            </div>
                            <div class="tab-pane" id="carpet_cleaning">
                                <h3>Carpet Cleaning</h3>
                                <p>
                                	A Schedule care and maintenance program of regular vacuuming and professional carpet cleaning will ensure your carpet remain functional and aesthetically pleasing for longer. Prestine Professionals are available 7 days a week including bank holidays at no extra cost.
                                </p>
                                <div class="table-responsive">
	                                <table class="table table-sm table-hover">
		                                <tbody>
		                                	<tr>
		                                		<th colspan="4" class="p-2 bg-light">Carpet</th>
		                                	</tr>
		                                	@foreach($prices as $price)
		                                		@if($price->item_id == 2)
				                                	<tr>
				                                		<td style="width: 35%;">{{ $price->title }}</td>
				                                		<td style="width: 20%;">x 1</td>
				                                		<td style="width: 30%;" class="text-right">&pound; {{ $price->price }}</td>
				                                		<td style="width: 15%;">&nbsp;</td>
				                                	</tr>
				                                @endif
		                                	@endforeach
		                                	<tr>
		                                		<th colspan="4" class="p-2 bg-light">Rugs</th>
		                                	</tr>
		                                	@foreach($prices as $price)
		                                		@if($price->item_id == 3)
				                                	<tr>
				                                		<td>{{ $price->title }}</td>
				                                		<td>x 1</td>
				                                		<td class="text-right">&pound; {{ $price->price }}</td>
				                                		<td>&nbsp;</td>
				                                	</tr>
				                                @endif
		                                	@endforeach
		                                </tbody>
	                                </table>
	                            </div>
	                            <p>
                            		<b>*</b> All Cleaning Materials and Equipment are included in the price.
                            	</p>
                            </div>
                            
                            <div class="tab-pane" id="upholstery_cleaning">
                                <h3>Upholstery Cleaning</h3>
                                <p>Let us bring back the shine to your upholstery. Having a flexible schedule local teams can visit you at a time and place that suits you.</p>
                                <div class="table-responsive">
	                                <table class="table table-sm table-hover">
	                                	<tr>
	                                		<th colspan="4" class="p-2 bg-light">Upholstery</th>
	                                	</tr>
	                                	@foreach($prices as $price)
	                                		@if($price->item_id == 4)
			                                	<tr>
			                                		<td>{{ $price->title }}</td>
			                                		<td>x 1</td>
			                                		<td class="text-right">&pound; {{ $price->price }}</td>
			                                		<td>&nbsp;</td>
			                                	</tr>
			                                @endif
	                                	@endforeach
	                                </table>
	                            </div>
                                <p>
                                	<u>Note:</u> Estimate and all costs depends on on-site inspection. 
                                </p>
	                            <p>
	                            	<b>*</b> All Cleaning Materials and Equipment are included in the price.
	                            </p>
	                            
                            </div>
                            
                            <div class="tab-pane" id="window_cleaning">
                                <h3>Window Cleaning</h3>
                            	<p>    
                            		Window cleaning, or window washing, is the exterior cleaning of architectural glass used for structural, lighting, or decorative purposes. It can be done manually, using a variety of tools for cleaning and access. 
	                       		</p>
	                       		<p>
                                	<u>Note:</u> Estimate and all costs depends on on-site inspection. 
                                </p>
                            	<p>
                            		<b>*</b> All Cleaning Materials and Equipment are included in the price.
                            	</p>
	                          
                            </div>
                            <div class="tab-pane" id="oven_cleaning">
                                <h3>Oven Cleaning</h3>
                                <p>
                                	One of the biggest challenges of running a busy restaurant is keeping the kitchen clean. With a multitude of activities happening all the time, regular cleaning can seem overwhelming if you don’t have a system in place.
                                </p>
                                <p>
                                	<u>Note:</u> Estimate and all costs depends on on-site inspection. 
                                </p>
                            	<p>
                            		<b>*</b> All Cleaning Materials and Equipment are included in the price.
                            	</p>
                            </div>
                            <div class="tab-pane" id="one_off_cleaning">
                                <h3>One Off Cleaning</h3>
                            	<p>
                            		Our One-off service is a deep cleaning of your home, commercial, or event. The Prestine Cleaning team can bring cleaning solutions and equipment. 
                            	</p>
                            	<p>
                                	<u>Note:</u> Estimate and all costs depends on on-site inspection. 
                                </p>
                            	<p>
                            		<b>*</b> All Cleaning Materials and Equipment are included in the price.
                            	</p>
                            </div>
                            <div class="tab-pane" id="office_cleaning">
                                <h3>Office Cleaning</h3>
                            	<p>
                            		We know that a clean, tidy office environment helps companies to be more productive and indicates to everyone than your company is proud and professional in everything it does. 
                            	</p>
                            	<p>
                                	<u>Note:</u> Estimate and all costs depends on on-site inspection. 
                                </p>
                            	<p>
                            		<b>*</b> All Cleaning Materials and Equipment are included in the price.
                            	</p>
                            </div>
                            <div class="tab-pane" id="after_builders_cleaning">
                                <h3>After Builders Cleaning</h3>
                            	<p>
                            		Building work is never clean- dust, dirt and debris can be generated by even the smallest of jobs and an extensive project often means it’s time to call the experts. 
                            	</p>
                            	<p>
                                	<u>Note:</u> Estimate and all costs depends on on-site inspection. 
                                </p>
                            	<p>
                            		<b>*</b> All Cleaning Materials and Equipment are included in the price.
                            	</p>
                            </div>
                            <div class="tab-pane" id="mattress_cleaning">
                                <h3>Mattress Cleaning</h3>
                            	<p>
                            		We provides mattress cleaning for your residential or commercial property. Our technicians use safe but efficient solutions and powerful equipment to remove dirt, dust, and bacteria from your bedding. 
                            	</p>
                            	<p>
                                	<u>Note:</u> Estimate and all costs depends on on-site inspection. 
                                </p>
                            	<p>
                            		<b>*</b> All Cleaning Materials and Equipment are included in the price.
                            	</p>
                            </div>
                            <div class="tab-pane" id="sofa_cleaning">
                                <h3>Sofa Cleaning</h3>
                            	<p>
                            		We provides professional treatment for your sofas. Our technicians are trained enough to clean all types of dirt, dust, and stains even from delicate drapes made from silk, lace, or velvet.   
                            	</p>
                            	<p>
                                	<u>Note:</u> Estimate and all costs depends on on-site inspection. 
                                </p>
                            	<p>
                            		<b>*</b> All Cleaning Materials and Equipment are included in the price.
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
     </section>

@endsection