<?php 

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeatRows extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'seat_rows';

	protected $fillable = [
		'name',
		'slug',
		'author_id',
		'editor_id',
	];

	function seats() {
		return $this->hasMany('Seats', 'row_id');
	}

	function author() {
		return $this->hasOne('User', 'id', 'author_id');
	}

	function editor() {
		return $this->hasOne('User', 'id', 'editor_id');
	}

}
