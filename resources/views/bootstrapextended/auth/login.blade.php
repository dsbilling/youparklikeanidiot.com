@extends('layouts.base.main')
@section('title') Login @stop

@section('content')
<div class="fullscreen_bg" id="fullscreen_bg">
	<div class="container">

		<form action="{{ route('post.login') }}" method="post" accept-charset="utf-8" role="form" class="form-login">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h1 class="form-login-heading text-muted">Login</h1>
			<input type="text" class="form-control" value="{{ old('username') }}" placeholder="username" required="" autofocus="" name="username" id="username">
			<input type="password" class="form-control" placeholder="password" required="" name="password" id="password">
			<label>
				<input type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}> Remember me
			</label>
			<br><br>
			<button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Login</button>
			<p class="text-center bottom-link"><small><a href="{{ route('home') }}">Home</a> &middot; <a href="{{ route('account-forgotpassword') }}">Forgot Your Password?</a> &middot; <a href="{{ url('register') }}">Need an account?</a></small></p>
		</form>

	</div>
</div>
@endsection
