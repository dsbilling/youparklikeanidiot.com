<?php namespace LANMS\Http\Controllers\Member;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use anlutro\LaravelSettings\Facade as Setting;

use Illuminate\Http\Request;

class ReferralController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, $code)
	{
		if(Setting::get('REFERRAL_ACTIVE')) {
			$request->session()->put('referral', $code);
			return Redirect::route('account-register');
		} else {
			return Redirect::route('home');
		}
	}

}
