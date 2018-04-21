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

>>>>>>> 2735900fc881ed556e3373494abc5696268691be
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
=======

>>>>>>> 2735900fc881ed556e3373494abc5696268691be
		Route::post('/signup',[
		'uses' => 'LoginController@postAdd',
		'as' => 'add'
	]);
<<<<<<< HEAD
=======

>>>>>>> 2735900fc881ed556e3373494abc5696268691be
	Route::get('/logout', [
			'uses' => 'LoginController@getLogout',
			'as' => 'user.logout'
		]);
	Route::get('/pracownik',[
		'uses' => 'LoginController@employeeView',
		'as' => 'employee',
		'middleware' => 'block'
	]);
	Route::get('/pracownik/dodajpracownika',[
		'uses' => 'LoginController@employeeAdd',
		'as' => 'employeeAdd',
		'middleware' => 'not_admin'
	]);
	Route::get('/pracownik/listapracownikow',[
		'uses' => 'LoginController@employeeList',
		'as' => 'employeeList',
		'middleware' => 'not_admin'
	]);
	Route::get('/usun',[
	'uses' => 'LoginController@employeeDelete',
	'as' => 'employeeDelete',
	'middleware' => 'not_admin'
	]);
	Route::post('/admin/zmiendane',[
	'uses' => 'LoginController@postUpdate',
	'as' => 'employeeUpdate'
<<<<<<< HEAD
	]);

	Route::get('/product-list', [
		'uses' => 'ProductController@getProduct',
		'as' => 'getProduct'
	]);

	Route::get('/new-product', [
		'uses' => 'ProductController@getNewProduct',
		'as' => 'getNewProduct'
=======
>>>>>>> 2735900fc881ed556e3373494abc5696268691be
	]);

	Route::post('/new-product', [
		'uses' => 'ProductController@postNewProduct',
		'as' => 'postNewProduct'
	]);

});

