<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<style type="text/css">
			body {font-family:'Open Sans',sans-serif;overflow:auto;margin:0;font-size:14px;line-height:1.25;color:#333}
			.row {overflow:auto}
			.col-md-6 {width:50%;float:left;display:inline-block}
			.col-md-12 {width:100%;float:left;display:inline-block}
			.text-center {text-align:center}
			.text-muted {color:#999}
			.text-danger {color: #ac1818}
			.text-success {color: #045702}
			small {font-size:95%;color:#999}
			h1 {font-size:8em;margin:0;padding:0}
			h2 {font-size:2em;margin:0;padding:0}
			p {margin:0;padding:0}
			hr {margin-top: 17px;margin-bottom: 17px;border: 0;border-top: 1px solid #eee}
		</style>
	</head>
	<body>	
		<div class="col-md-12 text-center">
			<img src=".{{ Setting::get('WEB_LOGO') }}" style="width:700px;">
			<h1>{{ $seat->name }}</h1>
			<hr>
			<br>
			<h2>@if($seat->reservations->first() <> null){{ $seat->reservations->first()->reservedfor->firstname.' '.$seat->reservations->first()->reservedfor->lastname }}<br><small>{{ $seat->reservations->first()->reservedfor->username }}</small>@endif</h2>
			<br><br>
			<p>
				<strong>Politi:</strong> 610 53 000 (Nød: 112)<br>
				<strong>Ambulanse:</strong> 06200 (Nød: 113)<br>
				<strong>Brannvesenet:</strong> 611 48 000 (Nød: 110)
			</p>
			<br><br>
			<p>For more information, see our website: <strong>{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/</strong></p>
			<br>
		</div>
	</body>
</html>