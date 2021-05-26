<!DOCTYPE html>
<html>
<head>
  <title>Prestine Cleaners</title>
</head>

<body>

	Dear <b>{{ $booking->name }}</b>, <br/>
	@if($booking->status == 'cancelled')
	<p>
		We are sorry to say that your booking could not be confirmed and has been <b><font color="red">Canceled</font></b>.
	</p>
	<p>
		The details of the canceled booking can be found below.
	</p>
	@else
	<p>
		We are glad to say that your booking has been <b><font color="green">Approved</font></b>.
	</p>
	<p>
		The details of the approved booking can be found below.
	</p>
	@endif
	<p>
		<b>Service:</b> {{ $booking->service }}<br/>
		<b>Service Date:</b> {{ $booking->cleaning_start_date }}
	</p>
	@if($booking->status == 'approved')
	<p>
		<strong>Note:</strong> If you want to cancel or amend your booking please send us written confirm at least 48 hours prior to clean, any notice given after this period will lead to cancellation or amendment fee of 25%.
	</p>
	@endif	
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