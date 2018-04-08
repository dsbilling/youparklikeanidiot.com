<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seats extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'seats';

	protected $fillable = [
		'name',
		'slug',
		'row_id',
		'author_id',
		'editor_id',
	];

	function row() {
		return $this->hasOne('SeatRows', 'id', 'row_id');
	}

	function reservations() {
		return $this->hasMany('SeatReservation', 'seat_id', 'id');
	}

	function reservationsThisYear() {
        return $this->hasMany('SeatReservation', 'seat_id', 'id')->thisYear();
    }

    function author() {
		return $this->hasOne('User', 'id', 'author_id');
	}

	function editor() {
		return $this->hasOne('User', 'id', 'editor_id');
	}
	
}
