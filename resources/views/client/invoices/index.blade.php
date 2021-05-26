@extends('layouts.app')

@section('content')

<!-- Titlebar -->
<div id="titlebar">
	<div class="row">
		<div class="col-md-12">
			<h2>Invoices</h2>
			<!-- Breadcrumbs -->
			<nav id="breadcrumbs">
				<ul>
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{ route('home') }}">Dashboard</a></li>
					<li>Invoices</li>
				</ul>
			</nav>
		</div>
	</div>
</div>

<div class="row padding-top-20" style="background-color: #ffffff;">
			
	<!-- Listings -->
	<div class="col-lg-12 col-md-12">
		<h4 class="headline margin-bottom-30">Invoices List</h4>	
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Date</th>
					<th>Invoice #</th>
					<th>Title</th>
					<th>Due</th>
					<th>Amount</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody style="background-color: #ffffff;">
				@if(!$invoices->isEmpty())
					@foreach($invoices as $key => $invoice)
					<tr>
						<td data-label="Serial">{{ $key + 1 }}</td>
						<td data-label="Date">{{ date('d/m/Y', strtotime($invoice->invoice_date)) }}</td>
						<td data-label="Invoice"><a href="{{ route('invoice.view', $invoice->invoice_no) }}"><u>{{ $invoice->invoice_no }}</u></a></td>
						<td data-label="Customer">{{ $invoice->title }}</td>
						<td data-label="Due">{{ date('d/m/Y', strtotime($invoice->due_date)) }}</td>
						<td data-label="Total"><strong>&pound; {{ $invoice->total }}</strong></td>
						<td data-label="View" class="text-center">
							<a href="{{ route('invoice.view', $invoice->invoice_no) }}" title="view invoice">
								<i class="fa fa-eye"></i>
							</a>
						</td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="7">There is no item to show here ...</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>

@endsection