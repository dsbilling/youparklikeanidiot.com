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
        #App::abort(404);
        $obj = new \stdClass();
        $obj->name = 'Daniel Billing';
        $obj->email = 'post@dsbilling.no';
        $obj->message = 'Denne nettsiden liker jeg. Kan jeg komme med noen forslag?';
        #return new DPSEI\Mail\Feedback($obj);
        try {
            Mail::to(env('MAIL_FEEDBACK'))->send(new DPSEI\Mail\Feedback($obj));
            return "Success";
        } catch (Exception $ex) {
            // Debug via $ex->getMessage();
            return $ex->getMessage();
        }
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

// Verification Routes...
Route::get('epost/sendny', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('epost/verifiser', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('epost/verifiser/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

// Password Reset Routes...
Route::get('passord/tilbakestill', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('passord/epost', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('passord/tilbakestill/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('passord/tilbakestill', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/', 'HomeController@index')->name('home');

Route::resource('parking', 'SubmissionController');
Route::resource('licenseplate', 'LicensePlateController');
Route::resource('type', 'TypeController');
Route::resource('image', 'ImageController');
Route::resource('user', 'UserController');
Route::resource('info', 'PageController', [
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
