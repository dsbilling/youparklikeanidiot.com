<?php

namespace LANMS\Http\Requests\Admin\News;
 
use Illuminate\Foundation\Http\FormRequest;
 
class NewsCreateRequest extends FormRequest {
	public function rules() {
		return [
			'title' 				=> 'required|max:255',
			'content' 				=> 'required',
			'category_id' 			=> 'required|integer',
			'published_at_time' 	=> 'required',
			'published_at_date'		=> 'required',
		];
	}
	
	public function authorize() {
		return true;
	}
}