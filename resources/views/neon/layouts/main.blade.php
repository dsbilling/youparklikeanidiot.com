<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>@yield('title') - {{ Setting::get('WEB_NAME') }}</title>

	<link href="{{ Theme::url('css/bootstrap.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link href="{{ Theme::url('css/neon.css') }}" rel="stylesheet">

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
	
<!-- Logo and Navigation -->
<div class="site-header-container container">
	<div class="row">
		<div class="col-md-12">
			<header class="site-header">
				<section class="site-logo">
					<a href="{{ url('/') }}"><img src="{{ Setting::get('WEB_LOGO_ALT') }}" width="120" /></a>
				</section>
				<nav class="site-nav">
					<ul class="main-menu hidden-xs" id="main-menu">
						<li class="@if(Request::is('/')){{'active'}} @endif"><a href="{{ url('/') }}"><span>Home</span></a></li>
						@foreach($pagesinmenu as $page)
							<li class="@if(Request::is($page->slug)){{'active'}} @endif"><a href="{{ route('page', $page->slug) }}"><span>{{ $page->title }}</span></a></li>
						@endforeach
						@if(Sentinel::Guest())
							<li><a href="{{ route('account-login') }}"><span>Login</span></a></li>
						@else
							<li><a href="{{ route('account') }}"><span>Go to Dashboard</span></a></li>
						@endif
					</ul>
					<div class="visible-xs">
						<a href="#" class="menu-trigger"><i class="entypo-menu"></i></a>
					</div>
				</nav>
			</header>
		</div>
	</div>
</div>
	
@yield('content')

<!-- Site Footer -->
<footer class="site-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<p>&copy; {{ Setting::get('WEB_COPYRIGHT') }}</p>
				<p class="text-muted"><small>Load time: {{ round((microtime(true) - LARAVEL_START), 3) }}s</small></p>
			</div>
			<div class="col-md-6 text-right">
				<p>
					<a href="{{ Setting::get('APP_URL') }}" target="_blank">{{ Setting::get('APP_NAME') . ' ' . Setting::get('APP_VERSION') . ' ' . Setting::get('APP_VERSION_TYPE') }}</a> by <a href="https://infihex.com/" target="_blank">Infihex</a>
				</p>
				<p>
					@if(Config::get('app.debug'))
						<b><span class="text-danger">DEBUG MODE</span></b>
					@endif
					@if(Config::get('app.debug') && Setting::get('SHOW_RESETDB'))
						<b>&middot; <a href="/resetdb" class="text-danger">RESET DB AND SETTINGS</a></b>
					@endif 
				</p>
			</div>
		</div>
	</div>
</footer>	
</div>


	<!-- Bottom scripts (common) -->
	<script src="{{ Theme::url('js/gsap/main-gsap.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap.js') }}"></script>
	<script src="{{ Theme::url('js/joinable.js') }}"></script>
	<script src="{{ Theme::url('js/resizeable.js') }}"></script>
	<script src="{{ Theme::url('js/neon-slider.js') }}"></script>
	<script src="{{ Theme::url('js/toastr.js') }}"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="{{ Theme::url('js/neon-custom.js') }}"></script>

	<script type="text/javascript">

		var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-bottom-right",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};

		@if(Session::has('message') && Session::has('messagetype'))
			@if(Session::get('messagetype') == 'info')
				toastr.info("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@elseif(Session::get('messagetype') == 'warning')
				toastr.warning("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@elseif(Session::get('messagetype') == 'error')
				toastr.error("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@elseif(Session::get('messagetype') == 'success')
				toastr.success("{{ Session::get('message') }}", String("{{ Session::get('messagetype') }}").toUpperCase(), opts);
			@endif

		@endif

	</script>

	@yield('javascript')

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