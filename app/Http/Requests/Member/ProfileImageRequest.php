<?php

namespace DPSEI\Http\Requests\Member;
 
use Illuminate\Foundation\Http\FormRequest;
 
class ProfileImageRequest extends FormRequest {
	public function rules() {
		return [
			'profileimage' 		=> 'image',
		];
	}
	
	public function authorize() {
		return true;
	}
}