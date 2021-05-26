@extends('layouts.master')

@section('content')

	@include('layouts.inc.partials._banner2')

	<!-- Start Main Content Area -->
    <section class="cleaning-content-block" style="background-color: #f2f3f8 !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>{{ $title }}</h2>
                        <p>We cover the following areas.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Blog Main-content area -->
                <div class="col-lg-6 col-md-6">
                    <div class="post-details-area">
                        <div class="blog-slides">
                            <div class="single-blog-slide">
                                <a class="lightbox-gallery" href="{{ asset('assets/img/contact-image/areas_covered.jpg') }}">
                                    <img src="{{ asset('assets/img/contact-image/areas_covered.jpg') }}" alt="Prestine Cleaners">
                                </a>
                            </div>
                        </div>
                        
                    </div> 
                </div>
                <!-- End Blog Main-content area -->
                
                <!-- Blog Right Sidebar -->
                <div class="col-lg-6 col-md-6">
                    <div class="widget recent_posts">
                        <h3 class="widget-title">Areas Covered</h3>
                        <ul>
                            <li>
                                <a href="https://goo.gl/maps/XyudqNJgSA36KYuQA" target="_blank">Brekshire</a> (Slough, Windsor, Maidenhead, Newbury, Bracknell, Ascot, Reading, Thatcham, Eton, Woodley, Datchet, Wokingham and all the surrounding areas.)
                            </li>
                            <li>
                                <a href="https://goo.gl/maps/dTEPaKi1rciuMrPKA" target="_blank">Buckinghamshire</a> (ylesbury, High wycombe, Marlow, Chesham, Beaconsfield, Gerrards Cross, Milton Keynes, Buckingham, Bourne End, and the surrounding areas)
                            </li>
                            <li>
                                <a href="https://goo.gl/maps/ZSbS3ewvqToXkF6R8" target="_blank">Oxfrodshire</a> (Oxford, Bicester, Abingdon, Witney, Wanatage, Ban Bury, Didcot, Henely-on-Thames, Wallingford and all the surrounding areas)
                            </li>
                            <li>
                                <a href="https://goo.gl/maps/Hz8jDKPZSiZ6xgM17" target="_blank">Hertfordshire</a> (Hatfield, Stevenage, St. Albans, Hemel Hampstead, Watford, Cheshnut and all the surrounding areas)
                            </li>
                            <li>
                                <a href="https://goo.gl/maps/2QoktfvPw9iqspwB8" target="_blank">Hampshire</a> (Winchester, Andover, Basingstoke, Gosport, Fareham, Southampton, Portsmouth, Eastleigh, Aldershot and all the surrounding areas)
                            </li>
                            <li>
                                <a href="https://goo.gl/maps/GXeGmUft84mCqC4Q6" target="_blank">Surrey</a> (Reigate, Woking, Guildford, Godalming, Staines-upon-Thames, Leatherhead, Cobham and all the surrounding areas)
                            </li>
                            <li>
                                <a href="https://goo.gl/maps/hrqMj5fjJ83uQMcm9" target="_blank">London</a> (All the major areas of London)
                            </li>
                        </ul>
                    </div>
                </div> 
                <!-- Blog Right Sidebar -->
            </div>
        </div>
    </section>
    <!-- End Main Content Area -->
@endsection