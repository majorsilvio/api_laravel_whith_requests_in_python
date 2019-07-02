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
Route::namespace('Api')->name('api.')->group(function(){
	Route::prefix('game')->group(function(){
		Route::get('/', 'GameController@index')->name('index_Game');
		Route::get('/{id}', 'GameController@show')->name('single_Game');
		Route::post('/', 'GameController@store')->name('store_Game');
		Route::put('/{id}', 'GameController@update')->name('update_Game');
		Route::delete('/{id}', 'GameController@delete')->name('delete_Game');
		Route::delete('/', 'GameController@drop')->name('delete_All_Game');
	});

	Route::prefix('anime')->group(function(){
		Route::get('/', 'AnimeController@index')->name('index_Anime');
		Route::get('/{id}', 'AnimeController@show')->name('single_Anime');
		Route::post('/', 'AnimeController@store')->name('store_Anime');
		Route::put('/{id}', 'AnimeController@update')->name('update_Anime');
		Route::delete('/{id}', 'AnimeController@delete')->name('delete_Anime');
	});
});
