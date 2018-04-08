<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class SeatTicket extends Model {

	protected $table = 'seat_tickets';

	protected $fillable = [
		'barcode',
		'reservation_id',
		'user_id',
		'checkin_id',
		'year',
	];

	function reservation() {
		return $this->hasOne('SeatReservation', 'id', 'reservation_id');
	}

	function user() {
		return $this->hasOne('User', 'id', 'user_id');
	}

	function checkin() {
		return $this->hasOne('Checkin', 'id', 'checkin_id');
	}

	public function scopeNoCheckin($query) {
		return $query->where('checkin_id', '=', 0);
	}

	public function scopeThisYear($query) {
		return $query->where('year', '=', \Setting::get('SEATING_YEAR'));
	}

	public function scopeLastYear($query) {
		return $query->where('year', '<', \Setting::get('SEATING_YEAR'));
	}


}
