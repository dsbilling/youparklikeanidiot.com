<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model {

	protected $fillable = [
		'ticket_id',
		'bandnumber',
		'year',
	];
	protected $table = 'checkins';

	function ticket() {
		return $this->hasOne('SeatTicket', 'id', 'ticket_id');
	}

	function ticketThisYear() {
		return $this->hasOne('SeatTicket', 'id', 'ticket_id')->thisYear()->first();
	}

	public function scopeThisYear($query) {
		return $query->where('year', '=', \Setting::get('SEATING_YEAR'));
	}

	public function scopeLastYear($query) {
		return $query->where('year', '<', \Setting::get('SEATING_YEAR'));
	}

}
