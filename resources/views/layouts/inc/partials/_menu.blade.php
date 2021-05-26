<div class="mainmenu-area mainmenu-area2 mainmenu-area4 border-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/prestine_logo_new.png') }}" alt="Presting Cleaners"></a>
                </div>
                <!-- Responsive Menu -->
                <div class="responsive-menu-wrap"></div>
            </div>
            <div class="col-lg-9"> 
                <div class="mainmenu mainmenu4" style="padding-right: 0px !important;">
                    <ul id="navigation">
                        <li><a href="{{ url('/') }}" class="{{ $pagePath == '/' ? 'active' : '' }}">Home</a>
                        </li>
                        <li><a href="{{ route('about') }}" class="{{ $pagePath == 'about' ? 'active' : '' }}">About</a></li>
                        <li><a href="{{ route('services_all') }}" class="{{ $pagePath == 'service' ||  $pagePath == 'services' ? 'active' : '' }}">Services</a>
                            <ul>
                                @php
                                    $categories = \App\Category::where('active', 1)
                                                                ->orderBy('title', 'ASC')
                                                                ->get();
                                @endphp
                                @foreach($categories as $key => $cat)
                                    <li><a href="{{ route('services', ['slug' => $cat->slug]) }}">{{ $cat->title }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <!-- <li><a href="{{ route('prices') }}" class="{{ $pagePath == 'prices' ? 'active' : '' }}">Prices</a></li> -->
                        <li><a href="{{ route('areas') }}" class="{{ $pagePath == 'areas-covered' ? 'active' : '' }}">Areas</a></li>
                        <li><a href="{{ route('faqs') }}" class="{{ $pagePath == 'faq' ? 'active' : '' }}">FAQ</a></li>
                        <li><a href="{{ route('contact.index') }}" class="{{ $pagePath == 'contact' ? 'active' : '' }}">Contact</a></li>
                        <a href="{{ route('booking.index') }}" class="custom-btn-2">Book Online</a>
                    <!--    <li><a href="#searchModal" data-toggle="modal" data-target="#searchModal"><i class="fa fa-search" aria-hidden="true"></i></a></li> -->
                    </ul>
                </div>
                
                @include('layouts.inc.modals.search')
                
            </div>
        </div>
    </div>
</div> 