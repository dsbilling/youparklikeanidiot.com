<?php namespace LANMS\Http\Controllers\Admin;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use LANMS\SeatTicket;
use LANMS\Checkin;
use LANMS\SeatReservation;
use LANMS\Seats;

use LANMS\Http\Requests\Admin\CheckTicketRequest;
use LANMS\Http\Requests\Admin\CheckinRequest;

class CheckinController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Sentinel::getUser()->hasAccess(['admin.checkin.*'])) {
			$checkedin 				= Checkin::thisYear()->get();
			$ticketsnoncheckedin	= SeatTicket::noCheckin()->thisYear()->get();
			$reservedcount 			= SeatTicket::thisYear()->count();

			return view('seating.checkin.index')->withCheckedin($checkedin)->withNoncheckedin($ticketsnoncheckedin)->with('reservedcount', $reservedcount);
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
	public function store($id, CheckinRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.checkin.*'])) {
			$bandnumber = $request->get('band_number');
			$ticket = SeatTicket::find($id);
			$checkinfound = Checkin::thisYear()->where('bandnumber', '=', $bandnumber)->first();
			if($ticket == null) {
				return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'Ticket not found!');
			}
			if($checkinfound !== null) {
				return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'This ticket has already been checked in!');
			}

			$checkin 					= new Checkin;
			$checkin->ticket_id 		= $id;
			$checkin->bandnumber		= $bandnumber;
			$checkin->year				= \Setting::get('SEATING_YEAR');
			$checkin->save();

			$ticket 					= SeatTicket::find($id);
			$ticket->checkin_id			= $checkin->id;

			if($ticket->save()) {
				return Redirect::route('admin-seating-checkin')->with('messagetype', 'success')
								->with('message', 'The atendee has been checked in!');
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
			$barcode = $id;
			$ticket = SeatTicket::where('barcode', '=', $barcode)->first();
			if($ticket == null) {
				return Redirect::route('admin-seating-checkin')->with('messagetype', 'warning')
								->with('message', 'Ticket not found!');
			}
			$checkin = Checkin::thisYear()->where('ticket_id', '=', $ticket->id)->first();
			if($checkin !== null) {
				return Redirect::route('admin-seating-checkin')->with('messagetype', 'warning')
								->with('message', 'This ticket has already been checked in!');
			}
			return view('seating.checkin.show')->withTicket($ticket);
		} else {
			return Redirect::back()->with('messagetype', 'warning')
								->with('message', 'You do not have access to this page!');
		}
	}
	public function check(CheckTicketRequest $request)
	{
		if (Sentinel::getUser()->hasAccess(['admin.checkin.*'])) {
			$barcode = $request->get('ticket_id');
			$ticket = SeatTicket::where('barcode', '=', $barcode)->first();
			if($ticket == null) {
				return Redirect::route('admin-seating-checkin')->with('messagetype', 'warning')
								->with('message', 'Ticket not found!');
			}
			$checkin = Checkin::thisYear()->where('ticket_id', '=', $ticket->id)->first();
			if($checkin !== null) {
				return Redirect::route('admin-seating-checkin')->with('messagetype', 'warning')
								->with('message', 'This ticket has already been checked in!');
			}
			return Redirect::route('admin-seating-checkin-show', $barcode);
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
