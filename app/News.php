<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = [
		'title',
		'content',
		'slug',
		'published_at',
		'category_id',
		'creator_id',
		'editor_id',
		'active'
	];
	protected $table = 'news';

	function category() {
		return $this->hasOne('NewsCategory', 'id', 'category_id');
	}

	function author() {
		return $this->hasOne('User', 'id', 'author_id');
	}

	function editor() {
		return $this->hasOne('User', 'id', 'editor_id');
	}

	function scopeIsPublished($query) {
		return $query->where('published_at', '<', \DB::raw('now()'))->orderBy('published_at', 'desc');
	}

	function scopeIsActive($query) {
		return $query->where('active', '=', true)->orderBy('published_at', 'desc');
	}

}
