<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model {

	protected $fillable = [
		'fullname',
		'phonenumber',
		'bandnumber',
		'year',
	];
	protected $table = 'visitors';

	public function scopeGetExpireTime($query, $id) {

		$visitor = $query->where('id', '=', $id)->first();

		$time			= strtotime('+24 hours', strtotime($visitor->created_at));

		$SECOND 	= 1;
		$MINUTE 	= 60 * $SECOND;
		$HOUR 		= 60 * $MINUTE;
		$DAY 		= 24 * $HOUR;
		$MONTH 		= 30 * $DAY;
		$after 		= $time - time();

		if ($after < 0) {
			return "expired";
		}

		if ($time == '0000-00-00 00:00:00') {
			return "never";
		}

		if ($after < 1 * $MINUTE) {
			return ($after <= 1) ? "right now" : $after . " seconds";
		}

		if ($after < 2 * $MINUTE) {
			return "a minute";
		}

		if ($after < 45 * $MINUTE) {
			return floor($after / 60) . " minutes";
		}

		if ($after < 90 * $MINUTE) {
			return "an hour";
		}

		if ($after < 24 * $HOUR) {
			return (floor($after / 60 / 60) == 1 ? 'about an hour' : floor($after / 60 / 60).' hours');
		}

		if ($after < 48 * $HOUR) {
			return "two days";
		}

		if ($after < 30 * $DAY) {
			return floor($after / 60 / 60 / 24) . " days";
		}

		if ($after < 12 * $MONTH) {
			$months = floor($after / 60 / 60 / 24 / 30);
			return $months <= 1 ? "one month" : $months . " months";
		} else {
			$years = floor  ($after / 60 / 60 / 24 / 30 / 12);
			return $years <= 1 ? "one year" : $years." years";
		}

	}

	public function scopeThisYear($query) {
		return $query->where('year', '=', \Setting::get('SEATING_YEAR'));
	}

	public function scopeLastYear($query) {
		return $query->where('year', '<', \Setting::get('SEATING_YEAR'));
	}

}
