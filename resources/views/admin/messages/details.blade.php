@extends('layouts.admin')

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Messgages</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Messages</a></li>
            		<li class="breadcrumb-item active">Message Details</li>
          		</ol>
        	</div>
      	</div>
    </div>
</div>

<div class="content-body">
	<section class="card">
	    <div class="card-body">
	      	<!-- Message Details -->
	      	<div class="row">
	        	<div class="col-md-6 col-sm-12 text-center text-md-left">
	          
	        	</div>
	        	<div class="col-md-6 col-sm-12 text-center text-md-right">
	          		<h2>MESSAGES</h2>
	        	</div>
	      	</div>
	      	<div class="row pt-2">
	        	<div class="col-md-6 col-sm-6 text-center text-md-left">
		          	<p class="text-muted">From</p>
		          	<ul class="px-0 list-unstyled">
		            	<li class="text-bold-800">Mr/Ms. {{ $message->name }}</li>
		            	<li>{{ $message->email }}</li>
		            	<li>{{ $message->phone }}</li>
		          	</ul>
	        	</div>
	        	<div class="col-md-6 col-sm-6 text-right">
	        		@php
		              	$created_at = \Carbon\Carbon::parse($message->created_at);
		              	$message_date = $created_at->toFormattedDateString();
		          	@endphp
		          	<p>{{ $message_date }}</p>
	        	</div>
	      	</div>
	      	<div class="pt-2">
	        	<div class="row">
	          		<div class="col-md-12">
	            		<label class="text-bold-600">Subject:</label>
	            		{{ isset($message->subject) ? $message->subject : 'N/A' }}
	          		</div>
	        	</div>
	        	<br/>
	        	<div class="row">
	          		<div class="col-md-12">
	            		<label class="text-bold-600">Message:</label>
	            		<br/>
	            		{{ isset($message->message) ? $message->message : 'N/A' }}
	          		</div>
	        	</div>
	      	</div>
	    </div>
  	</section>
</div>

@endsection