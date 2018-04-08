<?php namespace LANMS;

use Illuminate\Database\Eloquent\Model;

class BrokenBand extends Model {

	protected $table = 'broken_bands';

	protected $fillable = [
		'checkin_id',
		'previous_bandnumber',
		'new_bandnumber',
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

}
