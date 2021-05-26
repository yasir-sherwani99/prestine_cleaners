@extends('layouts.master')

@section('content')

	@include('layouts.inc.partials._banner2')

	<!-- Start Main Content Area -->
    <section class="cleaning-content-block" style="background-color: #f2f3f8 !important;">
        <div class="container">
            
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Thank You!</strong> {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (count($errors) > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <b>Alert!</b>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
               <div class="col-lg-4 col-md-5">
                   <div class="address-area">
                       <ul>
                            <li>
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <h3>Phone</h3>
                                <p>07387 312 723</p>
                            </li>
                            <li>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <h3>Address</h3>
                                <p>18 King Edward Street Slough SL1 2QS.</p>	
                            </li>
                            <li>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <h3>E-mail</h3>
                                <p>info@prestinecleaners.co.uk</p>	
                            </li>
                            <li>
                                <h3>Follow Us</h3>
                                <ul class="contact-social">
                                    <li><a href="{{ isset($social->facebook) ? $social->facebook : '#' }}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="{{ isset($social->twitter) ? $social->twitter : '#' }}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="{{ isset($social->instagram) ? $social->instagram : '#' }}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="{{ isset($social->pinterest) ? $social->pinterest : '#' }}" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                    <li><a href="{{ isset($social->youtube) ? $social->youtube : '#' }}" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                </ul>
                            </li>		
                        </ul>
                   </div>
               </div>
               <div class="col-lg-8 col-md-7">
                   <div class="contact-form-area">
                        <div class="contact-info text-center">
                           <h2>Get In Touch With Us!</h2>
                           <p>We are always ready to listen you first</p>
                        </div>
                        
                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="contact_name" placeholder="Name*" value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="phone" id="contact_phone" placeholder="Phone*" value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" id="contact_email" placeholder="E-mail*" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="subject" id="contact_subject" placeholder="Subject*" required value="{{ old('subject') }}" restrict="A-Z\a-z\0-9">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="contact_message" name="message" rows="6" placeholder="Message*" required restrict="A-Z\a-z\0-9">{{ old('message') }}</textarea>
                            </div>

                            <div class="form-group text-center mb-18">
                                {!! NoCaptcha::renderJs() !!}
                                <div class="d-inline-block">
                                    {!! NoCaptcha::display() !!}
                                </div>
                                @if ($errors->has('g-recaptcha-response'))
                                    <small class="text-danger d-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="text-center">
                                <div id="contact_send_status"></div>
                                <input type="submit" class="sbmt-btn" value="Get in touch">
                            </div>
                        </form>
                   </div>
               </div>
           </div>
        </div>
    </section>
    <!-- End Main Content Area -->
    
    <!-- Google Map Area -->
    <div id="map">
        <iframe width="100%" height="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:EiJLaW5nIEVkd2FyZCBTdCwgU2xvdWdoIFNMMSAyUVMsIFVLIi4qLAoUChIJTTq4ftF6dkgRgdj7RztVDsUSFAoSCedgs2TRenZIEbhE3NtAwO6N&key=AIzaSyDlcNyD13Ndl1xIqAYDprKHPfNME-xuF-M" allowfullscreen></iframe>
    </div>
    <!-- Google Map Area -->

@endsection