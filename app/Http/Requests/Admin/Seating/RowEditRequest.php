<?php

namespace LANMS\Http\Requests\Admin\Seating;

use Illuminate\Foundation\Http\FormRequest;

class RowEditRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name'		=> 'required|unique:seat_rows,name,'.$this->id.',id|alpha|between:1,2',
		];
	}
}
