<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>@yield('title') - {{ Setting::get('WEB_NAME') }}</title>

	<link href="{{ Theme::url('css/materialize.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/style.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/toastr.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/custom.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<script src="{{ Theme::url('js/jquery-1.11.0.min.js') }}"></script>
	<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="{{ Theme::url('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>

<div class="wrap">

<div class="highlighted parallax-container">
	<a class="logo" href="{{ url('/') }}">
		<img src="{{ asset('images/downlink.png') }}" alt="logo" width="600">
	</a>
	<div class="parallax"><img src="{{ asset('images/lan.jpg') }}" alt="mountain fog" /></div>
</div>

<header class="white z-depth-1">
	<div class="container">

		<div class="row">

			<div class="col s12">
				<nav>
					<div class="nav-wrapper">
						<a class="button-collapse" href="#" data-activates="nav-mobile">
							<i class="mdi-navigation-menu"></i>
						</a>

						<ul class="desktop-menu hide-on-med-and-down">
							<li class="@if(Request::is('/')){{'active'}} @endif"><a href="{{ url('/') }}"><span>Home</span></a></li>
						</ul>

					</div>
				</nav>
			</div>
		</div>

	</div>
</header>

<div class="main-content">
	@yield('content')
</div>

<footer class="white z-depth-1 center">
	<div class="container">

		<div class="row">
			<div class="col s12">
				<p>
					<a href="{{ Setting::get('APP_URL') }}" target="_blank">{{ Setting::get('APP_NAME') . ' ' . Setting::get('APP_VERSION') . ' ' . Setting::get('APP_VERSION_TYPE') }}</a> by <a href="https://infihex.com/" target="_blank">Infihex</a>
					<br>
					<small class="text-muted">Load time: {{ round((microtime(true) - LARAVEL_START), 3) }}s</small>
				</p>
				</div>
			</div>

		<a class="back-to-top btn-floating btn-large waves-effect waves-light blue-grey darken-1" href="#header"><i class="mdi-navigation-expand-less"></i></a>

	</div>
</footer>

</div>

	<!-- Bottom scripts (common) -->
	<script src="{{ Theme::url('js/jquery-2.1.1.min.js') }}"></script>
	<script src="{{ Theme::url('js/materialize.min.js') }}"></script>
	<script src="{{ Theme::url('js/retina.min.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.smooth-scroll.min.js') }}"></script>
	<script src="{{ Theme::url('js/app.js') }}"></script>
	<script src="{{ Theme::url('js/custom.js') }}"></script>

	@if(Setting::get('GOOGLE_ANALYTICS_TRACKING_ID'))
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', '{{ Setting::get('GOOGLE_ANALYTICS_TRACKING_ID') }}', 'auto');
			ga('send', 'pageview');
		</script>
	@endif

</body>
</html>
