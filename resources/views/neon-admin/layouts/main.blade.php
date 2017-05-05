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
	<link rel="stylesheet" href="{{ Theme::url('css/font-icons/entypo/css/entypo.css') }}">
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

<div class="page-container">

	<div class="sidebar-menu">
		<div class="sidebar-menu-inner">
			<header class="logo-env">
				<div class="logo">
					<a href="{{ route('account') }}"><img src="{{ Setting::get('WEB_LOGO') }}" alt="" width="120"></a>
				</div>
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation">
						<i class="entypo-menu"></i>
					</a>
				</div>
			</header>
			<div id="main-menu" class="main-menu">
				<li class="@if(Request::is('admin')){{'active'}} @endif">
					<a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> <span class="title">Admin Dashboard</span></a>
				</li>
				<li class="@if(Request::is('admin/members')){{'active'}} @endif">
					<a href="{{ route('admin') }}"><i class="fa fa-users"></i> <span class="title">Members</span></a>
				</li>
				<li class="@if(Request::is('admin/news*')){{'active opened'}} @endif has-sub root-level">
					<a><i class="fa fa-newspaper-o"></i> <span class="title">News</span></a>
					<ul>
						<li class="@if(Request::is('admin/news*') && !Request::is('admin/news/categories*')){{'active'}} @endif"><a href="{{ route('admin-news') }}"><i class="fa fa-list-alt"></i> <span class="title">Articles</span></a></li>
						<li class="@if(Request::is('admin/news/categories*')){{'active'}} @endif"><a href="{{ route('admin-news-category') }}"><i class="fa fa-tag"></i> <span class="title">Categories</span></a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fa fa-shopping-basket"></i> <span class="title">Webshop</span></a></li>
				<li class="@if(Request::is('admin/seating*')){{'active opened'}} @endif has-sub root-level">
					<a><i class="fa fa-street-view"></i> <span class="title">Seating</span></a>
					<ul>
						<li class="@if(Request::is('admin/seating/reservation*')){{'active'}} @endif"><a href="{{ route('admin-seating-reservations') }}"><i class="fa fa-hand-paper-o"></i> <span class="title">Reservations</span></a></li>
						<li class="@if(Request::is('admin/seating/checkin*') && !Request::is('admin/seating/checkin/visitor*')){{'active'}} @endif"><a href="{{ route('admin-seating-checkin') }}"><i class="fa fa-check"></i> <span class="title">Check-in</span></a></li>
						<li class="@if(Request::is('admin/seating/checkin/visitor*')){{'active'}} @endif"><a href="{{ route('admin-seating-checkin-visitor') }}"><i class="fa fa-reddit-alien"></i> <span class="title">Visitor Check-in</span></a></li>
					</ul>
				</li>
				<li><a href="#"><i class="fa fa-sitemap"></i> <span class="title">Compo</span></a></li>
				<li class="@if(Request::is('admin/pages')){{'active'}} @endif">
					<a href="{{ route('admin-pages') }}"><i class="fa fa-file-text"></i> <span class="title">Pages</span></a>
				</li>
				<li class="@if(Request::is('admin/print')){{'active'}} @endif">
					<a href="{{ route('admin-print') }}"><i class="fa fa-print"></i> <span class="title">Print</span></a>
				</li>
				<li class="@if(Request::is('admin/settings*')){{'active opened'}} @endif">
					<a href="{{ route('admin-settings') }}"><i class="fa fa-cog"></i> <span class="title">Settings</span></a>
				</li>
			</div>
		</div>
	</div>

	<div class="main-content">

		<div class="row">
			<div class="col-md-6 col-sm-8 clearfix">
				<ul class="user-info pull-left pull-none-xsm">
					<li class="profile-info dropdown">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
							<img src="@if(Sentinel::getUser()->profilepicturesmall){{ Sentinel::getUser()->profilepicturesmall }} @else {{ '/images/profilepicture/0_small.png' }}@endif" alt="" class="img-circle" width="44" />
							{{ Sentinel::getUser()->firstname }}@if(Sentinel::getUser()->showname && Sentinel::getUser()->lastname) {{ Sentinel::getUser()->lastname }}@endif
							@if(Sentinel::getUser()->showonline)
								<a href="#" class="user-status is-{{ User::getOnlineStatus(Sentinel::getUser()->id) }} tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="{{ ucfirst(User::getOnlineStatus(Sentinel::getUser()->id)) }}"></a>
								<!-- User statuses available classes "is-online", "is-offline", "is-idle", "is-busy" -->
							@endif
						</a>
						<ul class="dropdown-menu">
							<li class="caret"></li>
							<li><a href="{{ route('user-profile', Sentinel::getUser()->username) }}"><i class="fa fa-user"></i> View Profile</a></li>
							<li><a href="{{ route('account-change-details') }}"><i class="fa fa-edit"></i> Edit Profile Details</a></li>
							<li><a href="{{ route('account-change-password') }}"><i class="fa fa-asterisk"></i> Change Password</a></li>
							<li><a href="{{ route('account-change-images') }}"><i class="fa fa-picture-o"></i> Change Profile Images</a></li>
							<li><a href="{{ route('account-settings') }}"><i class="fa fa-cog"></i> Edit Profile Settings</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="col-md-6 col-sm-4 clearfix hidden-xs">
				<ul class="list-inline links-list pull-right">
					<li><a href="{{ route('logout') }}">Log Out <i class="entypo-logout right"></i></a></li>
				</ul>
			</div>
		
		</div>
		
		<hr />

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

	<!-- Bottom scripts (common) -->
	<script src="{{ Theme::url('js/gsap/main-gsap.js') }}"></script>
	<script src="{{ Theme::url('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap.js') }}"></script>
	<script src="{{ Theme::url('js/joinable.js') }}"></script>
	<script src="{{ Theme::url('js/resizeable.js') }}"></script>
	<script src="{{ Theme::url('js/neon-api.js') }}"></script>
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

</body>
</html>