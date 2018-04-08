<?php

namespace LANMS\Http\Requests\Admin;
 
use Illuminate\Foundation\Http\FormRequest;
 
class SettingEditRequest extends FormRequest {
	public function rules() {
		return [
			'value' 	=> 'required',
		];
	}
	
	public function authorize() {
		return true;
	}
}