<?php

namespace LANMS\Http\Controllers\Admin\Seating;

use LANMS\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use LANMS\Seats;

use LANMS\Http\Requests\Admin\Seating\SeatCreateRequest;
use LANMS\Http\Requests\Admin\Seating\SeatEditRequest;

class SeatsController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Sentinel::getUser()->hasAccess(['admin.seating.seat.*'])){
			$seats = Seats::all();
			return view('seating.seats.index')
						->with('allseats', $seats);
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
		if (Sentinel::getUser()->hasAccess(['admin.seating.seat.create'])){
			return view('seating.seats.create');
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
	public function store(SeatCreateRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.seating.seat.create'])) {

			$seat 					= new Seats;
			$seat->name 			= $request->name;
			$seat->slug 			= strtolower($request->name);
			$seat->editor_id		= Sentinel::getUser()->id;
			$seat->author_id		= Sentinel::getUser()->id;

			if($seat->save()) {
				return Redirect::route('admin-seating-seats')
						->with('messagetype', 'success')
						->with('message', 'The seat has now been created!');
			} else {
				return Redirect::route('admin-seating-seat-create')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while saving the seat.');
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
		if (Sentinel::getUser()->hasAccess(['admin.seating.seat.update'])){
			$seat = Seats::find($id);
			return view('seating.seats.edit')->withSeat($seat);
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
	public function update($id, SeatEditRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.seating.seat.update'])){
			$seat 				= Seats::find($id);
			$seat->name 			= $request->name;
			$seat->slug 			= strtolower($request->name);
			$seat->row_id 			= $request->row_id;
			$seat->editor_id		= Sentinel::getUser()->id;
			$seat->save();
			
			return Redirect::route('admin-seating-seats')
					->with('messagetype', 'success')
					->with('message', 'The seat has now been saved!');
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
		if (Sentinel::getUser()->hasAccess(['admin.seating.seat.destroy'])){
			$seat = Seats::find($id);
			if($seat->delete()) {
				return Redirect::route('admin-seating-seats')
						->with('messagetype', 'success')
						->with('message', 'The seat has now been deleted!');
			} else {
				return Redirect::route('admin-seating-seats')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong while deleting the seat.');
			}
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}
}
