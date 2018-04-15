<?php

namespace DPSEI\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'login'					=> 'required',
			'resetpassword_code'	=> 'required',
			'password'				=> 'required',
			'password_again'		=> 'required,same:password',
		];
	}
}