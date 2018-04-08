<?php namespace LANMS\Http\Controllers\Admin;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Vsmoraes\Pdf\PdfFacade as PDF;

use LANMS\Seats;
use LANMS\SeatRows;

use LANMS\Http\Requests\Admin\PrintSeatRequest;

class PrintSeatController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Sentinel::getUser()->hasAccess(['admin.print.*'])) {
			$rows = SeatRows::all();
			return view('seating.print.index')->withRows($rows);
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
	public function printSeat($slug)
	{
		$seat = Seats::where('slug', $slug)->first();
		$html = view('seating.print.pdf.seat')->with('seat', $seat)->render();
		return PDF::load($html, 'A4', 'landscape')->show();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
