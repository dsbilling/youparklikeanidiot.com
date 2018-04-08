<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('api');

Route::get('/stats', [
	'as' => 'api-stats',
	'uses' => 'API\APIController@stats'
])->middleware('api');

Route::get('/news/{amount}', [
	'as' => 'api-news',
	'uses' => 'API\APIController@news'
])->middleware('api');

Route::get('/news/{amount}/{skip}', [
	'as' => 'api-news-skip',
	'uses' => 'API\APIController@skipNews'
])->middleware('api');