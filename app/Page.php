<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $table = 'pages';

	protected $fillable = [
		'title',
		'slug',
		'content',
		'active'
	];

	function author() {
		return $this->hasOne('User', 'id', 'author_id');
	}

	function editor() {
		return $this->hasOne('User', 'id', 'editor_id');
	}

	function scopeForMenu($query) {
		return $this->where('active', '=', 1)->where('showinmenu', '=', 1)->get();
	}

}
