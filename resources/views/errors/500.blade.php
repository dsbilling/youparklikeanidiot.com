<html>
	<head>
		<link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
		<title>500</title>
		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #555;
				display: table;
				font-weight: 300;
				font-family: 'Lato';
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 72px;
				margin-bottom: 40px;
			}

			.hero {
				font-size: 20px;
			}
			small {
				font-size:75%;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">500</div>
				<div class="hero">Oops! We track these errors automatically, but if the problem persists feel free to contact us.<br>In the meantime, try refreshing.</div>
				@if(app()->bound('sentry') && !empty(Sentry::getLastEventID()))
					<div class="subtitle">Error ID: {{ Sentry::getLastEventID() }}</div>
					<script src="{{ asset('/js/jquery.min.js') }}"></script>
					<script src="https://cdn.ravenjs.com/3.15.0/raven.min.js"></script>
					<script>
						Raven.showReportDialog({
							eventId: '{{ Sentry::getLastEventID() }}',
							// use the public DSN (dont include your secret!)
							dsn: '{{ env("SENTRY_PUBLIC_DSN") }}'
						});
					</script>
				@endif
			</div>
		</div>
	</body>
</html>