<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Prestine - Invoice</title>
	<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
	<link rel="stylesheet" href="{{ asset('client-assets/css/invoice.css') }}">
</head> 

<body>

<!-- Print Button -->
<a href="javascript:window.print()" class="print-button">Print this invoice</a>

<!-- Invoice -->
<div id="invoice">

	<!-- Header -->
	<div class="row">
		<div class="col-md-6">
			<div id="logo"><img src="{{ asset('assets/img/logo/prestine_logo_2.png') }}" alt="Prestine Cleaners"></div>
			<p>
				Prestine Cleaners. <br>
				18 King Edward Street <br>
				Slough, SL1 2QS
			</p>
		</div>

		<div class="col-md-6">	

			<p id="details">
				<strong>Invoice:</strong> # {{ $invoice->invoice_no }} <br>
				<strong>Issued:</strong> {{ date('d/m/Y', strtotime($invoice->invoice_date)) }} <br>
				<strong>Due:</strong> {{ date('d/m/Y', strtotime($invoice->due_date)) }} <br>
				<strong>Payment Terms:</strong> {{ $invoice->payment_terms }}
			</p>
		</div>
	</div>


	<!-- Client & Supplier -->
	<div class="row">
		<div class="col-md-12">
			<h2>Invoice</h2>
		</div>

		<div class="col-md-6">	
			<strong class="margin-bottom-5">Bill To</strong>
			<p>
				Mr/Ms. {{ $invoice->user->name }} <br>
				{{ $invoice->user->email }} <br>
				{{ $invoice->user->phone }}
			</p>
		</div>
	</div>


	<!-- Invoice -->
	<div class="row">
		<div class="col-md-12">
			<table class="margin-top-20">
				<tr>
					<th>#</th>
					<th>Description</th>
					<th class="text-center">Quantity</th>
					<th class="text-right">Price</th>
					<th>Total</th>
				</tr>

				@foreach($invoice->invoice_items as $key => $item)
      			<tr>
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
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			@if(isset($invoice->additional_notes) || !empty($invoice->additional_notes))
				<strong class="margin-bottom-5">Notes</strong>
				<p>{{ $invoice->additional_notes }}</p>
			@endif
		</div>
		<div class="col-md-4">	
			<table id="totals">
				<tr>
					<th>Total Due</th> 
					<th></th>
				</tr>
				<tr>
					<td>Sub Total</td>
					<td>{{ $invoice->sub_total }}</td>
				</tr>
				<tr>
					<td>TAX/VAT</td>
					<td>{{ $invoice->tax }}</td>
				</tr>
				<tr>
					<td>Discount</td>
					<td>{{ $invoice->discount }}</td>
				</tr>
				<tr>
					<th>Total</th>
					<th><span>{{ $invoice->total }}</span></th>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<strong class="">Legal Terms</strong>
			<p style="padding-bottom: 0px;">Please note: Any payment made after its due date there will be 8% late payment fee charges will be applicable on daily basis.</p>
		</div>
	</div>
	<!-- Footer -->
	<div class="row">
		<div class="col-md-12 text-center">
			<ul id="footer">
				<li><span>www.prestinecleaners.co.uk</span></li>
				<li>info@prestinecleaners.co.uk</li>
				<li>07387 312 723</li>
			</ul>
		</div>
	</div>
		
</div>


</body>
</html>
