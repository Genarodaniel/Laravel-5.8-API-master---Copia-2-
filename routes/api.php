<?php

use Illuminate\Http\Request;

Route::get('/data', 'DataController@index')->name('path.index');
Route::post('/data', 'DataController@store')->name('path.store');
Route::get('/data/{id}', 'DataController@show')->name('path.show');
Route::put('/data/{data}', 'DataController@update')->name('path.update');
Route::delete('/data/{data}', 'DataController@destroy')->name('path.destroy');
Route::get('/ok','ResidentController@all_users')->name('ok');




	Route::prefix('users')->group(function(){
	Route::post('login','UserController@login');
	Route::post('register','UserController@register');
	Route::group(['middleware' =>'auth:api'], function(){
		Route::post('details','UserController@details');
		Route::get('/', 'User_appController@all_users')->name('all_users');
	});

});
	Route::get('/', 'UserController@all_users')->name('all_users');
	Route::get('/{id}', 'UserController@show')->name('single_user');
	Route::post('/','UserController@store')->name('add_user');
	 

	//Route::prefix('users')->group(function(){
	//route::get('/users','ResidentController@all_users')->name('all_users');
	//Route::get('/ok',function(){
		//return ['status'=>true];
	//});
	
	

?>