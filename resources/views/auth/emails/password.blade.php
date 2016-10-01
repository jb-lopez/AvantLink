<span><i class="fa fa-asterisk"></i> This demo has no active email server, and cannot sent emails.</span><br/><br/>
Click here to reset your password:
<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
