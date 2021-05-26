@extends('layouts.admin')

@section('content')

<div class="content-body">
	<section>
		<div class="row">
			<div class="col-12 col-md-12">
				<div class="card">
					<div class="card-body">
	    				<div id="invoice-company-details">
	    					<div class="row">
			            		<div class="col-md-9 col-12 text-center text-md-left">
					                <div class="media">
					                  	<div class="media-body">
					                    	<ul class="px-0 list-unstyled">
					                      		<li class="text-bold-800">Prestine Cleaners</li>
						                      	<li>18 King Edward Street,</li>
						                      	<li>Slough SL1 2QS</li>
					                    	</ul>
					                  	</div>
					                </div>
			            		</div>
			            		<div class="col-md-3 col-12 text-center text-md-right">
			               	 		<h2>INVOICE</h2>
		                			<p class="pb-3"># {{ $invoice->invoice_no }}</p>
			            		</div>
			            	</div>
			            </div>
			        	<div id="invoice-customer-details">
			       			<div class="row">   
			            		<div class="col-md-6 col-12 text-center text-md-left">
		                			<p class="text-muted">Bill To</p>
			            			<div class="col-md-6 col-12 pl-0 text-center text-md-left">
				                		<ul class="list-unstyled">
				                  			<li class="text-bold-600">Mr/Ms. {{ $invoice->user->name }}</li>
				                  			<li>{{ $invoice->user->email }}</li>
				                  			<li>{{ $invoice->user->phone }}</li>
				                		</ul>
				              		</div>
				              	</div>
					            <div class="col-md-6 col-12 text-center text-md-right">
					                <ul class="list-unstyled">
				                  		<li><span class="text-bold-600">Invoice Date: </span>{{ $invoice->invoice_date }}</li>
				                  		<li><span class="text-bold-600">Payment Terms: </span>{{ $invoice->payment_terms }}</li>
				                  		<li><span class="text-bold-600">Due Date: </span>{{ $invoice->due_date }}</li>
				                  	</ul>
					            </div>
			        		</div>
			        	</div>
			        	<div id="invoice-items-details" class="my-5">
              				<div class="row">
              					<div class="col-md-12 col-12">
	                				<div class="table-responsive">
	                  					<table class="table" id="itemTable">
					                    	<thead>
					                      		<tr>
					                      			<th>#</th>
					                        		<th style="width: 50%;" class="pl-0">Item & Description</th>
					                        		<th class="text-center" style="width: 15%;">Quantity</th>
					                        		<th class="text-right" style="width: 15%;">Price</th>
					                        		<th class="text-right" style="width: 15%;">Amount</th>
					                      		</tr>
					                    	</thead>
		                    				<tbody>
		                    					@foreach($invoice->invoice_items as $key => $item)
				                      			<tr class="itemrow">
						                        	<td>{{ $key + 1 }}</td>
						                        	<td class="pl-0">
						                        		{{ $item->item_description }}
						                        	</td>
				                        			<td class="text-center">
				                        				{{ $item->quantity }}
				                        			</td>
				                        			<td class="text-right">
				                        				&pound; {{ $item->rate }}
				                        			</td>
				                        			<td class="text-right">
				                        				&pound; {{ $item->amount }}
				                        			</td>
				                      			</tr>
				                      			@endforeach
		                    				</tbody>
	                  					</table>
	                				</div>
	                			</div>
              				</div>
              			</div>
              			<div id="invoice-bill">
	              			<div class="row mt-5">
			                	<div class="col-md-7 col-12 text-center text-md-left">
			                		<p class="text-muted">Notes</p>
				                	<p>{{ $invoice->additional_notes }}</p>
			                	</div>
			                	<div class="col-md-5 col-12 text-md-right text-sm-center">
			                  		<p class="lead text-left">Total Due</p>
			                  		<div class="table-responsive">
			                    		<table class="table">
			                      			<tbody>
					                        	<tr>
					                          		<td class="w-50 pl-0 text-left">Sub Total</td>
					                          		<td class="text-right w-50">
					                          			&pound; <span id="subtotal">{{ $invoice->sub_total }}</span>
					                          		</td>
					                        	</tr>
					                        	<tr>
					                          		<td class="pl-0 align-middle text-left">TAX</td>
					                          		<td class="text-right">
									                	&pound; <span>{{ $invoice->tax }}</span>	
					                          		</td>
					                        	</tr>
					                        	<tr>
					                          		<td class="pl-0 align-middle text-left">Discount</td>
					                          		<td class="text-right">
					                         			&pound; <span>{{ $invoice->discount }}</span>	
					                          		</td>
					                        	</tr>
					                        	<tr>
					                          		<td class="pl-0 align-middle text-left lead">Total</td>
					                          		<td class="text-right lead"> 
					                          			&pound; <span id="grand_total">{{ $invoice->total }}</span>
					                          		</td>
					                        	</tr>
			                      			</tbody>
			                    		</table>
			                  		</div>
				                  	<!-- <div class="text-center">
				                    	<p>Authorized person</p>
				                    	<h6>Yasir Mehmood</h6>
				                    	<p class="text-muted">Managing Director</p>
				                  	</div> -->
			                	</div>
			            	</div>
			        	</div>
				        <!-- Invoice Footer -->
			            <div id="invoice-footer" class="mt-5">
			              	<div class="row">
			                	<div class="col-md-12 col-12">
			                  		<h6>Legal Terms</h6>
			                  		<p>Please note: Any payment made after its due date there will be 8% late payment fee charges will be applicable on daily basis.</p>
			                	</div>
			              	</div>
			            </div>
	            		<!--/ Invoice Footer -->
	            	</div>
			    </div>	
			</div>
		</div>
  	</section> 
</div>

@endsection

@section('script')
@endsection