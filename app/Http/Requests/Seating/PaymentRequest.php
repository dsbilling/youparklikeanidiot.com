<?php namespace LANMS\Http\Requests\Seating;

use LANMS\Http\Requests\Request;

class PaymentRequest extends Request {

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
			'number' 		=> 'required',
			'expiryMonth' 	=> 'required|numeric|digits:2|min:1|max:12',
			'expiryYear' 	=> 'required|numeric|digits:2|min:'.substr(\Carbon::now()->year, 2).'|max:'.substr(\Carbon::now()->addYear(10)->year, 2),
			'cvc' 			=> 'required|numeric|digits:3',
			'name' 			=> 'required',
		];
	}

}
