<?php namespace LANMS\Http\Controllers\Member;

use LANMS\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

use LANMS\Http\Requests\Member\ForgotPasswordRequest;
use LANMS\Http\Requests\Member\RecoverRequest;

use LANMS\Rem;

class RecoverController extends Controller {

	use ResetsPasswords;

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

	public function getResendVerification() {
		return view('auth.resendverification');
	}

}
