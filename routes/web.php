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

Route::group(['middleware' => 'guest'], function() {

	Route::get('/', [
		'uses' => 'LoginController@home',
		'as' => 'home'
		]);

	Route::post('/signup',[
		'uses' => 'LoginController@postAdd',
		'as' => 'add'
	]);

	Route::post('/signin',[
		'uses' => 'LoginController@postLogin',
		'as' => 'signin'
	]);
}); 


Route::group(['middleware' => 'auth'], function() {

	Route::get('/dashboard', [
		'uses' => 'StationController@getDashboard',
		'as' => 'dashboard'
	]);

	Route::get('/pracownik',[
		'uses' => 'LoginController@empView',
		'as' => 'emp',
		'middleware' => 'block'
	]);

	Route::get('/pracownik/dodajpracownika',[
		'uses' => 'LoginController@empAdd',
		'as' => 'empAdd',
		'middleware' => 'not_admin'
	]);

	Route::get('/pracownik/listapracownikow',[
		'uses' => 'LoginController@empList',
		'as' => 'empList',
		'middleware' => 'not_admin'
	]);

	Route::get('/usun',[
	'uses' => 'LoginController@empDelete',
	'as' => 'empDelete',
	'middleware' => 'not_admin'
	]);

	Route::post('/admin/zmiendane',[
	'uses' => 'LoginController@postUpdate',
	'as' => 'empUpdate'
	]);
});

