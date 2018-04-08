<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class SeatReservationStatus extends Model {

	protected $table = 'seat_reservation_statuses';

	protected $fillable = [
		'name',
		'slug',
		'reservation_id',
	];

	function reservations() {
		return $this->hasMany('SeatReservations', 'reservation_id');
	}

}
