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
    return view('Login');
});
Route::get('register', function () {
    return view('Register');
});
Route::post('Login','AuthController@postLogin');
Route::get('Logout','AuthController@getLogout');
Route::get('send','AuthController@sendmail');