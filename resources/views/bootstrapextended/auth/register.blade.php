@extends('layouts.base.main')
@section('title') Register @stop

@section('content')
<div class="fullscreen_bg" id="fullscreen_bg">
	<div class="container">
		<form action="{{ route('post.register') }}" method="post" accept-charset="utf-8" role="form" class="form-register">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h1 class="form-login-heading text-muted">Register</h1>

			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}" placeholder="First Name" required="">
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}" placeholder="Last Name">
					</div>
				</div>
			</div>

			<div class="form-group">
				<input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" placeholder="Username" required="">
			</div>

			<div class="form-group">
				<input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email Address" required="">
			</div>

			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" placeholder="Password" required="">
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" placeholder="Confirm Password" required="">
					</div>
				</div>
			</div>

			<label>
				<input type="checkbox" name="tos" id="tos" value="1" {{ old('tos') ? 'checked' : '' }}> I have read, accepted and agreed to the <a href="#">Terms of Service and Privacy Policy</a>.
			</label>

			<button type="submit" class="btn btn-lg btn-info btn-block"><i class="fa fa-pencil"></i> Register</button>

			<p class="text-center bottom-link"><small><a href="{{ route('home') }}">Home</a> &middot; <a href="{{ route('login') }}">Already got an account?</a></small></p>
		
		</form>
	</div>
</div>
@stop