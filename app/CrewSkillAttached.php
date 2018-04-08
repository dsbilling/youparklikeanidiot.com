<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrewSkillAttached extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $table = 'crew_skill_attached';

	protected $fillable = [
		'user_id',
		'skill_id',
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

	function skill() {
		return $this->hasOne('CrewSkill', 'id', 'skill_id');
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

}
