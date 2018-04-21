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
			$message->to("daniel@infihex.com", "Daniel")->subject('Test Email');
		});
		if(count(Mail::failures()) > 0) {
			dd('Mail Failure.');
		} else {
			dd('Success.');
		}
		return view('emails.auth.activate', ['link'=>route('account-activate', 'derp'), 'firstname'=>'Daniel']);
	});*/
	Route::get('/test', function() {
		App::abort(503);
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
			'prefix' => 'account',
			'middleware' => 'sentinel.auth'
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
		Route::group([
		'middleware' => 'sentinel.auth'
			], function() {
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
				
				
		});
});

Route::group([
	'middleware' => ['sentinel.guest', 'setTheme:frontend'],
	'prefix' => 'account',
	], function() {
		Route::get('/credentials/forgot', [
			'as' => 'account-credentials-forgot' ,
			'uses' => 'Member\AuthController@getForgotCredentials'
		]);
		Route::post('/credentials/forgot', [
			'as' => 'account-credentials-forgot-post' ,
			'uses' => 'Member\AuthController@postForgotCredentials'
		]);
		Route::get('/password/reset/{code}', [
			'as' => 'account-password-reset' ,
			'uses' => 'Member\AuthController@getResetPassword'
		]);
		Route::post('/password/reset', [
			'as' => 'account-password-reset-post' ,
			'uses' => 'Member\AuthController@postResetPassword'
		]);
		Route::get('/register', [
			'as' => 'account-register',
			'uses' => 'Member\AuthController@getRegister'
		]);
		Route::post('/register', [
			'as' => 'account-register-post',
			'uses' => 'Member\AuthController@postRegister'
		]);
		Route::get('/login', [
			'as' => 'account-login',
			'uses' => 'Member\AuthController@getLogin'
		]);
		Route::post('/login', [
			'as' => 'account-login-post',
			'uses' => 'Member\AuthController@postLogin'
		]);
		Route::get('/activate/{activation_code}', [
			'as' => 'account-activate',
			'uses' => 'Member\AuthController@getActivate'
		]);
		Route::post('/activate', [
			'as' => 'account-activate-post',
			'uses' => 'Member\AuthController@postActivate'
		]);
		Route::get('/resendverification', [
			'as' => 'account-resendverification' ,
			'uses' => 'Member\AuthController@getResendVerification'
		]);
		Route::post('/resendverification', [
			'as' => 'account-resendverification-post' ,
			'uses' => 'Member\AuthController@postResendVerification'
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
	
});

// THIS NEEDS TO BE AT THE BOTTOM TO MAKE ALL OTHER ROUTES WORK
Route::get('/{slug}', ['middleware' => 'setTheme:frontend', 'as' => 'page', 'uses' => 'Page\PagesController@show']);