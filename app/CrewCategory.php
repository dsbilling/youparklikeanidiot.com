<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrewCategory extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $table = 'crew_categories';

	protected $fillable = [
		'title',
		'slug',
		'author_id',
		'editor_id',
		'active',
	];

	function crew() {
		return $this->hasMany('Crew', 'category_id', 'id');
	}

	function crewThisYear() {
        return $this->hasMany('Crew', 'category_id', 'id')->thisYear();
    }

	function author() {
		return $this->hasOne('User', 'id', 'author_id');
	}

	function editor() {
		return $this->hasOne('User', 'id', 'editor_id');
	}

}
