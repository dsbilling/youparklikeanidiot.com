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
			h1 {font-size:3em;margin:0;padding:0}
			h2 {font-size:2em;margin:0;padding:0}
			p {margin:0;padding:0}
			hr {margin-top: 17px;margin-bottom: 17px;border: 0;border-top: 1px solid #eee}
		</style>
	</head>
	<body>	
		<div class="col-md-12 text-center">
			<img src=".{{ Setting::get('WEB_LOGO') }}" style="width:700px;">
			<h1>TICKET</h1>
			<hr>
			<h2>{{ $seat->reservationsThisYear()->first()->reservedfor->firstname.' '.$seat->reservationsThisYear()->first()->reservedfor->lastname }}<br><small>{{ $seat->reservationsThisYear()->first()->reservedfor->username }}</small></h2>
			<br>
			<p>This is your ticket for one seat, bring this to the event. Remember that there is one ticket per seat! It is also important that you bring valid identification. If you show up without a ticket or credentials, it will take longer to check you in. </p>
			<br>
			<p>For more information, see our website: <strong>{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/</strong></p>
			<br>
			<div class="row">
				<div class="col-md-6">
					@if(is_null($seat->reservationsThisYear()->first()->payment))
						<h2><strong><small>Paid:</small><br><span class="text-danger">No</span></strong></h2>
					@else
						<h2><strong><small>Paid:</small><br><span class="text-success">Yes</span></strong></h2>
					@endif
				</div>
				<div class="col-md-6">
					<h2><strong><small>Your seat:</small><br>{{ $seat->reservationsThisYear()->first()->seat->name }}</strong></h2>
				</div>
			</div>
			<hr>
			<br><br>
		</div>
		<h1>
			<div style="display:inline-block">{!! DNS1D::getBarcodeHTML($seat->reservationsThisYear()->first()->ticket->barcode, "I25", 4, 40) !!}</div>
			<br><small>{{ $seat->reservationsThisYear()->first()->ticket->barcode }}</small>
		</h1>
	</body>
</html>