<?php namespace LANMS\Http\Requests\Admin\Crew;

use LANMS\Http\Requests\Request;

class CrewSkillAttachmentCreateRequest extends Request {

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
			'user_id' 	=> 'required|integer',
			'skill_id' 	=> 'required|integer',
		];
	}

}
