<?php

namespace LANMS\Http\Requests\Admin\News;
 
use Illuminate\Foundation\Http\FormRequest;
 
class NewsCategoryEditRequest extends FormRequest {
	public function rules() {
		return [
			'name' 		=> 'required',
			'slug' 		=> '',
		];
	}
	
	public function authorize() {
		return true;
	}
}