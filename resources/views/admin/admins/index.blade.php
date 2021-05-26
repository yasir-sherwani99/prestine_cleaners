@extends('layouts.admin')

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-9 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Admins List</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Settings</a></li>
            		<li class="breadcrumb-item active">Admins List</li>
          		</ol>
        	</div>
      	</div>
    </div>
    <div class="content-header-right col-md-3 col-12">
    	<a href="{{ route('admin.admins.create') }}">
      		<button class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right" type="button"> Add New Admin</button>
    	</a>
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
	<section id="simple-user-cards" class="row">
        <div class="col-12">
            <h4 class="text-uppercase">Admin Profiles</h4>
            <p>Manage system administrators.</p>
        </div>
		@foreach($admins as $admin)
	    <div class="col-xl-3 col-md-6 col-12">
	      	<div class="card">
	        	<div class="text-center">
	          		<div class="card-body">
	            		@if($admin->image == NULL)
	            			<img src="{{ asset('assets/img/admins/default-avatar.png') }}" alt="prestine admin avatar"><i></i>
	            		@else
	            			<img src="{{ asset('assets/img/admins/'.$admin->image) }}" alt="prestine admin avatar"><i></i>
	            		@endif
	          		</div>
	          		<div class="card-body">
	            		<h4 class="card-title">{{ $admin->name }}</h4>
	            		<ul class="list-inline list-inline-pipe">
	              			<li>
			                  	@if($admin->status == 1)
			                    	<span class="success darken-4">Active</span>
			                  	@else
			                    	<span class="danger darken-4">Inactive</span>
			                  	@endif
	              			</li>
	            		</ul>
	            		<h6 class="card-subtitle text-muted">{{ $admin->designation }}</h6>
	          		</div>
	          		<div class="card-body">
	            		<a href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}">
	              			<button type="button" class="btn btn-outline-info btn-md"><i class="ft-edit"></i> Edit Profile</button>
	            		</a>
	          		</div>
	        	</div>
	      	</div>
	    </div>
	    @endforeach	
	</section> 
</div>

@endsection