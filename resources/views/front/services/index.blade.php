@extends('layouts.master')

@section('content')

    <!-- Banner Area Start -->
	@include('layouts.inc.partials._banner2')
    <!-- Banner Area End -->

	<!-- Start Main Content Area -->
    <section class="cleaning-content-block" style="background-color: #f2f3f8 !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>{{ $title }}</h2>
                        <p>Offering best cleaning services.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Blog Main-content area -->
                <div class="col-lg-8 col-md-8">
                    <div class="post-details-area">
                        <div class="blog-slides">
                            @foreach($service->category_images as $key => $cat)
                            <div class="single-blog-slide">
                                <a class="lightbox-gallery" href="{{ asset('assets/img/services-img/services/' . $cat->image) }}"><img src="{{ asset('assets/img/services-img/services/' . $cat->image) }}" alt="Prestine Cleaners"></a>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="post-description">
                           {!! $service->description !!} 
                        </div>
                    </div> 
                </div>
                <!-- End Blog Main-content area -->
                
                <!-- Blog Right Sidebar -->
                <div class="col-lg-4 col-md-4">
                    <!-- <div class="blog-serch-form">
                        <input type="text" placeholder="Search here.....">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div> -->
                    
                    <!-- Qoute Form -->
                    <div class="qoute-title-area">
                        <h3>Lets Talk About The Project</h3>
                    </div>
                    <div class="qoute-form-area mb-4">
                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            <p class="px-4">
                                <!-- <label for="contact_name">Name *</label> -->
                                <input type="text" name="name" id="contact_name" class="border" placeholder="Name" required>
                            </p>
                            <p class="px-4">
                                <!-- <label for="contact_email">Email *</label> -->
                                <input type="email" name="email" id="contact_email" class="border" placeholder="Email" required>
                            </p>
                            <p class="px-4">
                                <!-- <label for="contact_phone">Phone *</label> -->
                                <input type="text" name="phone" id="contact_phone" class="border" placeholder="Phone" required>
                            </p>
                            <p class="px-4"> 
                                <!-- <label for="contact_subject">Subject *</label> -->
                                <input type="text" name="subject" id="contact_subject" class="border" placeholder="Subject" required restrict="A-Z\a-z\0-9">
                            </p>
                            <p class="px-4">
                                <!-- <label for="contact_message">Message *</label> -->
                                <textarea name="message" id="contact_message" class="border" placeholder="Message" required restrict="A-Z\a-z\0-9"></textarea>
                            </p>
                            <p class="px-4"> 
                                <div id="contact_send_status"></div>
                            </p>
                            <p class="px-4">
                                <input type="submit" value="Get A free quote">
                            </p>
                        </form>
                    </div> <!-- End Qoute Form -->
                
                    <div class="widget recent_posts">
                        <h3 class="widget-title">Other Services</h3>
                        <ul>
                            @foreach($other_services as $other)
                            <li>
                                <a href="{{ route('services', ['slug' => $other->slug]) }}" style="font-weight: 500;">{{ $other->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div> 
                <!-- Blog Right Sidebar -->
            </div>
        </div>
    </section>
    <!-- End Main Content Area -->
@endsection