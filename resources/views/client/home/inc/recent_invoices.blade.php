<div class="dashboard-list-box invoices with-icons margin-top-20">
	<h4>Recent Invoices</h4>
	<ul>
		@if(!$recent_invoices->isEmpty())
			@foreach($recent_invoices as $invoice)
			<li>
				<i class="list-box-icon sl sl-icon-doc"></i>
				<strong>{{ $invoice->title }}</strong>
				<ul>
					<li>INV: # {{ $invoice->invoice_no }}</li>
					<li>Due: {{ date('d F, Y', strtotime($invoice->due_date)) }}</li>
				</ul>
				<div class="buttons-to-right">
					<a href="{{ route('invoice.view', $invoice->invoice_no) }}" class="button gray">View Invoice</a>
				</div>
			</li>
			@endforeach
		@else
			<li>
				<i class="list-box-icon sl sl-icon-doc"></i>
				<strong>There is no invoices to show here ..</strong>
			</li>
		@endif
	</ul>
</div>