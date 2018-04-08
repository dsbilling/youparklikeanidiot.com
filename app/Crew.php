<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crew extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'crew';

	protected $fillable = [
		'user_id',
		'category_id',
		'year',
		'author_id',
		'editor_id',
	];

	public function scopeThisYear($query) {
		return $query->where('year', '=', \Setting::get('SEATING_YEAR'));
	}

	public function scopeLastYear($query) {
		return $query->where('year', '<', \Setting::get('SEATING_YEAR'));
	}

	function category() {
		return $this->hasOne('CrewCategory', 'id', 'category_id');
	}

	function author() {
		return $this->hasOne('User', 'id', 'author_id');
	}

	function editor() {
		return $this->hasOne('User', 'id', 'editor_id');
	}

	function user() {
		return $this->hasOne('User', 'id', 'user_id');
	}

	function skillAttached() {
		return $this->hasMany('CrewSkillAttached', 'user_id', 'id');
	}

	function skillAttachedThisYear() {
		return $this->hasMany('CrewSkillAttached', 'user_id', 'id')->thisYear();
	}

}
