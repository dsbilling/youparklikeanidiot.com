<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{{ Setting::get('WEB_NAME') }}: @yield('subject')</title>
<style>
	*{font-family:"Helvetica Neue",Helvetica,Helvetica,Arial,sans-serif;font-size:100%;line-height:1.6em;margin:0;padding:0}.btn-primary td,h1,h2,h3,h4,p{font-family:"Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif}img{max-width:600px;width:100%}body{-webkit-font-smoothing:antialiased;height:100%;-webkit-text-size-adjust:none;width:100%!important}a{color:#348eda}.btn-primary{Margin-bottom:10px;width:auto!important}.btn-primary td{background-color:#348eda;border-radius:25px;font-size:14px;text-align:center;vertical-align:top}.btn-primary td a{background-color:#348eda;border:1px solid #348eda;border-radius:25px;border-width:10px 20px;display:inline-block;color:#fff;cursor:pointer;font-weight:700;line-height:2;text-decoration:none}.last{margin-bottom:0}.first{margin-top:0}.padding{padding:10px 0}table.body-wrap{padding:20px;width:100%}table.body-wrap .container{border:1px solid #f0f0f0;border-radius:6px}table.footer-wrap{clear:both!important;width:100%}.footer-wrap .container p{color:#666;font-size:12px}table.footer-wrap a{color:#999}h1,h2,h3{color:#111;font-weight:200;line-height:1.2em;margin:40px 0 10px}h1{font-size:36px}h2{font-size:28px}h3{font-size:22px}ol,p,ul{font-size:14px;font-weight:400;margin-bottom:10px}ol li,ul li{margin-left:5px;list-style-position:inside}.container{clear:both!important;display:block!important;Margin:0 auto!important;max-width:600px!important}.body-wrap .container{padding:20px}.content{display:block;margin:0 auto;max-width:600px}.content table{width:100%}img{width:auto;max-width:100%;}hr{height:0;margin-top:17px;margin-bottom:17px;border:0;border-top:1px solid #eee}small{font-size:85%}h4{font-weight:500;line-height:1.1;color:#373e4a;font-size:15px}h4 small{font-weight:400;line-height:1;color:#999;font-size:75%}
</style>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap" bgcolor="#f6f6f6">
	<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">

			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td>
							<img src="{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}{{ Setting::get('WEB_LOGO_ALT') }}"><br>
							<h2>@yield('subject')</h2>
							<hr>
										
							@yield('content')

							<p>&nbsp;</p>
							<p>&mdash; {{ Setting::get('WEB_NAME') }}</p>
						</td>
					</tr>
				</table>
			</div>
			<!-- /content -->

		</td>
		<td></td>
	</tr>
</table>
<!-- /body -->

<!-- footer -->
<table class="footer-wrap">
	<tr>
		<td></td>
		<td class="container">

			<!-- content -->
			<div class="content">
				<table>
					<tr>
						<td align="center">
							<h4><small><em>You received this email because you registered on:</em></small><br><a href="{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}/">{{ Setting::get('WEB_DOMAIN') }}</a></h4>
						</td>
					</tr>
				</table>
			</div>
			<!-- /content -->

		</td>
		<td></td>
	</tr>
</table>
<!-- /footer -->

</body>
</html>