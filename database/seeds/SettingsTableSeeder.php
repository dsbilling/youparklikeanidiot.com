<?php

use Illuminate\Database\Seeder;
use anlutro\LaravelSettings\Facade as Setting;
  
class SettingsTableSeeder extends Seeder {
  
	public function run() {

		Setting::set('APP_NAME', 'DPSEI');
		Setting::set('APP_VERSION', '0.1.0');
		Setting::set('APP_VERSION_TYPE', 'Dev');
		Setting::set('APP_URL', 'http://jira.infihex.com/projects/DPSEI/issues/?filter=allopenissues');
		Setting::set('APP_SHOW_RESETDB', true);

		Setting::set('MAIL_MAIN_EMAIL', 'hello@dpsei.dev');
		Setting::set('MAIL_NOREPLY_EMAIL', 'noreply@dpsei.dev');
		Setting::set('MAIL_SUPPORT_EMAIL', 'support@infihex.com');
		Setting::set('MAIL_SUPPORT_EMAIL_NAME', 'Infihex Support');
		Setting::set('MAIL_DEBUG_EMAIL', 'daniel@infihex.com');
		Setting::set('MAIL_DEBUG_EMAIL_NAME', 'Daniel Billing / Infihex');

		Setting::set('WEB_PROTOCOL', 'http');
		Setting::set('WEB_DOMAIN', 'dpsei.io');
		Setting::set('WEB_PORT', 80);
		Setting::set('WEB_NAME', 'duparkerersomenidiot.no');
		Setting::set('WEB_LOGO', '/images/lanms.png');
		Setting::set('WEB_LOGO_ALT', '/images/lanms_dark.png');
		Setting::set('WEB_COPYRIGHT', '2017-2018, <a href="https://infihex.com/" target="_blank">Infihex</a>');

		Setting::set('GOOGLE_MAPS_API_KEY', 'AIzaSyCJDbjolbvN7mYY3SiV6A7SLPCBlHlE-Ow');

		Setting::set('REFERRAL_ACTIVE', True);
		Setting::set('LOGIN_ENABLED', True);

		Setting::set('GOOGLE_ANALYTICS_TRACKING_ID', '');

		Setting::save();
	}

}