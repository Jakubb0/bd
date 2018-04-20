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

<<<<<<< HEAD
=======
	Route::post('/signup',[
		'uses' => 'LoginController@postAdd',
		'as' => 'add'
	]);

>>>>>>> 17e336bcf9759ccf23edde0ad6a173944d96bffd
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

<<<<<<< HEAD
		Route::post('/signup',[
		'uses' => 'LoginController@postAdd',
		'as' => 'add'
	]);

=======
>>>>>>> 17e336bcf9759ccf23edde0ad6a173944d96bffd
	Route::get('/logout', [
			'uses' => 'LoginController@getLogout',
			'as' => 'user.logout'
		]);

	Route::get('/pracownik',[
<<<<<<< HEAD
		'uses' => 'LoginController@employeeView',
		'as' => 'employee',
=======
		'uses' => 'LoginController@empView',
		'as' => 'emp',
>>>>>>> 17e336bcf9759ccf23edde0ad6a173944d96bffd
		'middleware' => 'block'
	]);

	Route::get('/pracownik/dodajpracownika',[
<<<<<<< HEAD
		'uses' => 'LoginController@employeeAdd',
		'as' => 'employeeAdd',
=======
		'uses' => 'LoginController@empAdd',
		'as' => 'empAdd',
>>>>>>> 17e336bcf9759ccf23edde0ad6a173944d96bffd
		'middleware' => 'not_admin'
	]);

	Route::get('/pracownik/listapracownikow',[
<<<<<<< HEAD
		'uses' => 'LoginController@employeeList',
		'as' => 'employeeList',
=======
		'uses' => 'LoginController@empList',
		'as' => 'empList',
>>>>>>> 17e336bcf9759ccf23edde0ad6a173944d96bffd
		'middleware' => 'not_admin'
	]);

	Route::get('/usun',[
<<<<<<< HEAD
	'uses' => 'LoginController@employeeDelete',
	'as' => 'employeeDelete',
=======
	'uses' => 'LoginController@empDelete',
	'as' => 'empDelete',
>>>>>>> 17e336bcf9759ccf23edde0ad6a173944d96bffd
	'middleware' => 'not_admin'
	]);

	Route::post('/admin/zmiendane',[
	'uses' => 'LoginController@postUpdate',
<<<<<<< HEAD
	'as' => 'employeeUpdate'
=======
	'as' => 'empUpdate'
>>>>>>> 17e336bcf9759ccf23edde0ad6a173944d96bffd
	]);
});

