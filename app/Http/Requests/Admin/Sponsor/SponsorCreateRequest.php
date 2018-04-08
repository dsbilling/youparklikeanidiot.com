<?php

namespace LANMS\Http\Requests\Admin\Sponsor;
 
use Illuminate\Foundation\Http\FormRequest;
 
class SponsorCreateRequest extends FormRequest {
	public function rules() {
		return [
			'name' 			=> 'required',
			'url' 			=> '',
			'description' 	=> '',
			'image' 		=> 'required|image|mimes:jpeg,png,jpg,gif,svg',
		];
	}
	
	public function authorize() {
		return true;
	}
}