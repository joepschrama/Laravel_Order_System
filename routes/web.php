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

Route::resource('user', 'UserController');
Route::resource('category', 'CategoryController')->except('show');
Route::resource('product', 'ProductController')->except('show');
Route::resource('role', 'RoleController')->except('show');
Route::resource('table', 'TableController')->except('show');
Route::resource('order', 'OrderController')->except('show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



