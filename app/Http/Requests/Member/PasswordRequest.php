<?php

namespace LANMS\Http\Requests\Member;
 
use Illuminate\Foundation\Http\FormRequest;
 
class PasswordRequest extends FormRequest {
	public function rules() {
		return [
			'current_password' 		=> 'required',
			'password'				=> 'required|confirmed|min:8|max:64|not_in:current_password',
		];
	}
	
	public function authorize() {
		return true;
	}
}