<?php

namespace LANMS;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info extends Model
{
    
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = [
		'content',
		'author_id',
		'editor_id',
	];
	protected $table = 'info';

	function author() {
		return $this->hasOne('User', 'id', 'author_id');
	}

	function editor() {
		return $this->hasOne('User', 'id', 'editor_id');
	}

	public function scopeGetContent($query, $name) {
		$info = $query->where('name', '=', $name)->first();
		return $info->content;
	}

}
