<?php namespace LANMS\Http\Requests\Member;

use LANMS\Http\Requests\Request;

class AddressCreateRequest extends Request {

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
			'address1' 		=> 'required|regex:/^[A-Za-z \Wæøå]+$/|max:100',
			'address2' 		=> 'alpha_num',
			'postalcode' 	=> 'required|alpha_dash|min:4',
			'city' 			=> 'required|regex:/^[A-Za-z \Wæøå]+$/',
			'county' 		=> 'required|regex:/^[A-Za-z \Wæøå]+$/',
			'country' 		=> 'required|alpha',
		];
	}

}
