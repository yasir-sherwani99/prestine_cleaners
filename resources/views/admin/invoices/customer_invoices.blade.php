@extends('layouts.admin')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/extensions/rowReorder.dataTables.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/extensions/responsive.dataTables.min.css') }}">
@endsection

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Customer Invoices</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Invoices</a></li>
            		<li class="breadcrumb-item active">Customer Invoices</li>
          		</ol>
        	</div>
      	</div>
    </div>
</div>

@if(session()->has('success'))
<div class="alert alert-icon-left alert-arrow-left alert-success alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="la la-thumbs-o-up text-bold-600"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
    </button>
    <strong>Well done!</strong> <span class="text-bold-600">{{ session()->get('success') }}</span>
</div>
<script>

    $(document).ready(function(){
        setTimeout(function(){ toastr.success("{{ session()->get('success') }}", 'Prestine System Says', {"hideDuration": 500, positionClass: 'toast-top-right'}); }, 2000);
    });

</script>
@endif

<div class="content-body">
	<section class="row">
	    <div class="col-12">
	      	<div class="card">
	        	<div class="card-header">
	          		<h4 class="card-title">Customer Details</h4>
	          		<div class="row mt-1">
	          			<div class="col-12 col-md-6">
		          			<ul class="list-unstyled">
		          				<li class="text-bold-600">{{ $data['name'] }}</li>
		          				<li>{{ $data['email'] }}</li>
		          				<li>{{ $data['phone'] }}</li>
		          			</ul>
		          		</div>
		          		<div class="col-12 col-md-6 text-right">
		          			<ul class="list-unstyled">
		          				@if($data['address'] == "") 
		          					<li><i class="la la-map-marker"></i>&nbsp;Address Not Available</li>
		          				@else
		          					<li><i class="la la-map-marker"></i>&nbsp;{{ $data['address'] }}</li>
		          					<li>{{ $data['city'] }} - {{ $data['post_code'] }}</li>
		          				@endif
		          			</ul>
		          		</div>
	          		</div>
	          		<a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
	        	</div>
	        	<div class="card-header border-bottom border-light">
	          		<h4 class="card-title">Invoices</h4>
	          	</div>
	        	<div class="card-content">
	          		<div class="card-body">
	            	<!-- Booking List table -->
	            		<div class="table-responsive">
	              			<table id="invoice_table" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
		                		<thead>
			                  		<tr>
			                  			<th>Date</th>
			                    		<th>#INV</th>
			                    		<th>Title</th>
			                    		<th>Due</th>
			                    		<th>Amount</th>
			                    		<th>Deliver</th>
			                    		<th class="text-center">Actions</th>
			                  		</tr>
		               	 		</thead>
		                		<tbody>
		                			
		                		</tbody>
	              			</table>
	            		</div>
	          		</div>
	        	</div>
	      	</div>
	    </div>
	</section>
</div>

@endsection

@section('script')
	<script src="{{ asset('admin-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('admin-assets/vendors/js/tables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('admin-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('admin-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('admin-assets/vendors/js/tables/datatable/dataTables.rowReorder.min.js') }}" type="text/javascript"></script>
  	<script>
  		$(document).ready(function() {
  			$('#invoice_table').DataTable({
		        "aoColumnDefs": [{"bSortable": false, "aTargets": [0,6]}],
		        "bProcessing": true,
		        "bServerSide": true,
		        "aaSorting": [[0, "desc"]],
		        "sPaginationType": "full_numbers",
		        "sAjaxSource": "{{ url('admin_panel/getCustomerInvoicesList/' . $data['user_id']) }}",
		        "aLengthMenu": [[25, 50, 100, 500], [25, 50, 100, 500]]
		    });
		});
  	</script>

@endsection