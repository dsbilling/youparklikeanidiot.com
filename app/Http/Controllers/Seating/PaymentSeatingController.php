<?php namespace LANMS\Http\Controllers\Seating;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\SeatRows;
use LANMS\Seats;
use LANMS\SeatReservation;
use LANMS\SeatPayment;
use LANMS\SeatTicket;
use LANMS\StripeCustomer;
use anlutro\LaravelSettings\Facade as Setting;

use LANMS\Http\Requests\Seating\PaymentRequest;

use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\ServerErrorException;

class PaymentSeatingController extends Controller {


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function pay($slug)
	{
		$slug = strtolower($slug); // Just to be sure it is correct
		$currentseat = Seats::where('slug', $slug)->first();
		if($currentseat == null) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Could not find seat.');
		}
		if(!Setting::get('SEATING_OPEN')) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'It is not possible to reserve seats at this time.');
		}
		if ($currentseat->reservationsThisYear->first()) {
			if ($currentseat->reservationsThisYear->first()->payment_id != 0) {
				return Redirect::route('seating')->with('messagetype', 'warning')
									->with('message', 'This seat already has a payment assigned to it.');
			}
			if(Sentinel::getUser()->id <> $currentseat->reservationsThisYear->first()->reservedby->id) {
				return Redirect::route('seating')->with('messagetype', 'warning')
									->with('message', 'You can\'t pay for this seat.');
			}
		} else {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'There was no reservation found for this seat.');
		}
		
		$rows = SeatRows::all();
		return view('seating.pay')->withRows($rows)->with('currentseat', $currentseat);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function charge($slug, PaymentRequest $request)
	{
		$seat = Seats::where('slug', $slug)->first();
		if($seat == null) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Could not find seat.');
		}
		if(!Setting::get('SEATING_OPEN')) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'It is not possible to reserve seats at this time.');
		}
		if ($seat->reservationsThisYear->first()) {
			if ($seat->reservationsThisYear->first()->payment_id != 0) {
				return Redirect::route('seating')->with('messagetype', 'warning')
									->with('message', 'This seat already has a payment assigned to it.');
			}
			if(Sentinel::getUser()->id <> $seat->reservationsThisYear->first()->reservedby->id) {
				return Redirect::route('seating')->with('messagetype', 'warning')
									->with('message', 'You can\'t pay for this seat.');
			}
		} else {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'There was no reservation found for this seat.');
		}

		$stripecust = StripeCustomer::where('user_id', Sentinel::getUser()->id)->first();
		
		if($stripecust == null) {
			$customer = \Stripe::customers()->create([
				'email' => Sentinel::getUser()->email,
			]);
			$stripecustomer 			= new StripeCustomer;
			$stripecustomer->cus 		= $customer['id'];
			$stripecustomer->user_id	= Sentinel::getUser()->id;
			$stripecustomer->save();

			$stripecust = $stripecustomer; 
		}

		/*$getcards = \Stripe::cards()->all($stripecust->cus);
		$carddata = $getcards['data'];
		dd($carddata);*/

		$cardNumber    		= str_replace(' ', '', $request->get('number'));
		$cardMonthExpiry 	= $request->get('expiryMonth');
		$cardCVC       		= $request->get('cvc');
		$cardYearExpiry  	= $request->get('expiryYear');
		$nameOnCard  		= $request->get('name');

		try {
			$token = \Stripe::tokens()->create([
				'card' => [
					'number'    => $cardNumber,
					'exp_month' => $cardMonthExpiry,
					'cvc'       => $cardCVC,
					'exp_year'  => $cardYearExpiry,
					'name'		=> $nameOnCard,
				],
			]);
		} catch (CardErrorException $e) {
			// Get the status code
			$code = $e->getCode();

			// Get the error message returned by Stripe
			$message = $e->getMessage();

			// Get the error type returned by Stripe
			$type = $e->getErrorType();

			return Redirect::route('seating-pay', $slug)->with('messagetype', 'error')
								->with('message', $message.'. Please check your card information and try again.');
		}

		try {
			$customer = \Stripe::customers()->update($stripecust->cus, [
				'source' => $token['id'],
			]);
		} catch (CardErrorException $e) {
			// Get the status code
			$code = $e->getCode();

			// Get the error message returned by Stripe
			$message = $e->getMessage();

			// Get the error type returned by Stripe
			$type = $e->getErrorType();

			return Redirect::route('seating-pay', $slug)->with('messagetype', 'error')
								->with('message', $message.'. Please try again.');
		} catch (ServerErrorException $e) {
			// Get the status code
			$code = $e->getCode();

			// Get the error message returned by Stripe
			$message = $e->getMessage();

			// Get the error type returned by Stripe
			$type = $e->getErrorType();

			return Redirect::route('seating-pay', $slug)->with('messagetype', 'error')
								->with('message', $message.'. Please try again.');
		}

		try {
			$charge = \Stripe::charges()->create([
				'customer' 	=> $stripecust->cus,
				'currency'	=> Setting::get('SEATING_SEAT_PRICE_CURRENCY'),
				'amount'	=> Setting::get('SEATING_SEAT_PRICE'),
			]);
		} catch (CardErrorException $e) {
			// Get the status code
			$code = $e->getCode();

			// Get the error message returned by Stripe
			$message = $e->getMessage();

			// Get the error type returned by Stripe
			$type = $e->getErrorType();

			return Redirect::route('seating-pay', $slug)->with('messagetype', 'error')
								->with('message', $message.'. Please try again.');
		}

		$reservation 					= $seat->reservationsThisYear->first();
		$reservationid 					= $reservation->id;

		$seatpayment 					= new SeatPayment;
		$seatpayment->stripecharge 		= $charge['id'];
		$seatpayment->reservation_id	= $reservationid;
		$seatpayment->user_id			= Sentinel::getUser()->id;
		$seatpayment->save();

		$seatticket 					= new SeatTicket;
		$seatticket->barcode 			= mt_rand(1000000000, 2147483647);
		$seatticket->reservation_id		= $reservationid;
		$seatticket->user_id			= Sentinel::getUser()->id;
		$seatticket->year				= \Setting::get('SEATING_YEAR');
		$seatticket->save();

		$reservationchange				= SeatReservation::find($reservationid);
		$reservationchange->status_id	= 1;
		$reservationchange->payment_id	= $seatpayment->id;
		$reservationchange->ticket_id	= $seatticket->id;
		$reservationchange->save();

		return Redirect::route('seating')->with('messagetype', 'success')
								->with('message', $seat->name.' is now reserved and paid for! We are exited to have you, welcome!');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function paylater($slug)
	{
		$seat 							= Seats::where('slug', $slug)->first();

		if($seat == null) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Could not find seat.');
		}
		if(!Setting::get('SEATING_OPEN')) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'It is not possible to reserve seats at this time.');
		}
		if ($seat->reservationsThisYear->first()) {
			if ($seat->reservationsThisYear->first()->payment_id != 0) {
				return Redirect::route('seating')->with('messagetype', 'warning')
									->with('message', 'This seat already has a payment assigned to it.');
			}
			if(Sentinel::getUser()->id <> $seat->reservationsThisYear->first()->reservedby->id) {
				return Redirect::route('seating')->with('messagetype', 'warning')
									->with('message', 'You can\'t pay for this seat.');
			}
		} else {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'There was no reservation found for this seat.');
		}

		$reservation 					= $seat->reservationsThisYear->first();
		$reservationid 					= $reservation->id;

		$seatticket 					= new SeatTicket;
		$seatticket->barcode 			= mt_rand(1000000000, 2147483647);
		$seatticket->reservation_id		= $reservationid;
		$seatticket->user_id			= Sentinel::getUser()->id;
		$seatticket->year				= \Setting::get('SEATING_YEAR');
		$seatticket->save();

		$reservationchange				= SeatReservation::find($reservationid);
		$reservationchange->status_id	= 1;
		$reservationchange->ticket_id	= $seatticket->id;
		$reservationchange->save();

		return Redirect::route('seating')->with('messagetype', 'success')
								->with('message', $seat->name.' is now reserved and paid for! We are exited to have you, welcome!');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function changepayment($slug)
	{
		$slug = strtolower($slug); // Just to be sure it is correct
		$seat = Seats::where('slug', $slug)->first();

		if($seat == null) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'Could not find seat.');
		}
		if(!Setting::get('SEATING_OPEN')) {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'It is not possible to reserve seats at this time.');
		}
		if ($currentseat->reservationsThisYear->first()) {
			if ($seat->reservationsThisYear->first()->payment_id != 0) {
				return Redirect::route('seating')->with('messagetype', 'warning')
									->with('message', 'This seat already has a payment assigned to it.');
			}
			if(Sentinel::getUser()->id <> $seat->reservationsThisYear->first()->reservedby->id) {
				return Redirect::route('seating')->with('messagetype', 'warning')
									->with('message', 'You can\'t pay for this seat.');
			}
		} else {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'There was no reservation found for this seat.');
		}

		$reservation 					= $seat->reservationsThisYear->first();
		$reservationid 					= $reservation->id;

		if (SeatReservation::getRealExpireTime($reservationid) == "expired") {
			return Redirect::route('seating')->with('messagetype', 'warning')
								->with('message', 'You can\'t change your payment of your reservation after the first 48 hours.');
		}

		$reservation->ticket->delete(); // Delete Old Ticket

		$reservationchange				= SeatReservation::find($reservationid);
		$reservationchange->status_id	= 2;
		$reservationchange->ticket_id	= 0;
		$reservationchange->save();

		return Redirect::route('seating')->with('messagetype', 'success')
								->with('message', 'You can now change your payment of your reservation.');

	}


}
