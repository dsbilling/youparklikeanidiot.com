<?php namespace LANMS\Http\Controllers\Seating;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\SeatRows;
use LANMS\Seats;
use LANMS\SeatReservation;
use anlutro\LaravelSettings\Facade as Setting;
use PDF;

use LANMS\Http\Requests\Seating\SeatReserveRequest;

class ReserveSeatingController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$rows 				= SeatRows::all();
		$reservations 		= Sentinel::getUser()->reservationsThisYear;
		$ownreservations 	= Sentinel::getUser()->ownReservationsThisYear;
		return view('seating.index')
				->withRows($rows)
				->with('reservations', $reservations)
				->with('ownreservations', $ownreservations);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function show($slug)
	{
		$slug = strtolower($slug); // Just to be sure it is correct
		$currentseat = Seats::where('slug', $slug)->first();
		if($currentseat == null) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Could not find seat.');
		}
		$rows = SeatRows::all();
		return view('seating.show')->withRows($rows)->with('currentseat', $currentseat);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function reserve($slug, SeatReserveRequest $request)
	{

		$slug 			= strtolower($slug); // Just to be sure it is correct
		$seat 			= Seats::where('slug', $slug)->first();
		$reservedforid 	= $request->get('reservedfor');
		$reservedfor 	= Sentinel::findById($reservedforid);

		if($seat == null) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Could not find seat.');
		}
		if(substr($slug, 0, 1) == 'a') {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'It is not possible to reserve seats on the A-row.');
		}
		if(!Setting::get('SEATING_OPEN')) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'It is not possible to reserve seats at this time.');
		}
		if($seat->reservationsThisYear()->count() >= 1) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Seat has already been reserved');
		}

		/* LOGGED IN USER */
		if (!Sentinel::getUser()->birthdate) {
			return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
								->with('message', 'You need to have an birthdate assigned to your account to be able to reserve a seat.');
		}
		if (Sentinel::getUser()->addresses->count() == 0) {
			return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
								->with('message', 'It seems like you do not have any addresses attached to your account. You will not be able to reserve any seat before you have added one primary address.');
		}
		if(Sentinel::getUser()->reservationsThisYear()->count() >= 5) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'You are not allowed to reserve more seats.');
		}
		if($request->get('reservedfor') == Sentinel::getUser()->id && Sentinel::getUser()->ownReservationsThisYear()->count() >= 1) {
			return Redirect::route('seating-show', $slug)->with('messagetype', 'info')
								->with('message', 'You cannot reserve more than one seat to yourself. Please select another user you want to reserve this seat for.');
		}

		/* RESERVED FOR USER */
		if (!$reservedfor->birthdate) {
			return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
								->with('message', 'It seems like '.$reservedfor->username.' does not have an birthdate assigned to their account, they need it to be able to reserve a seat.');
		}
		if ($reservedfor->addresses->count() == 0) {
			return Redirect::route('seating-show', $slug)->with('messagetype', 'warning')
								->with('message', 'It seems like '.$reservedfor->username.' does not have any addresses attached to their account. They will not be able to reserve any seat before they have added one primary address.');
		}
		if($reservedfor->reservationsThisYear()->count() >= 5) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', $reservedfor->username.' are not allowed to reserve more seats.');
		}
		if($reservedfor->ownReservationsThisYear()->count() >= 1) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', $reservedfor->username.' already has reserved a seat.');
		}

		$seatreservation 					= new SeatReservation;
		$seatreservation->seat_id 			= $seat->id;
		$seatreservation->reservedby_id 	= Sentinel::getUser()->id;
		$seatreservation->reservedfor_id	= $reservedforid;
		$seatreservation->status_id 		= 2; // 1 = Reserved, 2 = Temporary Reserved
		$seatreservation->year 				= \Setting::get('SEATING_YEAR');

		$seatreservationsave 				= $seatreservation->save();

		$updateseat							= Seats::find($seat->id);
		$updateseat->reservation_id			= $seatreservation->id;
		$updateseat->save();

		if($seatreservationsave) {
			return Redirect::route('seating')->with('messagetype', 'success')
								->with('message', 'You have successfully reserved this seat!');
		} else {
			return Redirect::route('seating')->with('messagetype', 'error')
								->with('message', 'Something went wrong while saving the reservation!');
		}
	}

	public function ticketdownload($slug)
	{
		$slug = strtolower($slug); // Just to be sure it is correct
		$currentseat = Seats::where('slug', $slug)->first();
		if($currentseat == null) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Could not find seat.');
		}

		if(Sentinel::getUser()->id == $currentseat->reservationsThisYear()->first()->reservedfor->id) {
			$html = view('seating.pdf.ticket')->with('currentseat', $currentseat)->render();
		    $pdf = PDF::loadHTML($html);
			return $pdf->stream();
		} else {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'You are not allowed to view this ticket.');
		}
	}

	public function consentform()
	{
		return PDF::loadView('seating.pdf.consentform')->stream();
	}

	public function destroy($id)
	{
		$reservation = SeatReservation::find($id);

		if($reservation == null) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Could not find reservation.');
		}
		if(!Setting::get('SEATING_OPEN')) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'It is not possible to remove reservations at this time.');
		}
		if(Sentinel::getUser()->id <> $reservation->reservedby->id) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'You can\'t remove this reservation.');
		}
		if (SeatReservation::getRealExpireTime($id) == "expired") {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'You can\'t remove reservation after the first 48 hours.');
		}
		if($reservation->status_id == 1) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'You can\'t remove this reservation after it is reserved.');
		}

		$seat = $reservation->seat;
		$seat->reservation_id = 0;
		$seat->save();

		if($reservation->ticket) {
			$reservation->ticket->delete();
		}
		
		if($reservation->delete()) {
			return Redirect::route('seating')
					->with('messagetype', 'success')
					->with('message', 'The reservation has now been removed!');
		} else {
			return Redirect::route('seating')
				->with('messagetype', 'danger')
				->with('message', 'Something went wrong while deleting the reservation.');
		}
	}

}
