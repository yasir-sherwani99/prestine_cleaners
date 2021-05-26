<!DOCTYPE html>
<html>
<head>
  	<title>Prestine Cleaners</title>
</head>

<body>

	Dear <b>{{ $password->name }}</b>, <br/>
	<h3>Can't remember your password?</h3>
	<p>
		Dont't worry about it. It happens. We can help.
	</p>
	<p>
		<b>Your Email ID:</b> {{ $password->email }}
	</p>
	<p>
		Use This Link to Reset Password: <a href="{{ url('/') . '/reset/' . $password->code }}" target="_blank">{{ url('/') . '/reset/' . $password->code }}</a>
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Prestine Cleaners</i>

</body>
</html>