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
		Route::post('/signup',[
		'uses' => 'LoginController@postAdd',
		'as' => 'add'
	]);

	Route::get('/logout', [
			'uses' => 'LoginController@getLogout',
			'as' => 'user.logout'
		]);

//EMPLOYEE 
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

	]);


//PRODUCTS
	Route::get('/product-list', [
		'uses' => 'ProductController@getProduct',
		'as' => 'getProduct'
	]);

	Route::get('/new-product', [
		'uses' => 'ProductController@getNewProduct',
		'as' => 'getNewProduct'

	]);

	Route::post('/new-product', [
		'uses' => 'ProductController@postNewProduct',
		'as' => 'postNewProduct'
	]);



//LOGS
	Route::get('/logs', [
		'uses' => 'LogsController@viewLogs',
		'as' => 'logs',
		'middleware'=>'not_admin'
	]);

// LOYAL CLIENT
	Route::get('/loyalclients', [
		'uses' => 'LoyalController@loyalclientView',
		'as' => 'loyalView'
	]);

	Route::get('/loyalclients/add', [
		'uses' => 'LoyalController@add',
		'as' => 'loyalAdd'
	]);

	Route::get('/loyalclients/delete', [
		'uses' => 'LoyalController@loyalclientDelete',
		'as' => 'loyalDelete'
	]);

	Route::post('/loyalclients/postAdd', [
		'uses' => 'LoyalController@loyalclientAdd',
		'as' => 'loyalpostAdd'
	]);


// SEARCH

	Route::get('/search', 'SearchController@search');

	Route::get('/searchLog', 'SearchController@searchLogs');

// CASHBOXES
	
	Route::get('/cashboxes', [
		'uses' => 'CashboxController@view',
		'as' => 'cashboxes',
		'middleware' => 'not_admin'
	]);
	
	Route::post('/cashboxes/add', [
		'uses' => 'CashboxController@add',
		'as' => 'addCashbox', 
		'middleware' => 'not_admin'
	]);

	Route::get('/cashboxes/select', [
		'uses' => 'CashboxController@select',
		'as' => 'selectCashbox'
	]);

	Route::post('/cashboxes/select/use', [
		'uses' => 'CashboxController@use',
		'as' => 'useCashbox'
	]);


// CART

	Route::get('/add-to-cart/{id}', [
		'uses' => 'ProductController@getAddToCart',
		'as' => 'product.addToCart'
	]);

	Route::get('/shopping-cart', [
		'uses' => 'ProductController@getCart',
		'as' => 'product.getCart'
	]);




// INVOICES

	Route::get('/invoices', [
		'uses' => 'InvoicesController@view',
		'as' => 'viewInvoices'
	]);

	Route::get('/invoices/add', [
		'uses' => 'InvoicesController@add',
		'as' => 'addInvoices'
	]);

	Route::post('/invoices/new', [
		'uses' => 'InvoicesController@new',
		'as' => 'newInvoices'
	]);

// DEPOTS

	Route::get('/depots', [
		'uses' => 'DepotsController@view',
		'as' => 'depots'
	]);

	Route::get('/depots/add', [
		'uses' => 'DepotsController@add',
		'as' => 'depotsAdd'
	]);

	Route::get('/depots/delete', [
		'uses' => 'DepotsController@delete',
		'as' => 'depotsDelete'
	]);


	Route::post('/depots/new', [
		'uses' => 'DepotsController@new',
		'as' => 'depotsNew'
	]);

});

