<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = [
		'name',
		'slug',
		'creator_id',
	];
	protected $table = 'news_categories';

	public function categories() {
		return $this->hasMany('News', 'category_id');
	}

}
