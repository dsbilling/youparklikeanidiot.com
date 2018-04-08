<?php namespace LANMS\Http\Requests\Admin;

use LANMS\Http\Requests\Request;

class VisitorRequest extends Request {

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
			'fullname' 			=> 'required|min:3|max:250|regex:/^[A-Za-z \']+$/',
			'telephonenumber' 	=> 'required',
			'bandnumber' 		=> 'required|integer',
		];
	}

}
