<?php namespace DPSEI\Http\Controllers\Member;

use DPSEI\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;

use DPSEI\Http\Requests\Auth\ActivateRequest;
use DPSEI\Http\Requests\Auth\ForgotCredentialsRequest;
use DPSEI\Http\Requests\Auth\LoginRequest;
use DPSEI\Http\Requests\Auth\RegisterRequest;
use DPSEI\Http\Requests\Auth\ResendVerificationRequest;
use DPSEI\Http\Requests\Auth\ResetPasswordRequest;

use DPSEI\Act;
use DPSEI\Rem;
use DPSEI\User;

class AuthController extends Controller {

	public function getLogin() {
		return view('auth.login');
	}

	public function getRegister() {
		return view('auth.register');
	}

	public function getLogout() {
		Sentinel::logout();
		return Redirect::route('home')
						->with('messagetype', 'success')
						->with('message', 'You have now been successfully been logged out!');
	}

	public function getActivate($activation_code) {
		$act = Act::where('code', '=', $activation_code)->where('completed', '=', 0)->first();
		if($act == null) {
			return Redirect::route('home')
				->with('messagetype', 'warning')
				->with('message', 'We couldn\'t find your activation code. Please try again.');
		} else {
			return view('auth.activate')->with('activation_code', $activation_code);
		}
	}

	public function getForgotCredentials() {
		return view('auth.credentials-forgot');
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

	public function postRegister(RegisterRequest $request) {

		if(!\Setting::get('LOGIN_ENABLED')) {
			return Redirect::route('account-register')
						->with('messagetype', 'warning')
						->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
		} else {

			$email 				= $request->input('email');
			$firstname	 		= $request->input('firstname');
			$lastname 			= $request->input('lastname');
			$username 			= $request->input('username');
			$password 			= $request->input('password');
			$birthdate 			= $request->input('birthdate');

			$referral			= \Session::get('referral');
			$referral_code 		= str_random(15);

			$checkusername 		= User::where('username', '=', $username)->first();
			$checkemail 		= User::where('email', '=', $email)->first();

			if(!is_null($checkusername)) { 
				return Redirect::route('account-register')
						->with('messagetype', 'warning')
						->with('message', 'Username has already been taken.')->withInput($request->all());
			}

			if(!is_null($checkemail)) { 
				return Redirect::route('account-register')
						->with('messagetype', 'warning')
						->with('message', 'Email has already been taken.')->withInput($request->all());
			}

			if(is_null($checkusername) && is_null($checkemail)) {

				$user = Sentinel::register(array(
					'email' 			=> $email,
					'username'			=> $username,
					'firstname'			=> $firstname,
					'lastname'			=> $lastname,
					'birthdate'			=> $birthdate,
					'password'			=> $password,
					'referral'			=> $referral,
					'referral_code'		=> $referral_code,
				));

				if($user) {

					$activation = Activation::create($user);
					$activation_code = $activation->code;

					Mail::send('emails.auth.activate', array('link' => \URL::route('account-activate', $activation_code), 'firstname' => $firstname), function($message) use ($user) {
						$message->to($user->email, $user->firstname)->subject('Activate your account');
					});

					if(count(Mail::failures()) > 0) {
						return Redirect::route('account-register')
							->with('messagetype', 'warning')
							->with('message', 'Something went wrong while trying to send you an email.');
					} else {
						return Redirect::route('account-login')
							->with('messagetype', 'success')
							->with('message', 'Your account has been registered!');
					}

					Session::forget('referral'); //forget the referral

				} else {
					return Redirect::route('account-register')
						->with('messagetype', 'error')
						->with('message', 'Something went wrong while trying to register your user.');
				}

			}

		}

	}

	public function postActivate(ActivateRequest $request) {

		if(!\Setting::get('LOGIN_ENABLED')) {
			return Redirect::route('account-activate')
						->with('messagetype', 'warning')
						->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
		} else {

			$username 			= $request->input('username');
			$activation_code	= $request->input('activation_code');
			$credentials 		= ['login' => $username];
			$user 				= Sentinel::findByCredentials($credentials);

			$checkuser = User::where('username', '=', $username)->first();
			if($checkuser == null) {
				return Redirect::route('account-activate')
						->with('messagetype', 'warning')
						->with('message', 'Username and activation code does not match.');
			} else {
				$activation = Act::where('user_id', '=', $checkuser->id)->get();
				if($activation == null) {
					return Redirect::route('account-activate')
						->with('messagetype', 'warning')
						->with('message', 'Could not find activation code.');
				} else {
					if (\Activation::complete($user, $activation_code)) {
						return Redirect::route('account-login')
							->with('messagetype', 'success')
							->with('message', 'Your account has been activated. You can now login!');
					} else {
						return Redirect::route('account-activate')
							->with('messagetype', 'warning')
							->with('message', 'Something went wrong while activating your account. Please try again later.');
					}
				}
			}
		}

	}

	public function postLogin(LoginRequest $request) {

		$login 			= $request->input('login');
		$password 		= $request->input('password');
		$remember 		= $request->input('remember');

		$credentials 	= ['login' => $login, 'password' => $password];
		$user = Sentinel::findByCredentials($credentials);

		if ($user == null) {
			return Redirect::route('account-login')
						->with('messagetype', 'warning')
						->with('message', 'User not found!');
		} else {

			$actex = Activation::exists($user);
			$actco = Activation::completed($user);
			$active = false;
			if($actex) {
				$active = false;
			} elseif($actco) {
				$active = true;
			}

			if ($active === false) {
				return Redirect::route('account-login')
						->with('messagetype', 'warning')
						->with('message', 'Your user is not active! Please check your inbox for the activation email.');
			} elseif ($active === true) {

				try {
					if(!\Setting::get('LOGIN_ENABLED') && !$user->hasAccess(['admin'])) {
						return Redirect::route('account-login')
										->with('messagetype', 'warning')
										->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
					} elseif(Sentinel::authenticate($credentials)) {

						$login = Sentinel::login($user, $remember);
						if(!$login) {
							return Redirect::route('account-login')
											->with('messagetype', 'warning')
											->with('message', 'Could not log you in. Please try again.');
						} else {
							return Redirect::route('dashboard');
						}

					} else {
						return Redirect::route('account-login')
										->with('messagetype', 'warning')
										->with('message', 'Username or password was wrong. Please try again.');
					}
				} catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
					return Redirect::route('account-login')
									->with('messagetype', 'warning')
									->with('message', 'Account is not activated!');
				} catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
					$delay = $e->getDelay();
					return Redirect::route('account-login')
									->with('messagetype', 'warning')
									->with('message', 'Your ip is blocked for '.$delay.' second(s).');
				}
				

			} 

		}

	}

	public function postForgotCredentials(ForgotCredentialsRequest $request) {

		if(!\Setting::get('LOGIN_ENABLED')) {
			return Redirect::route('account-credentials-forgot')
							->with('messagetype', 'warning')
							->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
		} else {

			$login 			= $request->input('login');
			$credentials 	= ['login' => $login];
			$user 			= Sentinel::findByCredentials($credentials);

			if ($user == null) {
				return Redirect::route('account-credentials-forgot')
							->with('messagetype', 'warning')
							->with('message', 'User not found!');
			} else {

				$actex = Activation::exists($user);
				$actco = Activation::completed($user);
				$active = false;
				if($actex) {
					$active = false;
				} elseif($actco) {
					$active = true;
				}

				$remex = Reminder::exists($user);
				$reminder = false;
				if($remex) {
					$reminder = true;
				}

				if ($active == false) {
					return Redirect::route('account-credentials-forgot')
							->with('messagetype', 'warning')
							->with('message', 'Your user is not active! Please check your inbox for the activation email.');
				} elseif ($reminder == true) {
					return Redirect::route('account-credentials-forgot')
							->with('messagetype', 'warning')
							->with('message', 'You have already asked for a reminder! Please check your inbox for the reminder email.');
				} elseif ($active == true && $reminder == false) {

					$reminder 		= Reminder::create($user);
					$reminder_code 	= $reminder->code;

					if(!$reminder) {
						return Redirect::route('account-credentials-forgot')
										->with('messagetype', 'warning')
										->with('message', 'Couldn\'t create a reminder email for you. Please try again or contact the system administrator.');
					}

					Mail::send('emails.auth.forgot-password', 
						array(
							'link' => \URL::route('account-password-reset', $reminder_code),
							'firstname' => $user->firstname,
							'username' => $user->username,
						), function($message) use ($user) {
							$message->to($user->email, $user->firstname)->subject('Forgot Password');
					});
					
					if(count(Mail::failures()) > 0) {
						return Redirect::route('account-credentials-forgot')
										->with('messagetype', 'warning')
										->with('message', 'Something went wrong while trying to send you an email.');
					}

					return Redirect::route('account-credentials-forgot')
									->with('messagetype', 'success')
									->with('message', 'We have sent you an email! Please check your inbox for the reminder email to reset your password.');

				}

			}

		}

	}

	public function postResetPassword(ResetPasswordRequest $request) {

		if(!\Setting::get('LOGIN_ENABLED')) {
			return Redirect::route('account-recover')
							->with('messagetype', 'warning')
							->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
		} else {

			$login 				= $request->input('login');
			$password			= $request->input('password');
			$resetpassword_code	= $request->input('resetpassword_code');
			$credentials 		= ['login' => $login];
			$user 				= Sentinel::findByCredentials($credentials);

			if($user == null) {
				return Redirect::route('account-recover')
								->with('messagetype', 'warning')
								->with('message', 'User not found!');
			} elseif (Reminder::complete($user, $resetpassword_code, $password)) {
				return Redirect::route('account-login')
								->with('messagetype', 'success')
								->with('message', 'Your password has been changed. You can now login!');
			} else {
				return Redirect::route('account-recover')
								->with('messagetype', 'warning')
								->with('message', 'Something went wrong while reseting your password. Please try again later.');
			}

		}

	}

	public function postResendVerification(ResendVerificationRequest $request) {

		if(!\Setting::get('LOGIN_ENABLED')) {
			return Redirect::route('account-resendverification')
							->with('messagetype', 'warning')
							->with('message', 'Login and registration has been disabled at this moment. Please check back later!');
		} else {

			$email 		= $request->input('email');
			$checkuser 	= User::where('email', '=', $email)->first();

			if($checkuser == null) {
				return Redirect::route('account-resendverification')
								->with('messagetype', 'warning')
								->with('message', 'Couldn\'t find account associated with the e-mail! Please try again.');
			} else {
				
				$user = Sentinel::findById($checkuser->id);
				$activation = Activation::exists($user);

				if($activation == null) {
					return Redirect::route('account-resendverification')
								->with('messagetype', 'warning')
								->with('message', 'Your account is already activated or we couldn\'t find any uncompleted activations.');
				} else {
					if ($activation->completed == true) {
						return Redirect::route('account-resendverification')
								->with('messagetype', 'warning')
								->with('message', 'Activation has already been completed.');
					} else {

						Mail::send('emails.auth.activate', array('link' => \URL::route('account-activate', $activation->code), 'firstname' => $checkuser->firstname), function($message) use ($checkuser) {
							$message->to($checkuser->email, $checkuser->firstname)->subject('Activate your account');
						});

						if(count(Mail::failures()) > 0) {
							return Redirect::route('account-resendverification')
										->with('messagetype', 'warning')
										->with('message', 'Something went wrong while trying to send you an email.');
						} else {
							return Redirect::route('account-resendverification')
											->with('messagetype', 'success')
											->with('message', 'We have sent you an email! Please check your inbox.');
						}
					}
				}
			}
		}

	}

}
