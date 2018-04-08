@extends('layouts.auth')
@section('title', 'Reset Password')
@section('content')

<div class="login-header login-caret">
		
	<div class="login-content">
		
		<a href="{{ route('home') }}" class="logo">
			<img src="{{ Setting::get('WEB_LOGO') }}" width="250" alt="" />
		</a>
		
		<p class="description">You can now reset your password</p>
		
		<!-- progress bar indicator -->
		<div class="login-progressbar-indicator">
			<h3>43%</h3>
			<span>reseting password...</span>
		</div>
	</div>
	
</div>

<div class="login-progressbar">
	<div></div>
</div>

<div class="login-form">
	
	<div class="login-content">
		
		<div class="form-login-error">
			<h3>Reset Unsuccessful</h3>
			<p id="msg">Oooops...</p>
		</div>
		
		<form method="post" role="form" id="form_reset_password">

			<div class="form-register-success">
				<i class="fa fa-check"></i>
				<h3>Your password has been reset!</h3><br>
				<p>You can now login to your account.</p>
			</div>

			<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
			
			<div class="form-steps">
				<div class="step current" id="step-1">
		
					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-code"></i>
							</div>
							
							<input type="text" class="form-control" name="resetpassword_code" id="resetpassword_code" readonly="readonly" value="{{ $resetpassword_code }}" autocomplete="off" disabled="disabled" />
						</div>
					
					</div>

					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-at"></i>
							</div>
							
							<input type="text" class="form-control" name="username" id="username" placeholder="Username/E-mail" autocomplete="off" />
						</div>
					
					</div>

					<div class="form-group">
						<button type="button" data-step="step-2" class="btn btn-primary btn-block btn-login">
							<i class="fa fa-angle-right"></i>
							Next Step
						</button>
					</div>
					
					<div class="form-group">
						<p>Step 1 of 2</p>
					</div>
				
				</div>

				<div class="step" id="step-2">
				
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-lock"></i>
							</div>
							
							<input type="password" class="form-control" name="password" id="password" placeholder="Choose Password" autocomplete="off" />
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-lock"></i>
							</div>
							
							<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" autocomplete="off" />
						</div>
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-block btn-login">
							<i class="fa fa-check"></i>
							Complete Password Reset
						</button>
					</div>
					
					<div class="form-group">
						<p>Step 2 of 2</p>
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
	<script src="{{ Theme::url('js/neon-resetpassword.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.inputmask.bundle.js') }}"></script>
@stop