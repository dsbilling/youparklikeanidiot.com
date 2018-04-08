<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = [
		'address1',
		'address2',
		'postalcode',
		'city',
		'county',
		'country',
		'user_id',
		'main_address'
	];
	protected $table = 'addresses';

	function user() {
		return $this->hasOne('User', 'id', 'user_id');
	}

}
