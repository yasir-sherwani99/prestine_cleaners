<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Prestine Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
    rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/vendors.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/app.css') }}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <style>
    	html {
		  	font-size: 14px;
		  	height: 100%; 
		}
  		html body {
    		height: 100%;
    		background-color: #F4F5FA;
    		direction: ltr; 
    	}
    	html body .content {
	      	padding: 0;
	      	position: relative;
	      	transition: 300ms ease all;
	      	backface-visibility: hidden;
	      	min-height: calc(100% - 32px); 
	    }
      	html body .content.app-content {
        	overflow: hidden; 
        }
      	html body .content .content-wrapper {
        	padding: 2.2rem; 
    	}
        html body .content .content-wrapper .content-header-title {
          	font-weight: 500;
          	letter-spacing: 1px;
          	color: #464855; 
      	}
      	.row {
		  	display: flex;
		  	flex-wrap: wrap;
		  	margin-right: -15px;
		  	margin-left: -15px; 
		}
   		.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
		  	position: relative;
		  	width: 100%;
		  	min-height: 1px;
		  	padding-right: 15px;
		  	padding-left: 15px; 
		}
		.col-md {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%; }
  .col-md-auto {
    flex: 0 0 auto;
    width: auto;
    max-width: none; }
  .col-md-1 {
    flex: 0 0 8.333333%;
    max-width: 8.333333%; }
  .col-md-2 {
    flex: 0 0 16.666667%;
    max-width: 16.666667%; }
  .col-md-3 {
    flex: 0 0 25%;
    max-width: 25%; }
  .col-md-4 {
    flex: 0 0 33.333333%;
    max-width: 33.333333%; }
  .col-md-5 {
    flex: 0 0 41.666667%;
    max-width: 41.666667%; }
  .col-md-6 {
    flex: 0 0 50%;
    max-width: 50%; }
  .col-md-7 {
    flex: 0 0 58.333333%;
    max-width: 58.333333%; }
  .col-md-8 {
    flex: 0 0 66.666667%;
    max-width: 66.666667%; }
  .col-md-9 {
    flex: 0 0 75%;
    max-width: 75%; }
  .col-md-10 {
    flex: 0 0 83.333333%;
    max-width: 83.333333%; }
  .col-md-11 {
    flex: 0 0 91.666667%;
    max-width: 91.666667%; }
  .col-md-12 {
    flex: 0 0 100%;
    max-width: 100%; }
  		.card {
		  	position: relative;
		  	display: flex;
		  	flex-direction: column;
		  	min-width: 0;
		  	word-wrap: break-word;
		  	background-color: #fff;
		  	background-clip: border-box;
		  	border: 1px solid rgba(0, 0, 0, 0.06);
		  	border-radius: 0.35rem; 
		}
  	.card-body {
  		flex: 1 1 auto;
  		padding: 1.5rem; 
  	}


  .mt-5 {
  margin-top: 4rem !important; }

  .table {
    border-collapse: collapse !important; }
    .table td,
    .table th {
      background-color: #fff !important; }
    .table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 1rem;
  background-color: transparent; }
  .table th,
  .table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #626E82; }
  .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #626E82; }
  .table tbody + tbody {
    border-top: 2px solid #626E82; }
  .table .table {
    background-color: #F9FAFD; }

    .text-left {
  text-align: left !important; }

.text-right {
  text-align: right !important; }

.text-center {
  text-align: center !important; }
  .lead {
  font-size: 1.25rem;
  font-weight: 400; }

  .w-25 {
  width: 25% !important; }

.w-50 {
  width: 50% !important; }

.w-75 {
  width: 75% !important; }
.w-100 {
  width: 100% !important; }

    </style>
</head>

<body>
	<div class="app-content content">
    	<div class="content-wrapper">
			<div class="content-body">
				<section class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
				    			<div id="invoice-company-details" class="row">
						            <div class="col-md-9" style="text-align: left;">
						                <div style="display: flex; align-items: flex-start;">
						                  	<div style="flex: 1;">
						                    	<ul style="padding-right: 0; padding-left: 0; list-style: none;">
						                      		<li>Prestine Cleaners</li>
							                      	<li>18 King Edward Street,</li>
							                      	<li>Slough SL1 2QS,</li>
							                      	<li>UK</li>
						                    	</ul>
						                  	</div>
						                </div>
						            </div>
						            <div class="col-md-3" style="text-align: left;">
						                <h2>INVOICE</h2>
					                	<p style="padding-bottom: 3rem;"># {{ $invoice->invoice_no }}</p>
						            </div>
						        </div>
						        <div id="invoice-customer-details" class="row">
						          
						            <div class="col-md-6" style="text-align: left; padding-top: 3rem;">
					                	<p>Bill To</p>
						            	<div class="col-md-6" style="text-align: left;">
							                <ul class="list-unstyled">
							                  	<li>Mr/Ms. {{ $invoice->user->name }}</li>
							                  	<li>{{ $invoice->user->email }}</li>
							                  	<li>{{ $invoice->user->phone }},</li>
							                  	<li>{{ $invoice->user->post_code }}.</li>
							                </ul>
							            </div>
						            </div>
						            <div class="col-md-6" style="text-align: right;">
						                <p>
						                  	<span>Invoice Date :</span> {{ $invoice->invoice_date }}
							            </p>
						                <p>
						                	<span>Payment Terms :</span> {{ $invoice->terms }}
							            </p>
						                <p>
						                  	<span>Due Date :</span> {{ $invoice->due_date }}
						                </p>
						            </div>
						        </div>
						        <div id="invoice-items-details" style="padding-top: 2rem">
			              			<div class="row">
			              				<div class="col-md-12 col-12">
				                		
				                  				<table class="table" id="itemTable">
								                    <thead>
								                      	<tr>
								                      		<th>#</th>
								                        	<th style="width: 50%;">Item & Description</th>
								                        	<th class="text-center" style="width: 15%;">Quantity</th>
								                        	<th class="text-right" style="width: 15%;">Rate</th>
								                        	<th class="text-right" style="width: 15%;">Amount</th>
								                      	</tr>
								                    </thead>
					                    			<tbody>
					                    				@foreach($invoice->invoice_items as $key => $item)
							                      		<tr class="itemrow">
									                        <td>{{ $key + 1 }}</td>
									                        <td>
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
				              		<div class="row mt-5">
						                <div class="col-md-7 col-12" style="text-align: left;">
						                	<p>Notes</p>
							                <p>{{ $invoice->additional_notes }}</p>
						                </div>
						                <div class="col-md-5 col-12">
						                  	<p class="lead">Total due</p>
						                  	
						                    	<table class="table">
						                      		<tbody>
								                        <tr>
								                          	<td class="w-50">Sub Total</td>
								                          	<td class="text-right w-50">
								                          		&pound; <span id="subtotal">{{ $invoice->sub_total }}</span>
								                          	</td>
								                        </tr>
								                        <tr>
								                          	<td>TAX</td>
								                          	<td class="text-right">
												                &pound; <span>{{ $invoice->tax }}</span>	
								                          	</td>
								                        </tr>
								                        <tr>
								                          	<td>Discount</td>
								                          	<td class="text-right">
								                         		&pound; <span>{{ $invoice->discount }}</span>	
								                          	</td>
								                        </tr>
								                        <tr>
								                          	<td class="text-bold-800">Total</td>
								                          	<td class="text-bold-800 text-right"> 
								                          		&pound; <span id="grand_total">{{ $invoice->total }}</span>
								                          	</td>
								                        </tr>
						                      		</tbody>
						                    	</table>
						                  	
						                  	<div class="text-center">
						                    	<p>Authorized person</p>
						                    	<h6>Yasir Mehmood</h6>
						                    	<p>Managing Director</p>
						                  	</div>
						                </div>
						            </div>
						        </div>
						        <!-- Invoice Footer -->
					            <div id="invoice-footer">
					              	<div class="row">
					                	<div class="col-md-7 col-12">
					                  		<h6>Terms & Condition</h6>
					                  		<p>All payments made to Company after completion of work. Company can ask for 50% deposit by bank transfer or paid in cash.</p>
					                	</div>
					                	<div class="col-md-5 col-12 text-center">
					                		
					                	</div>
					              	</div>
					            </div>
			            		<!--/ Invoice Footer -->
						    </div>	
						</div>
					</div>
			  	</section> 
			</div>
		</div>
	</div>
</body>
