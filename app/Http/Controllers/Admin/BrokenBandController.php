<?php namespace LANMS\Http\Controllers\Admin;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use LANMS\BrokenBand;
use LANMS\Checkin;

use LANMS\Http\Requests\Admin\CheckBandRequest;
use LANMS\Http\Requests\Admin\BrokenBandRequest;

class BrokenBandController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Sentinel::getUser()->hasAccess(['admin.checkin.*'])) {
			$brokenbands = BrokenBand::thisYear()->get();
			return view('seating.brokenband.index')->withBrokenbands($brokenbands);
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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id, BrokenBandRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.checkin.*'])) {
			$newbandnumber = $request->get('new_band_number');
			$oldbandnumber = $request->get('band_number');
			$checkin = Checkin::find($id);
			if($checkin == null) {
				return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'Checkin not found!');
			}

			$bandfound = Checkin::thisYear()->where('bandnumber', '=', $newbandnumber)->first();
			if($bandfound !== null) {
				return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'This bandnumber already in use in another checkin!');
			}

			$brokenband 						= new BrokenBand;
			$brokenband->checkin_id 			= $id;
			$brokenband->previous_bandnumber	= $oldbandnumber;
			$brokenband->new_bandnumber			= $newbandnumber;
			$brokenband->year					= \Setting::get('SEATING_YEAR');
			$brokenband->author_id				= Sentinel::getUser()->id;
			$brokenband->editor_id				= Sentinel::getUser()->id;
			$brokenband->save();

			// Update current checkin with new bandnumber
			$checkin->bandnumber				= $newbandnumber;

			if($checkin->save()) {
				return Redirect::route('admin-seating-brokenband')->with('messagetype', 'success')
								->with('message', 'The brokenband has been updated for the checkin! The change has been logged.');
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
		if (Sentinel::getUser()->hasAccess(['admin.checkin.*'])) {
			$checkin = Checkin::thisYear()->where('bandnumber', '=', $id)->first();
			if($checkin == null) {
				return Redirect::route('admin-seating-brokenband')->with('messagetype', 'warning')
								->with('message', 'Band not found on any checkins!');
			}
			return view('seating.brokenband.show')->withCheckin($checkin);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}
	public function check(CheckBandRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.checkin.*'])) {
			$bandid = $request->get('band_id');
			$checkin = Checkin::thisYear()->where('bandnumber', '=', $bandid)->first();
			if($checkin == null) {
				return Redirect::route('admin-seating-brokenband')->with('messagetype', 'warning')
								->with('message', 'Band not found on any checkins!');
			}
			return Redirect::route('admin-seating-brokenband-show', $bandid);
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
