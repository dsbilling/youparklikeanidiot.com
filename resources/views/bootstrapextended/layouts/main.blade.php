<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') - {{ Config::get('infihex.appname') }}</title>

	<!-- CSS -->
	<link href="{{ Theme::url('css/bootstrap.min.css') }}" rel="stylesheet">

	<!-- Thirdparty CSS -->
	<link href="{{ Theme::url('css/jasny-bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/bootstrap-material-design.min.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/ripples.min.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/roboto.min.css') }}" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="{{ Theme::url('css/custom.css') }}" rel="stylesheet">
	@if(Request::is('login') || Request::is('register'))
		<link href="{{ Theme::url('css/login.css') }}" rel="stylesheet">
	@endif

	<!-- Fonts -->
	<!--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>-->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<nav class="navbar navbar-material-light-blue">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">{{ Setting::get('WEB_NAME') }}</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a></li>
					<li><a href="{{ route('members') }}"><i class="fa fa-users"></i> Members</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello, Guest! <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ route('account-register') }}"><i class="fa fa-pencil"></i> Register</a></li>
								<li class="divider"></li>
								<li><a href="{{ route('account-login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
							</ul>
						</li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello, {{ Auth::user()->firstname }}! <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ route('account') }}"><span class="fa fa-user"></span> My Account</a></li>
								<li class="divider"></li>
								<li><a href="{{ route('account-change-details') }}"><span class="fa fa-pencil-square-o"></span> Change account details</a></li>
								<li><a href="{{ route('account-change-password') }}"><span class="fa fa-asterisk"></span> Change password</a></li>
								<li><a href="{{ route('account-settings') }}"><span class="fa fa-cog"></span> Settings</a></li>
								<li class="divider"></li>
								<li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@if(count($errors) > 0)
		<div class="alert alert-danger alert-fixed-top fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			@if(count($errors) > 1)
				<p><span class="fa fa-exclamation-circle" aria-hidden="true"></span> <strong>Oh snap!</strong> Something went wrong:</p>
				<small>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</small>
			@else
				@foreach ($errors->all() as $error)
					<p><i class="fa fa-exclamation-circle"></i> {{ $error }}</p>
				@endforeach
			@endif
		</div>
	@endif

	@if(Session::has('message'))
		@if(Session::has('messagetype'))
			<div class="alert alert-{{ Session::get('messagetype') }} alert-fixed-top fade in" role="alert">
		@else
			<div class="alert alert-info alert-fixed-top fade in" role="alert">
		@endif
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<p>
				@if(Session::get('messagetype') == 'success')
					<span class="fa fa-info-circle" aria-hidden="true"></span>
				@elseif(Session::get('messagetype') == 'warning')
					<span class="fa fa-exclamation" aria-hidden="true"></span>
				@elseif(Session::get('messagetype') == 'danger')
					<span class="fa fa-exclamation-circle" aria-hidden="true"></span>
				@else
					<span class="fa fa-info-circle" aria-hidden="true"></span>
				@endif
				{{ Session::get('message') }}
			</p>
		</div>
	@endif

	@yield('content')


	<div class="footerwrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 text-muted">
					<p>&copy; {{ Setting::get('WEB_COPYRIGHT') }}</p>
				</div>
				<div class="col-lg-6">
				    <p class="text-right">
				    	<a href="{{ Setting::get('APP_URL') }}" target="_blank">{{ Setting::get('APP_NAME') . ' ' . Setting::get('APP_VERSION') . ' ' . Setting::get('APP_VERSION_TYPE') }}</a> by <a href="https://infihex.com/" target="_blank">Infihex</a>
						<br>
						@if(Config::get('app.debug'))
							<b><span class="text-danger">DEBUG MODE</span></b>
						@endif
						@if(Setting::get('APP_SHOW_RESETDB'))
							<b>&middot; <a href="/resetdb" class="text-danger">RESET DB AND SETTINGS</a></b>
						@endif
						<br>
						<small class="text-muted">Load time: {{ round((microtime(true) - LARAVEL_START), 3) }}s</small>
				    </p>
				</div>
			</div>
		</div>
	</div>


	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="{{ Theme::url('/js/bootstrap.min.js') }}"></script>
	<script src="{{ Theme::url('/js/jasny-bootstrap.min.js') }}"></script>

	<!-- material -->
	<script src="{{ Theme::url('/js/ripples.min.js') }}"></script>
	<script src="{{ Theme::url('/js/material.min.js') }}"></script>
	<script>
		$(document).ready(function() {
		   $.material.init();
		});
	</script>
	<!-- /material -->

</body>
</html>