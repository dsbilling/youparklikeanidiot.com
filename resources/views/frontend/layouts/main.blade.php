<!DOCTYPE html>
<html lang="en">
<head>

	<title>@yield('title') - {{ Setting::get('WEB_NAME') }}</title>

	<link href="{{ Theme::url('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/toastr.css') }}" rel="stylesheet">
	<link href="{{ Theme::url('css/custom.css') }}" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>


	<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand mb-0 h1" href="{{ url('/') }}">{{ Setting::get('WEB_NAME') }}</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item @if(Request::is('/')){{'active'}} @endif"><a class="nav-link" href="{{ url('/') }}">Hjem</a></li>
					<li class="nav-item @if(Request::is('news')){{'active'}} @endif"><a class="nav-link" href="{{ route('news') }}">Nyheter</a></li>
					@foreach(Page::forMenu() as $page)
						<li class="nav-item @if(Request::is($page->slug)){{'active'}} @endif"><a class="nav-link" href="{{ route('page', $page->slug) }}">{{ $page->title }}</a></li>
					@endforeach
					@if(Sentinel::Guest())
						<ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
							<li class="nav-item"><a class="nav-link" href="{{ route('account-login') }}">Innlogging</a></li>
							<li class="nav-item"><a class="nav-link" href="{{ route('account-register') }}">Registrer</a></li>
						</ul>
					@else
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ \Sentinel::getUser()->firstname.' '.\Sentinel::getUser()->lastname }}</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('account') }}">Account</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('logout') }}"><span class="fa fa-sign-out-alt"></span> Logg ut</a>
							</div>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<main role="main" class="container">
		@yield('content')
	</main>

	<footer class="footer border-top">
		<div class="container">
			<div class="row">
				<div class="col-6 col-md">
					<p>
						&copy; {!! Setting::get('WEB_COPYRIGHT') !!}
						&middot;
						<small class="text-muted"><i class="fa fa-coffee"></i> {{ round((microtime(true) - LARAVEL_START), 3) }}s</small>
						&middot;
						<small><a href="{{ url('/tos') }}">Terms of Service</a></small>
						&middot;
						<small><a href="{{ url('/privacy') }}">Privacy Policy</a></small>
					</p>
				</div>
				<div class="col-6 col-md text-right">
					<p>
						<small>
							<a href="{{ Setting::get('APP_URL') }}" target="_blank">Report a bug</a>
							&middot;
							<a href="{{ Setting::get('APP_URL') }}" target="_blank">{{ Setting::get('APP_NAME') . ' ' . Setting::get('APP_VERSION') . ' ' . Setting::get('APP_VERSION_TYPE') }}</a>
							@if(Config::get('app.debug'))
								<b>&middot; <span class="text-danger">DEBUG MODE</span></b>
							@endif
							@if(Setting::get('APP_SHOW_RESETDB'))
								<b>&middot; <a href="/resetdb" class="text-danger">RESET DB AND SETTINGS</a></b>
							@endif
						</small>
					</p>
				</div>
			</div>
		</div>
	</footer>

	<script src="{{ Theme::url('js/jquery.min.js') }}"></script>
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

	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
	<script>
		window.addEventListener("load", function(){
		window.cookieconsent.initialise({
		  "palette": {
		    "popup": {
		      "background": "#ffffff",
		      "text": "#333333"
		    },
		    "button": {
		      "background": "#444444",
		      "text": "#ffffff"
		    }
		  },
		  "content": {
		    "message": "This website uses cookies to ensure you get the best experience on our website. Do you accept this?",
		    "dismiss": "I ACCEPT",
		    "link": "Learn more",
		    "href": "{{ url('/privacy') }}"
		  }
		})});
	</script>

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
