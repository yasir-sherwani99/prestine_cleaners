<section class="header-topbar-section header-topbar-section2 bg-white border-bottom-0 p-2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-7">
                <div class="single-top-head">
                    <ul class="head-contact text-left">
                        <li><a href="#"><i class="flaticon-headphones" aria-hidden="true"></i>07387 312 723</a></li>
                        <li><a href="mailto:info@prestinecleaners.co.uk"><i class="flaticon-mail-1" aria-hidden="true"></i>info@prestinecleaners.co.uk</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-5" style="padding-right: 0px !important;">
                <div class="single-top-head">
                    <ul class="head-contact">
                        @if (Route::has('login'))
                            @auth
                                <li><a href="{{ route('home') }}"><i class="flaticon-home" aria-hidden="true"></i>Dashboard</a></li>
                            @else
                                <li><a href="{{ route('login') }}"><i class="flaticon-lock" aria-hidden="true"></i>Login / Register</a></li>
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>