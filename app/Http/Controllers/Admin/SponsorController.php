<?php

namespace LANMS\Http\Controllers\Admin;

use LANMS\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Intervention\Image\Facades\Image;

use LANMS\Sponsor;

use LANMS\Http\Requests\Admin\Sponsor\SponsorCreateRequest;
use LANMS\Http\Requests\Admin\Sponsor\SponsorEditRequest;

class SponsorController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Sentinel::getUser()->hasAccess(['admin.sponsor.*'])){
			$sponsors = Sponsor::all();
			return view('sponsor.index')
						->with('sponsors', $sponsors);
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
		if (Sentinel::getUser()->hasAccess(['admin.sponsor.create'])){
			return view('sponsor.create');
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
	public function store(SponsorCreateRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.sponsor.create'])){

			$image 		= $request->file('image');
			$name 		= $request->get('name');
			$cleanname	= strtolower(str_replace(' ', '', $name));
				
			$filename 			= $cleanname . '_' . \Setting::get('SEATING_YEAR') . '.' . $image->getClientOriginalExtension();
			$path 				= public_path() . '/images/sponsor/' . $filename;
			$webpath			= '/images/sponsor/' . $filename;

			$imagesave 			= Image::make($image->getRealPath())->fit(335,90)->save($path);

			$sponsor 				= new Sponsor;
			$sponsor->name 			= $name;
			$sponsor->url 			= $request->get('url');
			$sponsor->description 	= $request->get('description');
			$sponsor->image 		= $webpath;
			$sponsor->year			= \Setting::get('SEATING_YEAR');
			$sponsor->editor_id		= Sentinel::getUser()->id;
			$sponsor->author_id		= Sentinel::getUser()->id;

			if($sponsor->save() && $imagesave) {
				return Redirect::route('admin-sponsor')
						->with('messagetype', 'success')
						->with('message', 'The sponsor has now been created!');
			} else {
				return Redirect::route('admin-sponsor-create')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while saving the sponsor.');
			}

		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (Sentinel::getUser()->hasAccess(['admin.sponsor.update'])){
			$sponsor = Sponsor::find($id);
			return view('sponsor.edit')->withSponsor($sponsor);
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
	public function update($id, SponsorEditRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.sponsor.create'])){

			$image 		= $request->file('image');
			$name 		= $request->get('name');
			$cleanname	= strtolower(str_replace(' ', '', $name));

			if($image) {
				$filename 			= $cleanname . '_' . \Setting::get('SEATING_YEAR') . '.' . $image->getClientOriginalExtension();
				$path 				= public_path() . '/images/sponsor/' . $filename;
				$webpath			= '/images/sponsor/' . $filename;

				$imagesave 			= Image::make($image->getRealPath())->fit(335,90)->save($path);
			}

			$sponsor 				= Sponsor::find($id);
			$sponsor->name 			= $name;
			$sponsor->url 			= $request->get('url');
			$sponsor->description 	= $request->get('description');

			if($image) {
				$sponsor->image 		= $webpath;
			}
			
			$sponsor->editor_id		= Sentinel::getUser()->id;

			if($sponsor->save()) {
				return Redirect::route('admin-sponsor')
						->with('messagetype', 'success')
						->with('message', 'The sponsor has now been updated!');
			} else {
				return Redirect::route('admin-sponsor-create')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while saving the sponsor.');
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
		if (Sentinel::getUser()->hasAccess(['admin.sponsor.destroy'])){
			$sponsor = Sponsor::find($id);
			if($sponsor->delete()) {
				return Redirect::route('admin-sponsor')
						->with('messagetype', 'success')
						->with('message', 'The sponsor has now been deleted!');
			} else {
				return Redirect::route('admin-sponsor')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while deleting the page.');
			}
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}

}
