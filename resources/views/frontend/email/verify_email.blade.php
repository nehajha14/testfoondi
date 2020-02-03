Hello {{$user->first_name}}<br>
<p>Welcome to Jiradi</p>
<p>Thank you for Register with us.</p>
<p>To login your account Verify your Email-id first.</p>
<p>
	<?php 
		$id = base64_encode($user->id);
		$token = base64_encode($user->email_verify_token);
	?>

	<a href="{{url('verify-email')}}/{{$id}}/{{$token}}"> Click here to verify your email-id </a></p>