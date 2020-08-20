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
if (Config::get('app.debug')) {
    Route::get('/resetdb', function () {
        \Session::forget('laravel_session');
        Artisan::call('cache:clear');
        Artisan::call('migrate:reset');
        Artisan::call('dpsei:update');
        Artisan::call('db:seed');
        return Redirect::to('/')->with('messagetype', 'success')->with('message', 'The database has been reset!');
    });
    Route::get('/test', function () {
        App::abort(404);
    });
}
/*
| END DEBUG ONLY
*/

Route::get(__('auth.signin.uri'), 'Auth\LoginController@showLoginForm')->name('login');
Route::post(__('auth.signin.uri'), 'Auth\LoginController@login');
Route::post(__('auth.signout.uri'), 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get(__('auth.signup.uri'), 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post(__('auth.signup.uri'), 'Auth\RegisterController@register');

// Verification Routes...
Route::get(__('auth.email.uri').'/sendny', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get(__('auth.email.uri').'/'.__('auth.email.verify.uri'), 'Auth\VerificationController@show')->name('verification.notice');
Route::get(__('auth.email.uri').'/'.__('auth.email.verify.uri').'/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

// Password Reset Routes...
Route::get(__('auth.password.reset.uri'), 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post(__('auth.password.reset.uri').'/'.__('auth.email.uri'), 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get(__('auth.password.reset.uri').'/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post(__('auth.password.reset.uri'), 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/', 'HomeController@index')->name('home');
Route::post('feedback', 'FeedbackController@store')->name('feedback');
Route::resource(__('search.uri'), 'SearchController', [
    'names' => [
        'index' => 'search.index',
        'create' => 'search.create',
        'store' => 'search.store',
        'show' => 'search.show',
        'edit' => 'search.edit',
        'update' => 'search.update',
        'destroy' => 'search.destroy',
    ]
]);

Route::resource(__('parking.uri'), 'SubmissionController', [
    'names' => [
        'index' => 'parking.index',
        'create' => 'parking.create',
        'store' => 'parking.store',
        'show' => 'parking.show',
        'edit' => 'parking.edit',
        'update' => 'parking.update',
        'destroy' => 'parking.destroy',
    ]
]);
Route::resource(__('licenseplate.uri'), 'LicensePlateController', [
    'names' => [
        'index' => 'licenseplate.index',
        'create' => 'licenseplate.create',
        'store' => 'licenseplate.store',
        'show' => 'licenseplate.show',
        'edit' => 'licenseplate.edit',
        'update' => 'licenseplate.update',
        'destroy' => 'licenseplate.destroy',
    ]
]);
Route::resource(__('type.uri'), 'TypeController', [
    'names' => [
        'index' => 'type.index',
        'create' => 'type.create',
        'store' => 'type.store',
        'show' => 'type.show',
        'edit' => 'type.edit',
        'update' => 'type.update',
        'destroy' => 'type.destroy',
    ]
]);
Route::resource(__('image.uri'), 'ImageController', [
    'names' => [
        'index' => 'image.index',
        'create' => 'image.create',
        'store' => 'image.store',
        'show' => 'image.show',
        'edit' => 'image.edit',
        'update' => 'image.update',
        'destroy' => 'image.destroy',
    ]
]);
Route::resource(__('user.uri'), 'UserController', [
    'names' => [
        'index' => 'user.index',
        'create' => 'user.create',
        'store' => 'user.store',
        'show' => 'user.show',
        'edit' => 'user.edit',
        'update' => 'user.update',
        'destroy' => 'user.destroy',
    ]
]);
Route::resource(__('info.uri'), 'PageController', [
    'names' => [
        'index' => 'page.index',
        'create' => 'page.create',
        'store' => 'page.store',
        'show' => 'page.show',
        'edit' => 'page.edit',
        'update' => 'page.update',
        'destroy' => 'page.destroy',
    ]
]);

Route::get(__('account.password.change.uri'), 'Account\ChangePasswordController@create')->name('account.password.change');
Route::post(__('account.password.change.uri'), 'Account\ChangePasswordController@store')->name('account.password.change.store');

Route::get(__('account.profile.change.uri'), 'Account\ChangeProfileController@create')->name('account.profile.change');
Route::post(__('account.profile.change.uri'), 'Account\ChangeProfileController@store')->name('account.profile.change.store');

Route::get(__('account.members.uri'), 'Account\MembersController@index')->name('account.members');
