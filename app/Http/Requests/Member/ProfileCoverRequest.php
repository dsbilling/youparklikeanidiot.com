<?php

namespace DPSEI\Http\Requests\Member;
 
use Illuminate\Foundation\Http\FormRequest;
 
class ProfileCoverRequest extends FormRequest {
	public function rules() {
		return [
			'profilecover' 		=> 'image',
		];
	}
	
	public function authorize() {
		return true;
	}
}