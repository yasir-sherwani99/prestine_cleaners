<!DOCTYPE html>
<html>
<head>
  <title>Prestine Cleaners</title>
</head>

<body>

	Dear <b>Admin</b>, <br/>
	<p>
		You have received a message from PrestineCleaners website contact us page, the details are given below:
	</p>
	<hr/>
	<p>
		<b>Customer Name:</b> {{ $contact->name }}<br/>
		<b>Email:</b> {{ $contact->email }}<br/>
		<b>Phone:</b> {{ $contact->phone }}<br/>
		<b>Subject:</b> {{ $contact->subject }}
		<br/><br/>
		<b>Message:</b> {{ $contact->message }}
	</p>	
	<br/>
	Thank You,
	<br/>
	<i>Prestine IT Team</i>

</body>
</html>