<!DOCTYPE html>
<html>
<head>
  <title>Prestine Cleaners</title>
</head>

<body>

	Dear <b>{{ $booking->name }}</b>, <br/>
	<p>
		Thank you for choosing Prestine Cleaners for your home/commercial cleaning needs. Your request for service has been sent to Prestine Customer Care Center. After check availability, we'll be in touch with you shortly to finalize your booking.
	</p>
	<p>
		Please Note: This is NOT a confirmation email.
	</p>
	<p>
		We have your information listed below as:
	</p>
	<p>
		<b>Name:</b> {{ $booking->name }}<br/>
		<b>Email:</b> {{ $booking->email }}<br/>
		<b>Phone:</b> {{ $booking->phone }}<br/>
		<b>Cleaning Area:</b> {{ $booking->cleaning_area_post_code }}<br/>
		<b>Service Date:</b> {{ $booking->cleaning_start_date_time }}<br/>
		<b>Service:</b> {{ $booking->service }}
	</p>
	<p>
		<b>Note:</b> If you want to cancel or amend your booking please send us written confirm at least 48 hours prior to clean, any notice given after this period will lead to cancellation or amendment fee of 25%
	</p>	
	<br/>
	Thank You,
	<br/>
	<p>
		<i>Prestine Cleaners</i><br/>
		18 King Edward Street<br/> 
		Slough SL1 2QS.<br/>
		07387 312 723 <br/>
		<a href="mailto: info@prestinecleaners.co.uk">info@prestinecleaners.co.uk</a>
	</p>

</body>
</html>