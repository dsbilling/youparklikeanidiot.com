<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<title>@yield('title') - {{ Setting::get('WEB_NAME') }}</title>

	<link rel="stylesheet" href="{{ Theme::url('js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="{{ Theme::url('css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/neon-core.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/neon-theme.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/neon-forms.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/custom.css') }}">

	<script src="{{ Theme::url('js/jquery-1.11.0.min.js') }}"></script>
	<script>$.noConflict();</script>

	<!--[if lt IE 9]><script src="{{ Theme::url('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	@yield('css')

</head>
<body class="page-body" data-url="{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif">

<div class="page-container horizontal-menu">

	<header class="navbar navbar-fixed-top">
		
		<div class="navbar-inner">
		
			<div class="navbar-brand">
				<a href="{{ route('home') }}"><img src="{{ Setting::get('WEB_LOGO') }}" width="90" alt="" /></a>
			</div>

			<ul class="navbar-nav">
				<li class="@if(Request::is('user')){{'active'}} @endif"><a href="{{ route('account') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="@if(Request::is('user/members')){{'active'}} @endif"><a href="{{ route('members') }}"><i class="fa fa-users"></i> Members</a></li>
				<li class="@if(Request::is('user/seating')){{'active'}} @endif"><a href="{{ route('seating') }}"><i class="fa fa-street-view"></i> Seating</a></li>
				<!--<li><a href="#"><i class="fa fa-sitemap"></i> Compo</a></li>-->
				@if(Sentinel::hasAccess('admin'))
					<li class="visible-xs"><a href="{{ URL::Route('admin') }}"><i class="fa fa-user-secret"></i> Admin Panel</a></li>
				@endif
				<li class="visible-xs"><a href="{{ URL::Route('logout') }}">Log Out <i class="fa fa-sign-out right"></i></a></li>
			</ul>
			
			<ul class="nav navbar-right pull-right">
				
				@if(Sentinel::hasAccess('admin'))
					<li><a href="{{ URL::Route('admin') }}"><i class="fa fa-user-secret"></i> Admin Panel</a></li>
				@endif
				<li><a href="{{ URL::Route('logout') }}">Log Out <i class="fa fa-sign-out right"></i></a></li>
			
				<li class="visible-xs">	
					<div class="horizontal-mobile-menu visible-xs">
						<a href="#" class="with-animation">
							<i class="fa fa-bars"></i>
						</a>
					</div>
				</li>
				
			</ul>
	
		</div>
		
	</header>
	<div class="main-content">

		@yield('content')

		<div class="row">
			<div class="col-md-12">
				<footer class="main">
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
				</footer>
			</div>
		</div>

	</div>

	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="{{ Theme::url('js/jvectormap/jquery-jvectormap-1.2.2.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('js/rickshaw/rickshaw.min.css') }}">

	<!-- Bottom scripts (common) -->
	<script src="{{ Theme::url('js/gsap/main-gsap.js') }}"></script>
	<script src="{{ Theme::url('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap.js') }}"></script>
	<script src="{{ Theme::url('js/joinable.js') }}"></script>
	<script src="{{ Theme::url('js/resizeable.js') }}"></script>
	<script src="{{ Theme::url('js/neon-api.js') }}"></script>
	<script src="{{ Theme::url('js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>


	<!-- Imported scripts on this page -->
	<script src="{{ Theme::url('js/jvectormap/jquery-jvectormap-europe-merc-en.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.sparkline.min.js') }}"></script>
	<script src="{{ Theme::url('js/rickshaw/vendor/d3.v3.js') }}"></script>
	<script src="{{ Theme::url('js/rickshaw/rickshaw.min.js') }}"></script>
	<script src="{{ Theme::url('js/raphael-min.js') }}"></script>
	<script src="{{ Theme::url('js/morris.min.js') }}"></script>
	<script src="{{ Theme::url('js/toastr.js') }}"></script>
	<script src="{{ Theme::url('js/neon-chat.js') }}"></script>


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
			"timeOut": "10000",
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