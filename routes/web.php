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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', function () {
//     return view('home');
// });


Route::group(['middleware' => ['web']], function(){
	Route::get('/{author?}', [
		'uses' => 'QuoteAppController@getHome',
		'as' => 'home'
	]);
	Route::post('/new', [
		'uses' => 'QuoteAppController@postQuote',
		'as' => 'create'
	]);
	Route::get('/delete/{quote_id}', [
		'uses' => 'QuoteAppController@deleteQuote',
		'as' => 'delete'
	]);
	Route::get('/edit/{quote_id}', [
		'uses' => 'QuoteAppController@getEditQuote',
		'as' => 'edit'
	]);
	Route::post('/edit/post/{quote_id}', [
		'uses' => 'QuoteAppController@postEditQuote',
		'as' => 'post-edit'
	]);
	Route::get('/gotmail/{author_name}', [
		'uses' => 'QuoteAppController@getMailCallback',
		'as' => 'mail_callback'
	]);
	Route::get('/admin/login', [
		'uses' => 'AdminController@getLogin',
		'as' => 'admin.login'
	]);
	Route::post('/admin/login', [
		'uses' => 'AdminController@postLogin',
		'as' => 'admin.login'
	]);
	Route::get('/admin/dashboard', [
		'uses' => 'AdminController@getDashboard',
		'as' => 'admin.dashboard'
	]);
	Route::get('/admin/logout', [
		'uses' => 'AdminController@getLogout',
		'as' => 'admin.logout'
	]);



});