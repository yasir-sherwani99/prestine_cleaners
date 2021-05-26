@extends('layouts.admin')

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Services</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Settings</a></li>
            		<li class="breadcrumb-item active">Services</li>
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
	          		<h4 class="card-title">Services List</h4>
	          		<a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
	        	</div>
	        	<div class="card-content">
	          		<div class="card-body">
	            	<!-- Task List table -->
	            		<div class="table-responsive">
	              			<table id="service_table" class="table table-white-space table-bordered table-middle">
		                		<thead>
			                  		<tr>
			                    		<th>#</th>
			                    		<th>Service</th>
			                    		<th class="text-center">Status</th>
			                    		<th class="text-center">Actions</th>
			                  		</tr>
		               	 		</thead>
		                		<tbody>
		                			@foreach($services as $key => $service)
		                			<tr>
		                				<td>{{ $key + 1 }}</td>
		                				<td class="w-75"><a href="#">{{ $service->title }}</a></td>
		                				<td class="text-center">
		                					@if($service->is_active == 1)
			    								<span class="badge badge-success bg-success round px-1 font-small-3">Active</span>
											@else
			    								<span class="badge badge-danger bg-danger bg-darken-4 round px-1 font-small-3">Inactive</span>
											@endif
		                				</td>
		                				<td class="text-center">
		                					<span class="dropdown">
                          						<button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-info btn-sm dropdown-toggle"><i class="la la-cog"></i></button>
                          						<span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
                            						<a href="#" class="dropdown-item"><i class="ft-edit"></i> Edit Service</a>
                          						</span>
                        					</span>
		                				</td>
		                			</tr>
		                			@endforeach
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
