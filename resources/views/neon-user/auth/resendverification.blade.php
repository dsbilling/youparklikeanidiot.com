@extends('layouts.auth')
@section('title', 'Resend Verification')
@section('content')

<div class="login-header login-caret">
		
	<div class="login-content">
		
		<a href="{{ route('home') }}" class="logo">
			<img src="{{ Setting::get('WEB_LOGO') }}" width="250" alt="" />
		</a>
		
		<p class="description">Want to resend your verification?</p>
		
		<!-- progress bar indicator -->
		<div class="login-progressbar-indicator">
			<h3>43%</h3>
			<span>checking...</span>
		</div>
	</div>
	
</div>

<div class="login-progressbar">
	<div></div>
</div>

<div class="login-form">
	
	<div class="login-content">
		
		<div class="form-login-error">
			<h3>Resend Unsuccessful</h3>
			<p id="msg">Oooops...</p>
		</div>
		
		<form method="post" role="form" id="form_resend_verification">

			<div class="form-register-success">
				<i class="fa fa-check"></i>
				<h3>Your verification has been sent!</h3><br>
				<p>Please check your email inbox, also the Junk-folder.</p>
			</div>

			<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
			
			<div class="form-steps">
				<div class="step current" id="step-1">
					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-at"></i>
							</div>
							
							<input type="text" class="form-control" name="email" id="email" placeholder="E-mail" autocomplete="off" />
						</div>
					
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-success btn-block btn-login">
							<i class="fa fa-paper-plane"></i>
							Resend Verification
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
	<script src="{{ Theme::url('js/neon-resendverification.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.inputmask.bundle.js') }}"></script>
@stop