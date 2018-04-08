<?php

namespace LANMS\Http\Requests\Admin\Seating;

use Illuminate\Foundation\Http\FormRequest;

class SeatCreateRequest extends FormRequest
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
			'name'		=> 'required|unique:seats,name|alpha_num|between:1,4',
			'row_id'	=> 'required|integer',
		];
	}
}
