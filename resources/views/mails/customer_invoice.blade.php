<!DOCTYPE html>
<html>
<head>
  <title>Prestine Cleaners</title>
</head>

<body>

	Dear <b>{{ $invoice->name }}</b>, <br/>
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
		<b>Post Code:</b> {{ $booking->post_code }}<br/>
		<b>Prefer Time:</b> {{ $booking->prefer_time }}<br/>
		<b>Inspection Date:</b> {{ $booking->inspection_date }}<br/>
		<b>Service:</b> {{ $booking->service }}
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Prestine Team</i>

</body>
</html>