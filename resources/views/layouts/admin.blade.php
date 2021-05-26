<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

@include('layouts.inc.partials._admin_head')

<body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

	@include('layouts.inc.partials._admin_fixed_top')

	@include('layouts.inc.partials._admin_side_bar')

	<div class="app-content content">
    	<div class="content-wrapper">
      		
      		@yield('content')

      </div>
  </div>

	@include('layouts.inc.partials._admin_footer')

	@include('layouts.inc.partials._admin_script')

</body>
</html>	    

