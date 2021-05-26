<!DOCTYPE html>
<html>
<head>
  <title>Prestine Cleaners</title>
</head>

<body>

	Dear <b>{{ $account->name }}</b>, <br/>
	<p>
		Thank you for choosing Prestine Cleaners for your home/commercial cleaning needs.<br/> 
		Your new account has been setup and you can now login to your client area using the details below:
	</p>
	<p>
		Email: <b>{{ $account->email }}</b><br/>
		Password: <b>{{ $account->password }}</b>
	</p>
	<p>
		<b>Note: </b>To check status of your online booking and invoices please log in to your client area.
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