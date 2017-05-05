@extends('layouts.auth')
@section('title', 'Activate Account')
@section('content')

<div class="login-header login-caret">
		
	<div class="login-content">
		
		<a href="{{ route('home') }}" class="logo">
			<img src="{{ Setting::get('WEB_LOGO') }}" width="250" alt="" />
		</a>
		
		<p class="description">Activate your account</p>
		
		<!-- progress bar indicator -->
		<div class="login-progressbar-indicator">
			<h3>43%</h3>
			<span id="act_msg">activating account...</span>
		</div>
	</div>
	
</div>

<div class="login-progressbar">
	<div></div>
</div>

<div class="login-form">
	
	<div class="login-content">
		
		<div class="form-login-error">
			<h3>Activation Unsuccessful</h3>
			<p id="activation_msg">Oooops...</p>
		</div>
		
		<form method="post" role="form" id="form_activate_account">

			<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
			
			<div class="form-steps">
				<div class="step current" id="step-1">
		
					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-code"></i>
							</div>
							
							<input type="text" class="form-control" name="activation_code" id="activation_code" readonly="readonly" value="{{ $activation_code }}"  disabled="disabled" />
						</div>
					
					</div>

					<div class="form-group">
						
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-at"></i>
							</div>
							
							<input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" />
						</div>
					
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-block btn-login">
							<i class="fa fa-check"></i>
							Complete Activation
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
	<script src="{{ Theme::url('js/neon-activateaccount.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.inputmask.bundle.min.js') }}"></script>
@stop