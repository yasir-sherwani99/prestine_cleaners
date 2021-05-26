@extends('layouts.admin')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/extensions/rowReorder.dataTables.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/extensions/responsive.dataTables.min.css') }}">
@endsection

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Messages</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Messages</a></li>
            		<li class="breadcrumb-item active">Messages List</li>
          		</ol>
        	</div>
      	</div>
    </div>
</div>

<div class="content-body">
	<section class="row">
	    <div class="col-12">
	      	<div class="card">
	        	<div class="card-header">
	          		<h4 class="card-title">Customer Messages</h4>
	          		<a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
	        	</div>
	        	<div class="card-content">
	          		<div class="card-body">
	            		<div class="table-responsive">
	              			<table id="messages_table" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
	                			<thead>
				                  	<tr>
				                    	<th class="border-top-0 text-center">#</th>
				                    	<th class="border-top-0 w-75">Customer Details</th>
				                    	<th class="border-top-0">Status</th>
				                    	<th class="border-top-0 text-left">Action</th>
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
  			$('#messages_table').DataTable({
		        "aoColumnDefs": [{"bSortable": false, "aTargets": [0,3]}],
		        "bProcessing": true,
		        "bServerSide": true,
		        "aaSorting": [[0, "desc"]],
		        "sPaginationType": "full_numbers",
		        "sAjaxSource": "{{ url('admin_panel/getMessagesList') }}",
		        "aLengthMenu": [[25, 50, 100, 500], [25, 50, 100, 500]]
		    });
		});
  	</script>

@endsection