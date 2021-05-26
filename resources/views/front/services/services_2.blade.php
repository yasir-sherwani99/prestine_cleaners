@extends('layouts.master')

@section('content')

<section class="cleaning-content-block services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h2>{{ $title }}</h2>
                    <p>We at Prestine are offering best cleaning services of the highest standards in the following areas.</p>
                </div>
            </div>
        </div>
        <div class="row">
        	@foreach($services as $service)
            <div class="col-lg-4 col-md-6 wow fadeInUp">
                <div class="single-project-item">
                    <img src="{{ asset('assets/img/services-img/services/' . $service->image) }}" alt="Prestine Cleaners">
                    <div class="about-title">
                        <h4>{{ $service->title }}</h4>
                    </div>
                    <div class="single-project-info">
                        <div class="mask-table">
                            <div class="mask-table-cell">
                                <h3>{{ $service->title }}</h3>
                                <!-- <p>Our of end of tenancy cleaners are equipped with all necessary tools.</p> -->
                                <a href="{{ route('services', ['slug' => $service->slug]) }}" class="read-more-btn project-btn">Read More <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach          
        </div>
    </div>
</section>
        

@endsection