<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeatReservation extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $table = 'seat_reservations';

	protected $fillable = [
		'seat_id',
		'reservedby_id',
		'reservedfor_id',
		'payment_id',
		'ticket_id',
		'status_id',
		'year',
		'reminder_email_sent',
	];

	function reservedfor() {
		return $this->hasOne('User', 'id', 'reservedfor_id');
	}

	function reservedby() {
		return $this->hasOne('User', 'id', 'reservedby_id');
	}

	function payment() {
		return $this->hasOne('SeatPayment', 'id', 'payment_id');
	}

	function ticket() {
		return $this->hasOne('SeatTicket', 'id', 'ticket_id');
	}

	function status() {
		return $this->hasOne('SeatReservationStatus', 'id', 'status_id');
	}

	function seat() {
		return $this->hasOne('Seats', 'id', 'seat_id');
	}

	public function scopeThisYear($query) {
		return $query->where('year', '=', \Setting::get('SEATING_YEAR'));
	}

	public function scopeThisYearDecending($query) {
		return $query->where('year', '=', \Setting::get('SEATING_YEAR'))->orderBy('year', 'DESC');
	}

	public function scopeLastYear($query) {
		return $query->where('year', '<', \Setting::get('SEATING_YEAR'));
	}

	public function scopeLastYearDecending($query) {
		return $query->where('year', '<', \Setting::get('SEATING_YEAR'))->orderBy('year', 'DESC');
	}

	public function scopePaid($query) {
		if(SeatPayment::where('reservation_id', '=', $this->id)->first() == null) {
			return false;
		} else {
			return true;
		}
	}

	public function scopeGetExpireTime($query, $id) {

		$reservation 	= $query->where('id', '=', $id)->first();

		if($reservation->status_id == 1) { // 1 = reserved
			return "never";
		}

		$time			= strtotime('+'.\Setting::get('SEATING_SEAT_EXPIRE_HOURS').' hours', strtotime($reservation->created_at));

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

	public function scopeGetRealExpireTime($query, $id) {

		$reservation 	= $query->where('id', '=', $id)->first();

		$time			= strtotime('+'.\Setting::get('SEATING_SEAT_EXPIRE_HOURS').' hours', strtotime($reservation->created_at));

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

	public function expiretimeinhours() {

		$time			= strtotime('+'.\Setting::get('SEATING_SEAT_EXPIRE_HOURS').' hours', strtotime($this->created_at));

		$SECOND 	= 1;
		$MINUTE 	= 60 * $SECOND;
		$HOUR 		= 60 * $MINUTE;
		$DAY 		= 24 * $HOUR;
		$MONTH 		= 30 * $DAY;
		$after 		= $time - time();

		if ($after < 0) {
			return 0; // expired
		}

		return floor($after / 60 / 60);

	}

}
