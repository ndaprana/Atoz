<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('/prepaid-balance', 'OrdersController@prepaid');
Route::get('/product', 'OrdersController@product');

Route::post('/order/prepaid-balance', 'OrdersController@postPrepaid');
Route::post('/order/product', 'OrdersController@postProduct');

Route::post('/order/search', 'OrdersController@orderSearch');
Route::get('/payment', 'OrdersController@payment');
Route::post('/order/payment', 'OrdersController@orderPayment');
Route::get('/order', 'OrdersController@orderList');
Route::get('/order/pay/{id}', 'OrdersController@orderPay')->where('id', '.*');
Route::get('/order/{id}', 'OrdersController@orderSucccess')->where('id', '.*');
