<?php namespace LANMS\Http\Controllers\Crew;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\CrewSkillAttached;

use LANMS\Http\Requests\Admin\Crew\CrewSkillAttachmentCreateRequest;
use LANMS\Http\Requests\Admin\Crew\CrewSkillAttachmentEditRequest;

class CrewSkillAttachmentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function admin()
	{
		if (Sentinel::getUser()->hasAccess(['admin.crew-skill.*'])){
			$skillAttachments = CrewSkillAttached::thisYear()->get();
			return view('crew.skill-attachment.admin')
						->withSkillattachments($skillAttachments);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if (Sentinel::getUser()->hasAccess(['admin.crew-skill.create'])){
			return view('crew.skill-attachment.create');
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CrewSkillAttachmentCreateRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.crew-skill.create'])){
			
			$csa 				= new CrewSkillAttached;
			$csa->user_id 		= $request->get('user_id');
			$csa->skill_id 		= $request->get('skill_id');
			$csa->year 			= \Setting::get('SEATING_YEAR');
			$csa->author_id		= Sentinel::getUser()->id;
			$csa->editor_id		= Sentinel::getUser()->id;

			if($csa->save()) {
				return Redirect::route('admin-crew-skill-attachment')
						->with('messagetype', 'success')
						->with('message', 'The skill has now been saved and published!');
			} else {
				return Redirect::route('admin-crew-skill-attachment')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while saving the skill.');
			}

		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (Sentinel::getUser()->hasAccess(['admin.crew-skill.update'])){
			$csa = CrewSkillAttached::find($id);
			return view('crew.skill-attachment.edit')->withSkilla($csa);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, CrewSkillAttachmentEditRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.crew-skill.update'])){
			
			$csa 			= CrewSkillAttached::find($id);
			$csa->skill_id 	= $request->get('skill_id');
			$csa->editor_id	= Sentinel::getUser()->id;

			if($csa->save()) {
				return Redirect::route('admin-crew-skill-attachment-edit', $id)
						->with('messagetype', 'success')
						->with('message', 'The skill has now been attached!');
			} else {
				return Redirect::route('admin-crew-skill-attachment-edit', $id)
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while saving the skill attachment.');
			}

		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (Sentinel::getUser()->hasAccess(['admin.crew-skill.destroy'])){
			$csa 				= CrewSkillAttached::find($id);
			$csa->editor_id	= Sentinel::getUser()->id;
			$csa->save();
			if($csa->delete()) {
				return Redirect::route('admin-crew-skill-attachment')
						->with('messagetype', 'success')
						->with('message', 'The skill attachment has now been deleted!');
			} else {
				return Redirect::route('admin-crew-skill-attachment')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while deleting the skill attachment.');
			}
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

}
