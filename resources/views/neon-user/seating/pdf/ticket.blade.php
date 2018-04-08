<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<style type="text/css">
			body {font-family:'Open Sans',sans-serif;overflow:auto;margin:0;font-size:14px;line-height:1.25;color:#333}
			.row {width:100%;overflow:auto;margin-top: 17px;margin-bottom: 17px;display:inline-block}
			.col-md-12 {width:100%;float:left;display:inline-block}
			.text-center {text-align:center}
			.text-muted {color:#999}
			.text-danger {color: #ac1818}
			.text-success {color: #045702}
			.clms {margin-top: 17px;margin-bottom: 17px;border-top: 1px solid #eee;border-bottom: 1px solid #eee; display: block; height: 80px;}
			.clms:after {content:".";display:block;height:0;visibility:hidden;clear: both;}
			small {font-size:95%;color:#999}
			h1 {font-size:3em;margin:0;padding:0}
			h2 {font-size:2em;margin:0;padding:0}
			p {margin:0;padding:0}
			hr {margin-top: 17px;margin-bottom: 17px;border: 0;border-top: 1px solid #eee}
		</style>
	</head>
	<body>	
		<div class="col-md-12">
			<div class="text-center">
				<br>
				<img src=".{{ Setting::get('WEB_LOGO') }}" style="max-width:50%;display: inline-block;">
				<br>
				<h1>TICKET</h1>
				<br>
			</div>
			<hr>
			<h2 class="text-center">{{ $currentseat->reservationsThisYear()->first()->reservedfor->firstname.' '.$currentseat->reservationsThisYear()->first()->reservedfor->lastname }}<br><small>{{ $currentseat->reservationsThisYear()->first()->reservedfor->username }}</small></h2>
			<br>
			<p>This is your ticket, for one seat, bring this to the event. Remember that there is one ticket per seat! It is also important that you bring valid identification. If you show up without a ticket or credentials, we cannot check you in to the event. If you need a consent form, remember to bring that as well.</p>
			<br>
			<p>For more information, go to our website: <strong>{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/</strong></p>
			<div class="text-center clms">
				<div style="width:50%;float:left;">
					@if(is_null($currentseat->reservationsThisYear()->first()->payment))
						<h2><strong><small>Paid:</small><br><span class="text-danger">No</span></strong></h2>
					@else
						<h2><strong><small>Paid:</small><br><span class="text-success">Yes</span></strong></h2>
					@endif
				</div>
				<div style="width:50%;float:right;">
					<h2><strong><small>Your seat:</small><br>{{ $currentseat->reservationsThisYear()->first()->seat->name }}</strong></h2>
				</div>
			</div>
			
			<div style="padding-top: 20px">
				<img style="display: inline-block;" src="data:image/png;base64,{{ DNS1D::getBarcodePNG($currentseat->reservationsThisYear()->first()->ticket->barcode, "I25", 4, 40) }}" />
				<br>
				<h1><small>{{ $currentseat->reservationsThisYear()->first()->ticket->barcode }}</small></h1>
			</div>
		</div>
	</body>
</html>