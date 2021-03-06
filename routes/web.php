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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('devices')->group(function () {
	Route::get('/', 'DevicesController@index')->name('devices.index');
	Route::post('create', 'DevicesController@save')->name('devices.create');
	Route::post('update', 'DevicesController@update')->name('devices.update');
	Route::post('delete', 'DevicesController@delete')->name('devices.delete');
});
