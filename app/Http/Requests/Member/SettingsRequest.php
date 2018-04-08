<?php

namespace LANMS\Http\Requests\Member;
 
use Illuminate\Foundation\Http\FormRequest;
 
class SettingsRequest extends FormRequest {
	public function rules() {
		return [
			'showemail' 		=> 'integer',
			'showname' 			=> 'integer',
			'showonline' 		=> 'integer',
			'userdateformat' 	=> '',
			'usertimeformat' 	=> '',
		];
	}
	
	public function authorize() {
		return true;
	}
}