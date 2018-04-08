<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
		<style type="text/css">
			body {font-family:'Open Sans',sans-serif;overflow:auto;margin:0;font-size:14px;line-height:1.25;color:#333}
			.row {overflow:auto}
			.col-md-12 {width:100%;float:left;display:inline-block}
			.text-center {text-align:center}
			.text-muted {color:#999}
			.text-danger {color: #ac1818}
			.text-success {color: #045702}
			small {font-size:95%;color:#999}
			h1 {font-size:2.5em;margin:0;padding:0}
			h2 {font-size:1.5em;margin:0;padding:0}
			p {margin:0;padding:0;margin-bottom:20px;font-size:13px;line-height:15px}
			hr {margin-top: 17px;margin-bottom: 17px;border: 0;border-top: 1px solid #eee}
		</style>
	</head>
	<body>
		<div class="row">
			<div class="col-md-12">
				<img src=".{{ Setting::get('WEB_LOGO') }}" style="width:auto;height:auto;max-width:700px;max-height:125px;">
				<h1 class="text-center">Samtykkeskjema<br><small>{{ Setting::get('WEB_NAME') }} {{ Setting::get('SEATING_YEAR') }}</small></h1>
				<hr>
				<p>Alle deltakere under 16 år må ha med seg skriftlig tillatelse fra foresatte til å være med på arrangementet. Mindreårige deltakere som ikke har tillatelse er vi dessverre nødt til å avvise. Downlink har ingen aldersgrense, men vi anbefaler at deltakere under 16 år ikke kommer alene.</p>
				<p>Vi kan ikke gi noen personlig garanti under arrangementet, men vi gjør vårt ytterste for å sørge for at deltakerne får en minnerik vinterferie. </p>
				<p>
					<strong>Informasjon til foreldre</strong>
					<br>
					Vi har samlet informasjon til foreldre på nettsidene våre;
					<br>
					<strong><em>{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/tilforeldre</em></strong>
				</p>
				<hr>
				<h2>Tillatelse til å delta på {{ Setting::get('WEB_NAME') }} {{ Setting::get('SEATING_YEAR') }}</h2>
				<p>Jeg gir med dette tillatelse til at <strong>{{ strtoupper(Sentinel::getUser()->firstname . ' ' . Sentinel::getUser()->lastname) }}</strong> som er født @if(Sentinel::getUser()->birthdate)<strong>{{ Sentinel::getUser()->birthdate }}</strong>@else{{ '__________________' }}@endif kan delta på arrangementet &quot;{{ Setting::get('WEB_NAME') }} {{ Setting::get('SEATING_YEAR') }}&quot; i {{ LANMS\Info::getContent('where') }} {{ LANMS\Info::getContent('when') }}.</p>
				<p>Mitt forhold til deltakeren (sett strek under); <strong><em>mor</em></strong>, <strong><em>far</em></strong> eller <strong><em>annen omsorgsperson</em></strong> (spesifiser under).<br>______________________________________________________________________</p>
				<p>Kontaktinformasjon til omsorgsperson (om det skulle bli nødvendig):</p>
				<p>Fulltnavn: ____________________________________________________________________<br>Telefonnummer: _________________________________</p>
				<p>Jeg kan treffes på telefon hele døgnet om det skulle oppstå en nødsituasjon og jeg er inneforstått med at arrangøren kan ringe for å kontrollere gyldigheten av denne tillatelsen.</p>
				<div class="row">
					<div style="width:50%;float:left;display:inline-block">
						<p>Sted og dato:<br><br>_________________________________________________</p>
					</div>
					<div style="width:50%;float:right;display:inline-block">
						<p>Signatur:<br><br>_________________________________________________</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>