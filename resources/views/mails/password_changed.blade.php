<!DOCTYPE html>
<html>
<head>
  	<title>Prestine Cleaners</title>
</head>

<body>

	Dear <b>{{ $change->name }}</b>, <br/>
	<p>
		The password of your prestine account <strong>{{ $change->email }}</strong> has been changed successfully.<br/>
	</p>
	<p>
		If you did not initiate this change, please contact your prestine administrator immediately.
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Prestine Cleaners</i>

</body>
</html>