@extends('layouts.admin')

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Items Prices</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Settings</a></li>
            		<li class="breadcrumb-item active">Items Prices</li>
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

@if (count($errors) > 0)
  	<div class="row">
      	<div class="col-md-12">
          	<div class="alert alert-danger alert-dismissible">
              	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              	<b><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Alert!</b>
              	<ul>
              	@foreach ($errors->all() as $error)
                  	<li>{{ $error }}</li>
              	@endforeach
              	</ul>
          	</div>
      	</div>
  	</div>
  	<script>

    	$(document).ready(function(){
        	setTimeout(function(){ toastr.error('You must fill in all of the required fields!', 'Vista Network Says', {"hideDuration": 500, positionClass: 'toast-top-right'}); }, 2000);
    	});

  	</script>
@endif

<div class="content-body">
	<section class="row">
	    <div class="col-12">
	      	<div class="card">
	        	<div class="card-header">
	          		<h4 class="card-title">Prices List</h4>
	          		<a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
	        	</div>
	        	<div class="card-content">
	          		<div class="card-body">
	            	<!-- Task List table -->
	            		<div class="table-responsive">
	              			<table id="service_table" class="table table-white-space table-bordered table-middle">
		                		<thead>
			                  		<tr>
			                    		<th class="text-center" style="width: 10%;">#</th>
			                    		<th style="width: 60%;">Item</th>
			                    		<th class="text-center" style="width: 20%;">Price</th>
			                    		<th class="text-center" style="width: 10%;">Update</th>
			                  		</tr>
		               	 		</thead>
		                		<tbody>
		                			@foreach($prices as $key => $price)
			                			<form method="post" action="{{ route('admin.items_prices.update', $price->id) }}">
			                				@csrf
			                				@method('put')
				                			<?php
				                				if($price->id == 65)
				                					continue;
				                			?>
				                			<tr>
				                				<td class="text-center">{{ $key + 1 }}</td>
				                				<td>
				                					<a href="javascript:;">
				                							{{ $price->item->title }}
				                						<span class="text-bold-600 d-block">
				                						{{ $price->title }} x 1
				                						</span>
				                					</a>
				                				</td>
				                				<td class="text-center">
				                					<div class="position-relative has-icon-left">
				                        				<input class="form-control" name="item_price" type="number" value="{{ $price->price }}">
				                        				<div class="form-control-position">
				                        					<i class="la la-gbp"></i>
				                        				</div>
				                        			</div>
				                				</td>
				                				<td class="text-center">
				                					<button type="submit" class="btn btn-info">Update</button>
				                				</td>
				                			</tr>
			                			</form>
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
