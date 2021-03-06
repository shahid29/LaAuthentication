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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login/facebook','Auth\LoginController@redirectFacebook');
Route::get('/login/facebook/callback','Auth\LoginController@handleFacebookCallback');
Route::get('/login/google','Auth\LoginController@redirectGoogle');
Route::get('/login/google/callback','Auth\LoginController@handleGoogleCallback');
Route::get('/login/twitter','Auth\LoginController@redirectTwitter')->name('twlogin');
Route::get('/login/twitter/callback','Auth\LoginController@handleTwitterCallback')->name('twcallback');
Route::get('/verification/{token}','Auth\RegisterController@verification');
