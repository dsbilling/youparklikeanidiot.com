<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sponsor extends Model
{
    
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = [
		'name',
		'url',
		'description',
		'image',
		'author_id',
		'editor_id',
	];
	protected $table = 'sponsors';

	function author() {
		return $this->hasOne('User', 'id', 'author_id');
	}

	function editor() {
		return $this->hasOne('User', 'id', 'editor_id');
	}
	
	public function scopeThisYear($query) {
		return $query->where('year', '=', \Setting::get('SEATING_YEAR'));
	}

	public function scopeLastYear($query) {
		return $query->where('year', '<', \Setting::get('SEATING_YEAR'));
	}

}
