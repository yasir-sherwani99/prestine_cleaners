<div class="dashboard-list-box invoices with-icons margin-top-20">
	<h4>Recent Bookings</h4>
	<ul>
		@if(!$recent_bookings->isEmpty())
			@foreach($recent_bookings as $book)
			<li>
				<i class="list-box-icon fa fa-calendar-o"></i>
				<strong>{{ $book->service->title }}</strong>
				<ul>
					<li>
						<i class="im im-icon-Map-Marker2"></i>
						{{ $book->cleaning_area_post_code }}
					</li>
					<li>Date: {{ date('d F, Y', strtotime($book->cleaning_start_date)) }}</li>
				</ul>
			</li>
			@endforeach
		@else
			<li>
				<i class="list-box-icon fa fa-calendar-o"></i>
				<strong>There is no booking to show here ..</strong>
			</li>
		@endif
	</ul>
</div>