<?php namespace DPSEI\Http\Controllers\Member;

use DPSEI\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

use DPSEI\Http\Requests\Member\ForgotPasswordRequest;
use DPSEI\Http\Requests\Member\RecoverRequest;

use DPSEI\Rem;

class RecoverController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;

		$this->beforeFilter('csrf', ['on' => ['post']]);
		$this->middleware('sentinel.guest');
	}

	public function getForgotPassword() {
		return view('auth.forgot-password');
	}

	public function getResetPassword($resetpassword_code) {
		$act = Rem::where('code', '=', $resetpassword_code)->where('completed', '=', 0)->first();
		if($act == null) {
			return Redirect::route('home')
				->with('messagetype', 'warning')
				->with('message', 'We couldn\'t find your reminder code. Please try again.');
		} else {
			return view('auth.resetpassword')->with('resetpassword_code', $resetpassword_code);
		}
	}

}
