@extends('layouts.admin')

@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/calendars/fullcalendar.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/calendars/fullcalendar.css') }}">
@endsection

@section('content')

<div class="content-header row">
  	<div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
      	<h3 class="content-header-title mb-0 d-inline-block">Bookings Calendar</h3>
      	<div class="row breadcrumbs-top d-inline-block">
        	<div class="breadcrumb-wrapper col-12">
          		<ol class="breadcrumb">
            		<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            		<li class="breadcrumb-item"><a href="#">Bookings</a></li>
            		<li class="breadcrumb-item active">Bookings Calendar</li>
          		</ol>
        	</div>
      	</div>
    </div>
</div>

<div class="content-body">
	<section id="events-examples">
        <div class="row">
            <div class="col-12">
              	<div class="card">
                	<div class="card-header">
                  		<h4 class="card-title">Booking Calendar</h4>
                  		<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  		<div class="heading-elements">
                    		<ul class="list-inline mb-0">
		                      	<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
		                      	<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    		</ul>
                  		</div>
                	</div>
                	<div class="card-content collapse show">
		                <div class="card-body">
		                    <div id='calendar'></div>
		                 </div>
		            </div>
              	</div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')
	<script src="{{ asset('admin-assets/vendors/js/extensions/moment.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('admin-assets/vendors/js/extensions/fullcalendar.min.js') }}" type="text/javascript"></script>
    <link href='https://code.jquery.com/ui/1.12.1/themes/cupertino/jquery-ui.css' rel='stylesheet' />
  	<script>
  		$(document).ready(function(){
  			var data = "{{ $final_data }}";
  			var final_data = JSON.parse(data.replace(/&quot;/g,'"'));
  		
  			$('#calendar').fullCalendar({
				themeSystem: 'jquery-ui',
                header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay,listMonth'
				},
				defaultDate: "{{ date('Y-m-d') }}",
				businessHours: true, // display business hours
				editable: true,
            //    eventLimit: true, // allow "more" link when too many events
				events: final_data,
                eventRender: function(event, element) {
                    $(element).popover({
                        html: true,
                        trigger: 'hover',
                        title: "<center>Booking Details</center>",
                        content: "<table class='table table-xs table-borderless'><tr><th colspan='2' class='text-left pl-0'>" + event.service + "</th></tr><tr><td colspan='2'>&nbsp;</td></tr><tr><td class='px-0'><i class='la la-user-secret'></i></td><td class='pl-1'>" + event.title + "</td></tr><tr><td class='px-0'><i class='la la-phone'></i></td><td class='pl-1'>" + event.phone + "</td></tr><tr><td class='px-0'><i class='la la-calendar-check-o'></i></td><td class='pl-1'>" + event.booking_date + "</td></tr><tr><td colspan='2' class='text-left pl-2'><b>" + '&nbsp;&nbsp;&nbsp;&nbsp;' + event.booking_status + "</b></td></tr><tr><td class='px-0'><i class='la la-map-marker'></i></td><td class='pl-1'>" + event.area + "</td></tr><tr><td class='px-0'><i class='la la-usd'></i></td><td class='pl-1'><b>UNPAID</b></td></tr></table>"
                    });
                }
			});

  		});
  	</script>
@endsection