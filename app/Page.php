<?php namespace DPSEI;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	protected $table = 'pages';

	protected $fillable = [
		'title',
		'slug',
		'content',
	];

	function author() {
		return $this->hasOne('User', 'id', 'author_id');
	}

	function editor() {
		return $this->hasOne('User', 'id', 'editor_id');
	}

}
