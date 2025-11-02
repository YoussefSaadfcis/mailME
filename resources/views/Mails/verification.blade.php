<h2>Verify Your Email - mailME</h2>
<p>Your verification code is:</p>
<h1 style="color:blue;">{{ $otp }}</h1>
<h5 style="color:blue;"><a href="{{ route('verify.email.form', $userId)}}"> Verify</a> </h5>
<p>This code will expire in 10 minutes.</p>
<p>If you did not request this, please ignore this email.</p>
<p>Thank you,<br/>The mailME Team</p>