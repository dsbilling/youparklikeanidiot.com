<?php

use Illuminate\Database\Seeder;
use anlutro\LaravelSettings\Facade as Setting;
  
class SettingsTableSeeder extends Seeder {
  
	public function run() {

		Setting::set('APP_NAME', 'LANMS');
		Setting::set('APP_VERSION', '2.4.0');
		Setting::set('APP_VERSION_TYPE', 'Dev');
		Setting::set('APP_URL', 'http://jira.infihex.com/projects/LANMS?selectedItem=com.atlassian.jira.jira-projects-plugin:release-page&status=released-unreleased');
		Setting::set('APP_LICENSE_STATUS', '');
		Setting::set('APP_LICENSE_STATUS_DESC', '');
		Setting::set('APP_LICENSE_LOCAL_KEY', '');
		Setting::set('APP_LICENSE_KEY', '');

		Setting::set('SHOW_RESETDB', true);

		Setting::set('MAIL_MAIN_EMAIL', 'hello@lanms.dev');
		Setting::set('MAIL_NOREPLY_EMAIL', 'noreply@lanms.dev');
		Setting::set('MAIL_SUPPORT_EMAIL', 'support@infihex.com');
		Setting::set('MAIL_SUPPORT_EMAIL_NAME', 'Infihex Support');
		Setting::set('MAIL_DEBUG_EMAIL', 'daniel@infihex.com');
		Setting::set('MAIL_DEBUG_EMAIL_NAME', 'Daniel Billing / Infihex');

		Setting::set('WEB_PROTOCOL', 'http');
		Setting::set('WEB_DOMAIN', 'lanms.dev');
		Setting::set('WEB_PORT', 80);
		Setting::set('WEB_NAME', 'LANMS');
		Setting::set('WEB_LOGO', '/images/lanms.png');
		Setting::set('WEB_LOGO_ALT', '/images/lanms_dark.png');
		Setting::set('WEB_COPYRIGHT', '2015-2017, Infihex');

		Setting::set('SEATING_OPEN', true);
		Setting::set('SEATING_SHOW_MAP', true);
		Setting::set('SEATING_SEAT_EXPIRE_HOURS', 48);
		Setting::set('SEATING_SEAT_PRICE', 300);
		Setting::set('SEATING_SEAT_PRICE_ALT', 350);
		Setting::set('SEATING_SEAT_PRICE_CURRENCY', 'NOK');
		Setting::set('SEATING_YEAR', 2018);

		Setting::set('GOOGLE_MAPS_API_KEY', 'AIzaSyCJDbjolbvN7mYY3SiV6A7SLPCBlHlE-Ow');

		Setting::set('REFERRAL_ACTIVE', True);
		Setting::set('LOGIN_ENABLED', True);

		Setting::set('GOOGLE_ANALYTICS_TRACKING_ID', '');

		Setting::save();
	}

}