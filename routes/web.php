<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
| DEBUG ONLY
*/
if(Config::get('app.debug')) {
	Route::get('/resetdb', function() {
		Artisan::call('migrate:reset');
		Artisan::call('migrate');
		Artisan::call('db:seed');
		return Redirect::to('/')->with('messagetype', 'success')->with('message', 'The database has been reset!');
	});
	/*Route::get('/mailtest', function() {
		Mail::send('emails.auth.activate', ['link'=>route('account-activate', 'derp'),'firstname'=>'Daniel'], function($message) {
			$message->to("daniel@retardedtech.com", "Daniel")->subject('Test Email');
		});
		if(count(Mail::failures()) > 0) {
			dd('Mail Failure.');
		} else {
			dd('Success.');
		}
		return view('emails.auth.activate', ['link'=>route('account-activate', 'derp'), 'firstname'=>'Daniel']);
	});*/
	Route::get('/test', function() {
		App::abort(500);
	});
	/*Route::get('/aau', function() {
		echo "AAU - Activate All Users<br><br>";
		$users = User::where('last_activity', '<>', '0000-00-00 00:00:00')->get();
		$userstofix = array();
		foreach ($users as $user) {
			array_push($userstofix, $user->id);
			echo "<br>".$user->id;
		}
		echo "<hr>";
		foreach ($userstofix as $u) {
			$theuser = Sentinel::findById($u);
			$actex = Act::where('user_id', '=', $u)->where('completed', '=', 1)->count();
			if($actex <= 0) {
				$act = Activation::create($theuser);
				echo "<br> complete act".Activation::complete($theuser, $act->code);
			}
		}
	});*/
}

Route::group([
	'middleware' => 'setTheme:frontend'
	], function() {
		Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
		Route::get('/r/{code}', ['middleware' => 'sentinel.guest', 'as' => 'account-referral', 'uses' => 'Member\ReferralController@store']);
		Route::group([
			'prefix' => 'news'
			], function() {
				Route::get('/', [
					'as' => 'news',
					'uses' => 'News\NewsController@index'
				]);
				Route::get('/{slug}', [
					'as' => 'news-show',
					'uses' => 'News\NewsController@show'
				]);
				Route::get('/category/{slug}', [
					'as' => 'news-category-show',
					'uses' => 'News\NewsCategoryController@show'
				]);
		});
		Route::group([
		'middleware' => ['sentinel.auth'],
		'prefix' => 'user',
			], function() {
				Route::get('/', [
					'as' => 'dashboard' ,
					'uses' => 'Member\AccountController@getDashboard'
				]);
				Route::get('/logout', [
					'as' => 'logout',
					'uses' => 'Member\AuthController@getLogout'
				]);
				Route::get('/profile/{username}', [
					'as' => 'user-profile',
					'uses' => 'Member\MemberController@profile'
				]);
				Route::get('/members', [
					'as' => 'members',
					'uses' => 'Member\MemberController@index'
				]);
				Route::post('/members/search', [
					'as' => 'members-search',
					'uses' => 'Member\MemberController@search'
				]);
				
				Route::group([
					'prefix' => 'account'
					], function() {
						Route::get('/', [
							'as' => 'account' ,
							'uses' => 'Member\AccountController@getAccount'
						]);
						Route::get('/settings', [
							'as' => 'account-settings' ,
							'uses' => 'Member\AccountController@getSettings'
						]);
						Route::post('/settings', [
							'as' => 'account-settings-post' ,
							'uses' => 'Member\AccountController@postSettings'
						]);
						Route::get('/change/password', [
							'as' => 'account-change-password' ,
							'uses' => 'Member\AccountController@getChangePassword'
						]);
						Route::post('/change/password', [
							'as' => 'account-change-password-post' ,
							'uses' => 'Member\AccountController@postChangePassword'
						]);
						Route::get('/change/details', [
							'as' => 'account-change-details' ,
							'uses' => 'Member\AccountController@getChangeDetails'
						]);
						Route::post('/change/details', [
							'as' => 'account-change-details-post' ,
							'uses' => 'Member\AccountController@postChangeDetails'
						]);
						Route::get('/change/images', [
							'as' => 'account-change-images' ,
							'uses' => 'Member\AccountController@getChangeImages'
						]);
						Route::post('/change/images/profile', [
							'as' => 'account-change-image-profile-post' ,
							'uses' => 'Member\AccountController@postChangeProfileImage'
						]);
						Route::post('/change/images/cover', [
							'as' => 'account-change-image-cover-post' ,
							'uses' => 'Member\AccountController@postChangeProfileCover'
						]);
						Route::group([
							'prefix' => 'addressbook'
							], function() {
								Route::get('/', [
									'as' => 'account-addressbook',
									'uses' => 'Member\AddressBookController@index'
								]);
								Route::get('/create', [
									'as' => 'account-addressbook-create',
									'uses' => 'Member\AddressBookController@create'
								]);
								Route::post('/store', [
									'as' => 'account-addressbook-store',
									'uses' => 'Member\AddressBookController@store'
								]);
								Route::get('/{id}/edit', [
									'as' => 'account-addressbook-edit',
									'uses' => 'Member\AddressBookController@edit'
								]);
								Route::post('/{id}/update', [
									'as' => 'account-addressbook-update',
									'uses' => 'Member\AddressBookController@update'
								]);
								Route::get('/{id}/destroy', [
									'as' => 'account-addressbook-destroy',
									'uses' => 'Member\AddressBookController@destroy'
								]);
						});
				});
		});
});

Route::group([
	'middleware' => ['sentinel.guest', 'setTheme:frontend'],
	'prefix' => 'account',
	], function() {
		Route::get('/forgot/password', [
			'as' => 'account-forgot-password' ,
			'uses' => 'Member\RecoverController@getForgotPassword'
		]);
		Route::get('/resetpassword/{code}', [
			'as' => 'account-recover' ,
			'uses' => 'Member\RecoverController@getResetPassword'
		]);
		Route::get('/register', [
			'as' => 'account-register',
			'uses' => 'Member\AuthController@getRegister'
		]);
		Route::get('/login', [
			'as' => 'account-login',
			'uses' => 'Member\AuthController@getLogin'
		]);
		Route::get('/activate/{activation_code}', [
			'as' => 'account-activate',
			'uses' => 'Member\AuthController@getActivate'
		]);
		Route::get('/resendverification', [
			'as' => 'account-resendverification' ,
			'uses' => 'Member\RecoverController@getResendVerification'
		]);
		
});



// ADMIN PANEL
Route::group([
	'middleware' => ['sentinel.auth', 'sentinel.admin', 'setTheme:neon-admin'],
	'prefix' => 'admin',
	], function() {
		Route::get('/', [
			'as' => 'admin' ,
			'uses' => 'Admin\AdminController@dashboard'
		]);
		Route::group([
			'prefix' => 'news'
			], function() {
				Route::get('/', [
					'as' => 'admin-news',
					'uses' => 'News\NewsController@admin'
				]);
				Route::get('/create', [
					'as' => 'admin-news-create',
					'uses' => 'News\NewsController@create'
				]);
				Route::post('/store', [
					'as' => 'admin-news-store',
					'uses' => 'News\NewsController@store'
				]);
				Route::get('/{id}/edit', [
					'as' => 'admin-news-edit',
					'uses' => 'News\NewsController@edit'
				]);
				Route::post('/{id}/update', [
					'as' => 'admin-news-update',
					'uses' => 'News\NewsController@update'
				]);
				Route::get('/{id}/destroy', [
					'as' => 'admin-news-destroy',
					'uses' => 'News\NewsController@destroy'
				]);
				Route::group([
					'prefix' => 'categories'
					], function() {
						Route::get('/', [
							'as' => 'admin-news-category',
							'uses' => 'News\NewsCategoryController@admin'
						]);
						Route::get('/create', [
							'as' => 'admin-news-category-create',
							'uses' => 'News\NewsCategoryController@create'
						]);
						Route::post('/store', [
							'as' => 'admin-news-category-store',
							'uses' => 'News\NewsCategoryController@store'
						]);
						Route::get('/{id}/edit', [
							'as' => 'admin-news-category-edit',
							'uses' => 'News\NewsCategoryController@edit'
						]);
						Route::post('/{id}/update', [
							'as' => 'admin-news-category-update',
							'uses' => 'News\NewsCategoryController@update'
						]);
						Route::get('/{id}/destroy', [
							'as' => 'admin-news-category-destroy',
							'uses' => 'News\NewsCategoryController@destroy'
						]);
				});
		});
		Route::group([
			'prefix' => 'pages'
			], function() {
				Route::get('/', [
					'as' => 'admin-pages',
					'uses' => 'Page\PagesController@admin'
				]);
				Route::get('/create', [
					'as' => 'admin-pages-create',
					'uses' => 'Page\PagesController@create'
				]);
				Route::post('/store', [
					'as' => 'admin-pages-store',
					'uses' => 'Page\PagesController@store'
				]);
				Route::get('/{id}/edit', [
					'as' => 'admin-pages-edit',
					'uses' => 'Page\PagesController@edit'
				]);
				Route::post('/{id}/update', [
					'as' => 'admin-pages-update',
					'uses' => 'Page\PagesController@update'
				]);
				Route::get('/{id}/destroy', [
					'as' => 'admin-pages-destroy',
					'uses' => 'Page\PagesController@destroy'
				]);
		});
		Route::group([
			'prefix' => 'system'
			], function() {
				Route::get('logs', [
					'as' => 'admin-logs',
					'uses' => 'Admin\LogController@index'
				]);
				Route::get('/whatsnew', [
					'as' => 'admin-whatsnew' ,
					'uses' => 'Admin\AdminController@whatsnew'
				]);
				Route::group([
					'prefix' => 'license'
					], function() {
						Route::get('/', [
							'as' => 'admin-license',
							'uses' => 'Admin\LicenseController@index'
						]);
						Route::get('/check', [
							'as' => 'admin-license-check',
							'uses' => 'Admin\LicenseController@check'
						]);
						Route::post('/store', [
							'as' => 'admin-license-store',
							'uses' => 'Admin\LicenseController@store'
						]);
				});
				Route::group([
					'prefix' => 'settings'
					], function() {
						Route::get('/', [
							'as' => 'admin-settings',
							'uses' => 'Admin\SettingsController@index'
						]);
						Route::get('/{id}/edit', [
							'as' => 'admin-settings-edit',
							'uses' => 'Admin\SettingsController@edit'
						]);
						Route::post('/{id}/update', [
							'as' => 'admin-settings-update',
							'uses' => 'Admin\SettingsController@update'
						]);
				});
		});

});

Route::group(['prefix' => 'ajax',], function() {
	Route::get('/usernames', function () {
		if(!Request::ajax()) {
			abort(403);
		}
		$users = User::all();
		$usernames = array();
		foreach($users as $user) {
			if($user->showname) {
				array_push($usernames, array('id' => $user->id, 'name' => $user->firstname.' "' .$user->username. '" '.$user->lastname));
			} else {
				array_push($usernames, array('id' => $user->id, 'name' => $user->firstname.' "' .$user->username. '"'));
			}
		}
		return Response::json($usernames);
	});
	Route::get('/pages', function () {
		if(!Request::ajax()) {
			abort(403);
		}
		$allpages = Page::where('active', '=', 1)->where('showinmenu', '=', 1)->get();
		$pages = array();
		foreach($allpages as $page) {
			array_push($pages, array('slug' => $page->slug, 'title' => $page->title));
		}
		return Response::json($pages);
	});
	Route::post('/account/register', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		if(!Setting::get('LOGIN_ENABLED')) {
			$status = 'invalid';
			$msg = 'Login and registration has been disabled at this moment. Please check back later!';
		} else {

			$resp = array();

			$status = 'invalid';
			$msg = 'Something went wrong...';

			$email 				= Request::get('email');
			$firstname	 		= Request::get('firstname');
			$lastname 			= Request::get('lastname');
			$username 			= Request::get('username');
			$password 			= Request::get('password');

			$originalDate 		= Request::input('birthdate');
			$birthdate 			= date_format(date_create_from_format('d/m/Y', $originalDate), 'Y-m-d'); //strtotime fucks the date up so this is the solution

			$referral			= Session::get('referral');
			$referral_code 		= str_random(15);

			$checkusername 		= User::where('username', '=', $username)->first();
			$checkemail 		= User::where('email', '=', $email)->first();

			if(!is_null($checkusername)) { 
				$status = 'invalid';
				$msg = 'Username is already taken.';
			}

			if(!is_null($checkemail)) { 
				$status = 'invalid';
				$msg = 'Email is already taken.';
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

					$status = 'success';

					Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $activation_code), 'firstname' => $firstname), function($message) use ($user) {
						$message->to($user->email, $user->firstname)->subject('Activate your account');
					});

					if(count(Mail::failures()) > 0) {
						$status = 'invalid';
						$msg = 'Something went wrong while trying to send you an email.';
					}

					Session::forget('referral'); //forget the referral

				} else {
					$status = 'invalid';
					$msg = 'Something went wrong while trying to register your user.';
				}

			}

		}
		
		$resp['status'] = $status;
		$resp['msg'] = $msg;
		return Response::json($resp);
	});
	Route::post('/account/activate', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		if(!Setting::get('LOGIN_ENABLED')) {
			$status = 'invalid';
			$msg = 'Login and registration has been disabled at this moment. Please check back later!';
		} else {

			$resp 		= array();
			$status 	= 'invalid';
			$msg 		= 'Something went wrong...';

			$username 			= Request::input('username');
			$activation_code	= Request::input('activation_code');
			$credentials 		= ['login' => $username];
			$user 				= Sentinel::findByCredentials($credentials);

			$checkuser = User::where('username', '=', $username)->first();
			if($checkuser == null) {
				$msg = 'Username and activation code does not match.';
			} else {
				$activation = Act::where('user_id', '=', $checkuser->id)->get();
				if($activation == null) {
					$msg = 'Could not find activation code.';
				} else {
					if (Activation::complete($user, $activation_code)) {
						$status = 'success';
						$resp['redirect_url'] 	= URL::route('account-login');
					} else {
						$msg = 'Something went wrong while activating your account. Please try again later.';
					}
				}
			}
		}

		$resp['status'] = $status;
		$resp['msg'] 	= $msg;

		return Response::json($resp);

	});
	Route::post('/account/login', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		$resp = array();
		$status = 'invalid';
		$msg = 'Something went wrong...';

		$username 		= Request::input('username');
		$password 		= Request::input('password');
		$remember 		= Request::input('remember');

		$credentials 	= ['login' => $username, 'password' => $password];
		$user = Sentinel::findByCredentials($credentials);

		if ($user == null) {

			$msg = 'User not found!';

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

				$msg = '<strong>Your user is not active!</strong><br>Please check your inbox for the activation email.';

			} elseif ($active === true) {

				try {
					if(!Setting::get('LOGIN_ENABLED') && !$user->hasAccess(['admin'])) {

						$status = 'invalid';
						$msg = 'Login and registration has been disabled at this moment. Please check back later!';

					} elseif(Sentinel::authenticate($credentials)) {

						$login = Sentinel::login($user, $remember);
						if(!$login) {
							$msg = 'Could not log you in. Please try again.';
						} else {
							$status = 'success';
							$resp['redirect_url'] = URL::route('dashboard');
						}

					} else {
						$msg = 'Username or password was wrong. Please try again.';
					}
				} catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
					$status = 'invalid';
					$msg = 'Account is not activated!';
				} catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
					$status = 'invalid';
					$delay = $e->getDelay();
					$msg = 'Your ip is blocked for '.$delay.' second(s).';
				}
				

			} 

		}

		$resp['status'] = $status;
		$resp['msg'] = $msg;

		return Response::json($resp);
	});
	Route::post('/account/forgot/password', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		if(!Setting::get('LOGIN_ENABLED')) {
			$status = 'invalid';
			$msg = 'Login and registration has been disabled at this moment. Please check back later!';
		} else {

			$resp = array();
			$status = 'invalid';
			$msg = 'Something went wrong...';

			$username = Request::input('username');

			$credentials 	= ['login' => $username];

			$user = Sentinel::findByCredentials($credentials);

			if ($user == null) {

				$msg = 'User not found!';

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

					$msg = '<strong>Your user is not active!</strong><br>Please check your inbox for the activation email.';

				} elseif ($reminder == true) {

					$msg = '<strong>You have already asked for a reminder!</strong><br>Please check your inbox for the reminder email.';

				} elseif ($active == true && $reminder == false) {

					$reminder 		= Reminder::create($user);
					$reminder_code 	= $reminder->code;

					Mail::send('emails.auth.forgot-password', 
						array(
							'link' => URL::route('account-recover', $reminder_code),
							'firstname' => $user->firstname,
							'username' => $user->username,
						), function($message) use ($user) {
							$message->to($user->email, $user->firstname)->subject('Forgot Password');
					});
					
					if(count(Mail::failures()) > 0) {
						$msg = 'Mail Failure.';
					} else {
						$status = 'success';
						$msg = 'Everything went well.';
					}

					if(!$reminder) {
						$msg = 'E-mail or birthdate was wrong. Please try again.';
					}
				}

			}

		}

		$resp['status'] 	= $status;
		$resp['msg'] 	= $msg;

		return Response::json($resp);
	});
	Route::post('/account/resetpassword', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		if(!Setting::get('LOGIN_ENABLED')) {
			$status = 'invalid';
			$msg = 'Login and registration has been disabled at this moment. Please check back later!';
		} else {

			$resp 		= array();
			$status 	= 'invalid';
			$msg 		= 'Something went wrong...';

			$username 			= Request::input('username');
			$password 			= Request::input('password');
			$resetpassword_code	= Request::input('resetpassword_code');
			$credentials 		= ['login' => $username];
			$user 				= Sentinel::findByCredentials($credentials);

			if($user == null) {
				$msg 		= 'User not found!';
			} elseif (Reminder::complete($user, $resetpassword_code, $password)) {
				$status 				= 'success';
				$msg 					= 'Everything went well.';
				$resp['redirect_url'] 	= URL::route('account-login');
			} else {
				$msg 	= 'Something went wrong while reseting your password. Please try again later.';
			}

		}
		
		$resp['status'] 	= $status;
		$resp['msg'] 		= $msg;

		return Response::json($resp);
		
	});
	Route::post('/account/resendverification', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		if(!Setting::get('LOGIN_ENABLED')) {
			$status = 'invalid';
			$msg = 'Login and registration has been disabled at this moment. Please check back later!';
		} else {

			$resp 		= array();
			$status 	= 'invalid';
			$msg 		= 'Something went wrong...';

			$email 	= Request::input('email');

			$checkuser = User::where('email', '=', $email)->first();
			if($checkuser == null) {
				$msg = "Couldn't find account associated with the e-mail! Please try again.";
			} else {
				
				$user = Sentinel::findById($checkuser->id);
				$activation = Activation::exists($user);

				if($activation == null) {
					$msg = "Your account is already activated or we couldn't find any uncompleted activations.";
				} else {
					if ($activation->completed == true) {
					    $msg = "Activation has already been completed.";
					} else {
					    $status = 'success';
						$msg = 'Everything went well.';
						Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $activation->code), 'firstname' => $checkuser->firstname), function($message) use ($checkuser) {
							$message->to($checkuser->email, $checkuser->firstname)->subject('Activate your account');
						});

						if(count(Mail::failures()) > 0) {
							$status = 'invalid';
							$msg = 'Something went wrong while trying to send you an email.';
						}
					}
				}
			}
		}

		$resp['status'] = $status;
		$resp['msg'] 	= $msg;

		return Response::json($resp);

	});
});

// THIS NEEDS TO BE AT THE BOTTOM TO MAKE ALL OTHER ROUTES WORK
Route::get('/{slug}', ['middleware' => 'setTheme:frontend', 'as' => 'page', 'uses' => 'Page\PagesController@show']);