<header id="header-container" class="fixed fullwidth dashboard">

	<!-- Header -->
	<div id="header" class="not-sticky">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/prestine_logo_2.png') }}" alt="Presting Cleaners"></a>
					<a href="{{ url('/') }}" class="dashboard-logo"><img src="{{ asset('assets/img/logo/prestine_logo_2.png') }}" alt=""></a>
				</div>

				<!-- Mobile Navigation -->
				<div class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</div>
			</div>
			<!-- Left Side Content / End -->

			<!-- Right Side Content / End -->
			<div class="right-side">
				<!-- Header Widget -->
				<div class="header-widget">
					
					<!-- User Menu -->
					<div class="user-menu">
						<div class="user-name"><span><img src="images/dashboard-avatar.jpg" alt=""></span>My Account</div>
						<ul>
							<li><a href="{{ route('profile.index') }}"><i class="sl sl-icon-user"></i> My Profile</a></li>
							<li><a href="{{ route('password.index') }}"><i class="sl sl-icon-lock"></i> Change Password</a></li>
							<li>
								<a href="{{ route('logout') }}"
	                                 onclick="event.preventDefault();
	                                 document.getElementById('logout-form').submit();">
	                                 <i class="sl sl-icon-power"></i> Logout
	                            </a>
	                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                @csrf
	                            </form>
	                        </li>
						</ul>
					</div>

					<a href="{{ route('booking.index') }}" class="button border with-icon">Book Online</a>
				</div>
				<!-- Header Widget / End -->
			</div>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>