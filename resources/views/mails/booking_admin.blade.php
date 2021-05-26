<!DOCTYPE html>
<html>
<head>
  <title>Prestine Cleaners</title>
</head>

<body>

	Dear <b>Admin</b>, <br/>
	<p>
		A booking has been made by <b>{{ $booking->name }}</b> and is awaiting your approval. 
	</p>
	<p>
		The details of the booking are as follows:
	</p>
	<p><strong>Customer Details:</strong></p>
	<p>
		<b>Name:</b> {{ $booking->name }}<br/>
		<b>Email:</b> {{ $booking->email }}<br/>
		<b>Phone:</b> {{ $booking->phone }}
	</p>
	<p><strong>Service Details:</strong></p>
	<p>
		<b>Cleaning Area:</b> {{ $booking->cleaning_area_post_code }}<br/>
		<b>Service Date:</b> {{ $booking->cleaning_start_date_time }}<br/>
		<b>Service Requested:</b> {{ $booking->service }}
	</p>
	<p>
		For detail information about booking, please check admin dashboard here:<br/>
		<a href="https://prestinecleaners.co.uk" target="_blank">https://prestinecleaners.co.uk/admin_panel</a> 
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Prestine Team</i>

</body>
</html>