@extends('layouts.master')

@section('content')

	@include('layouts.inc.partials._banner2')

	<!-- Start Main Content Area -->
    <section class="cleaning-content-block" style="background-color: #f2f3f8 !important;">
        <div class="container">
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
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                </ul>
                            </li>		
                        </ul>
                   </div>
               </div>
               <div class="col-lg-8 col-md-7">
                   <div class="contact-form-area p-5" style="background-color: #ffffff !important;">
                        <div class="contact-info text-center">
                           <h2>Employment</h2>
                           <p>Are you looking for a job?</p>
                        </div>
                        <div>
                            <h4>Prestine Professional Services</h4>
                            <p>
                                To apply for a job at Prestine Professional Services, Please send us your cover letter together with your CV/Resume at <a href="mailto:info@prestinecleaners.co.uk">info@prestinecleaners.co.uk</a>.
                            </p>
                            <hr/>
                            <p>
                                Call us today at: <b>07387 312 723</b>
                            </p>
                        </div>
                        
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