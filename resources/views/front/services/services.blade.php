@extends('layouts.master')

@section('content')

	<!-- Banner Area Start -->
	@include('layouts.inc.partials._banner')
    <!-- Banner Area End -->

    <!-- Start Services Area -->
    <section class="cleaning-content-block services">
        <div class="container">
        	<div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>{{ $title }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($services as $service)
                <div class="col-lg-4 col-md-6 wow fadeInUp">
                    <div class="single-service-item-block single-service">
                        <a href="{{ route('services', ['slug' => $service->slug]) }}" class="single-service-image service-bg-1" style="background-image: url(assets/img/services-img/services/{{  $service->image }});">
                        </a>
                        <a href="{{ route('services', ['slug' => $service->slug]) }}"><h3>{{ $service->title }}</h3></a>
                    </div>
                </div>
                @endforeach
    
            </div>
        </div>
    </section>
    <!-- End Services Area -->
      
@endsection