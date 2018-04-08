<?php namespace LANMS\Http\Requests\Admin;

use LANMS\Http\Requests\Request;

class BrokenBandRequest extends Request {

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
			'new_band_number' => 'required|integer',
			'band_number' => 'required|integer',
		];
	}

}
