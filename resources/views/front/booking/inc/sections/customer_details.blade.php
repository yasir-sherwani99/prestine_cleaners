<div class="choose_customer_details p-4 mb-4" style="background-color: #fffacd !important;">
    <p class="text-muted mb-1">
        Please verify your credential details, if they are correct, click the submit button. If following details is wrong, please click on sign out link you will find below:
    </p>
	
	<table class="table table-borderless mt-2">
   		<tbody>
       		<tr>
       			<th>Name:</th>
       			<td>{{ Auth::user()->name }}</td>
       		</tr>
       		<tr>
       			<th>Email:</th>
       			<td>{{ Auth::user()->email }}</td>
       		</tr>
       	</tbody>
   	</table>

	<p class="mt-2">
		<b>Note:</b> If above details are wrong. Please 
		<a href="{{ route('logout') }}" 
		    onclick="event.preventDefault();
	        document.getElementById('logout-form3').submit();">
            Sign Out
        </a>
	</p>
</div>