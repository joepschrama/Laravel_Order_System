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

Route::resource('user', 'UserController')->middleware('role:admin');
Route::resource('category', 'CategoryController')->except('show')->middleware('role:admin');
Route::resource('product', 'ProductController')->except('show')->middleware('role:admin');
Route::resource('role', 'RoleController')->except('show')->middleware('role:admin');
Route::resource('table', 'TableController')->except('show')->middleware('role:admin');
Route::resource('order', 'OrderController')->except('show');

Route::post('/order/ready', 'OrderController@orderReady')->name('order.ready');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



