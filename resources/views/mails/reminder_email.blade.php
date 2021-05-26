<!DOCTYPE html>
<html>
<head>
  <title>Prestine Cleaners</title>
</head>

<body>

	Dear <b>{{ $booking->name }}</b>, <br/>
	
	<p>
		We are due to meet tomorrow here are your booking details.
	</p>
	
	<p>
		<b>Service:</b> {{ $booking->service }}<br/>
		<b>Service Date:</b> {{ $booking->cleaning_start_date }}<br/>
		<b>Service Site:</b> {{ $booking->cleaning_area }}
	</p>
	
	<p>
		<strong>Note:</strong> If you want to cancel or amend your booking please send us written confirm at least 48 hours prior to clean, any notice given after this period will lead to cancellation or amendment fee of 25%.
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