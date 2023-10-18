<h3>{{ $data['title'] }}</h3>
<p>Please click the link below to verify your account!</p>
<a href="{{ route('verify.email',['token' => $data['token']]) }}">Click to here.</a>

