@extends('layouts.admin')

@section('content')

<div class="content-body">
    
    <!-- Stats -->
    @include('admin.home.inc.stats')
    <!--/ Stats -->
    
    <div class="row">
        <!-- Recent Bookings -->    
        @include('admin.home.inc.recent_bookings')
        <!--/ Recent Bookings -->
        
        <!-- Today Services -->
        @include('admin.home.inc.today_services')
        <!--/ Recent Bookings -->
    </div>
    
</div>

@endsection