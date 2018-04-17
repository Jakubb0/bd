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

Route::get('/pracownik',[
'uses' => 'LoginController@pracownik',
'as' => 'pracownik',
'middleware' => 'blokuj'
]);

Route::get('/pracownik/dodajpracownika',[
'uses' => 'LoginController@dodajpracownika',
'as' => 'dodajpracownika',
'middleware' => 'nie_admin'
]);

Route::get('/pracownik/listapracownikow',[
'uses' => 'LoginController@listapracownikow',
'as' => 'listapracownikow',
'middleware' => 'nie_admin'
]);

Route::get('/pracownik/listapracownikow',[
'uses' => 'LoginController@listapracownikow',
'as' => 'listapracownikow',
'middleware' => 'nie_admin'
]);

Route::get('/usun',[
'uses' => 'LoginController@usun',
'as' => 'usun',
'middleware' => 'nie_admin'
]);

Route::post('/admin/zmiendane',[
'uses' => 'LoginController@postZmien',
'as' => 'zmiendane'
]);

Auth::routes();

