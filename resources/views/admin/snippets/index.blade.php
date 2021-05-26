@extends('layouts.admin')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/extensions/rowReorder.dataTables.min.css') }}">
  	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/tables/extensions/responsive.dataTables.min.css') }}">
@endsection

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Snippets</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Settings</a></li>
            		<li class="breadcrumb-item active">Snippets</li>
          		</ol>
        	</div>
      	</div>
    </div>
    <div class="content-header-right col-md-4 col-12">
      	<a class="btn btn-danger box-shadow-2 btn-glow round btn-min-width pull-right text-bold-600" href="{{ route('admin.snippet.create') }}">Add New Snippet</a>
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

@if(session()->has('alert'))
<div class="alert alert-icon-left alert-arrow-left alert-danger alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="la la-thumbs-o-down text-bold-600"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
    </button>
    <strong>Oh Snap!</strong> <span class="text-bold-600">{{ session()->get('alert') }}</span>
</div>
<script>

    $(document).ready(function(){
        setTimeout(function(){ toastr.error("{{ session()->get('alert') }}", 'Prestine System Says', {"hideDuration": 500, positionClass: 'toast-top-right'}); }, 2000);
    });

</script>
@endif

<div class="content-body">
	<section class="row">
	    <div class="col-md-12 col-12">
	      	<div class="card">
	        	<div class="card-header">
	          		<h4 class="card-title">Snippets</h4>
	          		<a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
	        	</div>
	        	<div class="card-content">
	          		<div class="card-body">
	          			<div class="table-responsive">
	              			<table id="snippet_table" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
	                			<thead>
				                  	<tr>
				                    	<th class="border-top-0 text-center">#</th>
				                    	<th class="border-top-0 w-75">Name</th>
				                    	<th class="border-top-0">Location</th>
				                    	<th class="border-top-0 text-center">Active</th>
				                    	<th class="border-top-0 text-center">Action</th>
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
  			$('#snippet_table').DataTable({
		        "aoColumnDefs": [{"bSortable": false, "aTargets": [0,4]}],
		        "bProcessing": true,
		        "bServerSide": true,
		        "aaSorting": [[0, "desc"]],
		        "sPaginationType": "full_numbers",
		        "sAjaxSource": "{{ url('admin_panel/getSnippets') }}",
		        "aLengthMenu": [[25, 50, 100, 500], [25, 50, 100, 500]]
		    });
		});
  	</script>
@endsection



