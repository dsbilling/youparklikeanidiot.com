<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class SeatPayment extends Model {

	protected $table = 'seat_payments';

	protected $fillable = [
		'stripecharge',
		'user_id',
		'reservation_id',
	];

	function user() {
		return $this->hasOne('User', 'id', 'user_id');
	}

	function reservation() {
		return $this->hasOne('SeatReservation', 'id', 'reservation_id');
	}

}
