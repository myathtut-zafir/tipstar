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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/match/create', [
    'as' => 'admin.match.create',
    'uses' => 'Admin\MatchesController@create',

]);
Route::get('/admin/match/edit/{id}', [
    'as' => 'admin.matche.edit',
    'uses' => 'Admin\MatchesController@edit',

]);
Route::PATCH('/admin/match/update/{id}', [
    'as' => 'admin.match.update',
    'uses' => 'Admin\MatchesController@update',

]);
Route::get('/ajax-team', 'Admin\MatchesController@teamChoose');
Route::get('/all-team', 'Admin\MatchesController@allTeam');
Route::post('/admin/match/store', [
    'as' => 'admin.match.store',
    'uses' => 'Admin\MatchesController@store',

]);