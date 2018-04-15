<?php

namespace DPSEI\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
			'firstname'				=> 'required',
			'lastname'				=> 'required',
			'username'				=> 'required',
			'birthday'				=> 'required|date',
			'email'					=> 'required|email',
			'password'				=> 'required|different:firstname|different:lastname|different:username|confirmed',
			'accept'				=> 'accepted'
		];
	}
}
