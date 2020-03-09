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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('matches', 'Admin\MatchesController@getAllMatches');
Route::get('match-date', 'Admin\Api\HomeApiController@index');
Route::get('match-detail/{matchDateId}', 'Admin\Api\MatcheDetailApiController@show');
//Auth
Route::post('social-login/{provider}', 'Auth\AuthController@SocialSignup')->name('customer.login');

