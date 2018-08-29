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

Route::group(['prefix' => 'v1', 'namespace' => 'User'], function () {
	Route::group(['prefix' => 'property'], function () {
    	Route::get('list', 'PropertyController@getList');
    	Route::post('boundries', 'PropertyController@postBoundries');
    	Route::get('information/{propery_id}', 'PropertyController@getInformation');

	});
});