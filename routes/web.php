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
        Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('db:seed');
        return redirect('/')->with('status', 'DB has been reset.');
    });
    Route::get('/test', function () {
        App::abort(404);
    });
}
/*
| END DEBUG ONLY
*/

Route::get('logginn', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('logginn', 'Auth\LoginController@login');
Route::post('loggut', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('registrer', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('registrer', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('passord/tilbakestill', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('passord/epost', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('passord/tilbakestill/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('passord/tilbakestill', 'Auth\ResetPasswordController@reset');

Route::get('/', 'HomeController@index')->name('home');
