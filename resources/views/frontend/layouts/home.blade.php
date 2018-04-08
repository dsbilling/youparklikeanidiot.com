<!DOCTYPE html>
<html lang="en">
<head>

	<title>@yield('title') - {{ Setting::get('WEB_NAME') }}</title>

	<link href="{{ Theme::url('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/toastr.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/cover.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/custom.css') }}" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body class="text-center" style="background: url('{{ asset('images/parking.jpg') }}') no-repeat center center fixed">

	<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">

		<header class="masthead mb-auto">
			<div class="inner">
				<h3 class="masthead-brand"><a href="{{ url('/') }}">{{ Setting::get('WEB_NAME') }}</a></h3>
				<nav class="nav nav-masthead justify-content-center">
					<a class="nav-link @if(Request::is('/')){{'active'}} @endif" href="{{ url('/') }}">Home</a>
					@foreach(Page::forMenu() as $page)
						<a class="nav-link @if(Request::is($page->slug)){{'active'}} @endif" href="{{ route('page', $page->slug) }}">{{ $page->title }}</a>
					@endforeach
					@if(Sentinel::Guest())
						<a class="nav-link" href="{{ route('account-login') }}">Login</a>
						<a class="nav-link" href="{{ route('account-register') }}">Register</a>
					@else
						<a class="nav-link @if(Request::is('/')){{'active'}} @endif" href="{{ route('account') }}"><em>Go to Dashboard  <span class="fa fa-arrow-right"></span></em></a>
					@endif
				</nav>
			</div>
		</header>

		<main role="main" class="inner cover">
			@yield('content')
		</main>


		<footer class="mastfoot mt-auto">
			<div class="inner">
				<p>
					&copy; {{ Setting::get('WEB_COPYRIGHT') }}
					<br/>
					<small>
						<i class="fa fa-coffee"></i> {{ round((microtime(true) - LARAVEL_START), 3) }}s
						&middot;
						<a href="{{ Setting::get('APP_URL') }}" target="_blank">Report a bug</a>
						&middot;
						{{ Setting::get('APP_NAME') . ' ' . Setting::get('APP_VERSION') . ' ' . Setting::get('APP_VERSION_TYPE') }}
						@if(Config::get('app.debug'))
							<b>&middot; <span class="text-danger">DEBUG MODE</span></b>
						@endif
						@if(Setting::get('APP_SHOW_RESETDB'))
							<b>&middot; <a href="/resetdb" class="text-danger">RESET DB AND SETTINGS</a></b>
						@endif
					</small>
				</p>
			</div>
		</footer>
	
	</div>

	<script src="{{ Theme::url('js/jquery-slim.min.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ Theme::url('js/custom.js') }}"></script>
	<script src="{{ Theme::url('js/toastr.js') }}"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

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