@extends('layouts.auth')
@section('title', 'Forgot Password')
@section('content')

<div class="login-header login-caret">
		
	<div class="login-content">
		
		<a href="{{ route('home') }}" class="logo">
			<img src="{{ Setting::get('WEB_LOGO') }}" width="250" alt="" />
		</a>
		
		<p class="description">Oh, so you forgot your password?</p>
		
		<!-- progress bar indicator -->
		<div class="login-progressbar-indicator">
			<h3>43%</h3>
			<span>sending reminder...</span>
		</div>
	</div>
	
</div>

<div class="login-progressbar">
	<div></div>
</div>

<div class="login-form">
	
	<div class="login-content">
		
		<div class="form-login-error">
			<h3>Reminder Unsuccessful</h3>
			<p id="msg">Oooops...</p>
		</div>
		
		<form method="post" role="form" id="form_forgot_password">

			<div class="form-register-success">
				<i class="fa fa-check"></i>
				<h3>We have sent you an email!</h3><br>
				<p>Please check your inbox for the reminder email to reset your password.</p>
			</div>

			<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
			
			<div class="form-steps">
				<div class="step current" id="step-1">
		
					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-at"></i>
							</div>
							
							<input type="text" class="form-control" name="username" id="username" placeholder="Username/E-mail" autocomplete="off" />
						</div>
					
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-success btn-block btn-login">
							<i class="fa fa-angle-right"></i>
							Continue
						</button>
					</div>
				</div>
			</div>
			
		</form>
		
		
		<div class="login-bottom-links">
			
			<a href="{{ route('account-login') }}" class="link">
				<i class="fa fa-lock"></i>
				Return to Login Page
			</a>

			<p><a href="/tos">Terms of Service</a> &middot; <a href="/privacy">Privacy Policy</a></p>
			
		</div>
		
	</div>
	
</div>

@stop

@section('javascript')
	<script src="{{ Theme::url('js/neon-forgotpassword.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.inputmask.bundle.js') }}"></script>
@stop