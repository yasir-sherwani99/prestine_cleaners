<div class="footer-top pt-70 pb-70" style="background: url(/assets/img/footer/footer-bgg.png) center top no-repeat !important;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="footer-contact">
                    <img src="{{ asset('assets/img/logo/prestine_logo_2.png') }}" alt="Presting Cleaners">
                    <p class="text-justify mt-4">Established in 2019, Prestine Cleaners is family-run business. We have a deeply held commitment to deliver excellent client satisfaction, using our specialist knowledge, skills and experience.</p>
            
                    <!-- <div class="social-link">
                        <?php
                            $social = \App\Setting::find(1);
                        ?>
                        <ul>
                            <li><a href="{{ isset($social->facebook) ? $social->facebook : 'javascript:;' }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ isset($social->twitter) ? $social->twitter : 'javascript:;' }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ isset($social->instagram) ? $social->instagram : 'javascript:;' }}" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="{{ isset($social->pinterest) ? $social->pinterest : 'javascript:;' }}" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mt-5">
                <div class="recent-news">
                    <!-- <h2>Popular Services</h2> -->
                    <div class="news-wrap">
                        <ul class="services-list">
                            @php
                                $services = \App\Category::where('active', 1)
                                                         ->inRandomOrder()
                                                         ->limit(5)
                                                         ->get();
                            @endphp

                            @foreach($services as $service)
                                <li>
                                    <a href="{{ route('services', ['slug' => $service->slug]) }}"><i class="fa fa-chevron-right"></i> <span>{{ $service->title }}</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 mt-5">
                <div class="recent-news">
                    <!-- <h2>Important Links</h2> -->
                    <div class="news-wrap">
                        <ul>
                            <li>
                                <a href="{{ route('about') }}"><i class="fa fa-chevron-right"></i> <span>Abous Us</span></a>
                            </li>
                            <li>
                                <a href="{{ route('faqs') }}"><i class="fa fa-chevron-right"></i> <span>Book Online</span></a>
                            </li>
                            <li>
                                <a href="{{ route('terms_conditions') }}"><i class="fa fa-chevron-right"></i> <span>Terms & Conditions</span></a>
                            </li>
                            <li>
                                <a href="{{ route('employment') }}"><i class="fa fa-chevron-right"></i> <span>Employment</span></a>
                            </li>
                            <li>
                                <a href="{{ route('areas') }}"><i class="fa fa-chevron-right"></i> <span>Areas Covered</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 text-right">
                <div class="payment_gateways">
                    <ul class="list-inline">
                       <li><img src="{{ asset('assets/img/mastercard.png') }}" alt="payment"></li>
                       <li><img src="{{ asset('assets/img/paypal.png') }}" alt="payment"></li>
                       <li><img src="{{ asset('assets/img/visa02.png') }}" alt="payment"></li>
                       <li><img src="{{ asset('assets/img/americanexpress.png') }}" alt="payment"></li>
                   </ul>
                </div> 
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container">
        <p>© 2020 All Rights Reserved by <a href="https://prestinecleaners.co.uk" targer="_blank">Prestine Cleaners</a>.</p>
    </div>
</div>
