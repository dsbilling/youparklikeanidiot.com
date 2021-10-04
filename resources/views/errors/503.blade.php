<html>
	<head>
		<link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
		<title>503</title>
		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #555;
				display: table;
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
				font-weight: lighter;
			}
			.hero {
				font-size: 24px;
				font-weight: bold;
			}
			small {
				font-size:75%;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">Project has been archived!</div>
				<div class="hero">Thanks to all visitors and users of this project.</div>
				<p style="max-width: 24em; margin:1em auto;">This was a project intended for me to learn more about Laravel, but I have not had the time to maintain this anymore. The traffic has also been lower than it used to be, so I cannot see any reason for it to live anymore.<br> &mdash; <a href="https://daniel.rtrd.no/">Daniel S. Billing</a></p>
				{{--
					<div class="title">503</div>
					<div class="hero">{{ trans('global.maintenance') }}</div>
				--}}
			</div>
		</div>
		<script type="text/javascript">   
			function Redirect() 
			{  
				window.location = "https://www.infihex.no"; 
			}
			setTimeout('Redirect()', 10000);   
		</script>
	</body>
</html>