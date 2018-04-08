@extends('layouts.auth')
@section('title', 'Registration')

@section('content')
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="{{ route('home') }}" class="logo">
				<img src="{{ Setting::get('WEB_LOGO') }}" width="250" alt="" />
			</a>
			
			<p class="description">So you want to join us? Cool!</p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>registering user, please wait...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">

			<div class="form-login-error">
				<h3>Registration Unsuccessful</h3>
				<p id="msg">Oooops...</p>
			</div>

			<form method="post" accept-charset="utf-8" role="form" id="form_register">

				<div class="form-register-success">
					<i class="fa fa-check"></i>
					<h3>You have been successfully registered.</h3>
					<p>We have emailed you the confirmation link for your account.</p>
				</div>

				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

				<div class="form-steps">
					<div class="step current" id="step-1">
					
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								
								<input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" autocomplete="off" value="{{ old('firstname') }}" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-user"></i>
								</div>
								
								<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" autocomplete="off" value="{{ old('lastname') }}" />
							</div>
						</div>

						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-at"></i>
								</div>
								
								<input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" value="{{ old('username') }}" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								
								<input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="Date of Birth (DD/MM/YYYY)" data-mask="date" autocomplete="off" />
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
									<i class="fa fa-envelope"></i>
								</div>
								
								<input type="text" class="form-control" name="email" id="email" data-mask="email" placeholder="E-mail" autocomplete="off" value="{{ old('email') }}" onkeypress="changecase(event, this);" />
							</div>
						</div>
						
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
							<label class="input-group">
								<input type="checkbox" name="tospp" id="tospp"> I have read, accepted and agreed to the <strong>Terms of Service and Privacy Policy</strong>.
							</label>
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-success btn-block btn-login">
								<i class="fa fa-angle-right"></i>
								Complete Registration
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
				
				<br />
				
				<p><a href="/tos">Terms of Service</a> &middot; <a href="/privacy">Privacy Policy</a></p>
				
			</div>

		</div>
		
	</div>
	
</div>
@stop

@section('javascript')
	<script type="text/javascript">
		function changecase(e, obj)  {
			var key = e.which || window.event.keyCode;
			if ((key >= 65) && (key <= 90))  {
				obj.value+=String.fromCharCode(key).toLowerCase(); 
				if (e.preventDefault)
					e.preventDefault();	
				e.returnValue = false; 	
			}
		} 
	</script>
	<script src="{{ Theme::url('js/neon-register.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.inputmask.bundle.js') }}"></script>
@stop