<?php 

namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class StripeCustomer extends Model
{

	protected $table = 'stripe_customers';

	protected $fillable = [
		'cus',
		'user_id',
	];

	function user() {
		return $this->hasOne('LANMS\User', 'id', 'user_id');
	}

}
