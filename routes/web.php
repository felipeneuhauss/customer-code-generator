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
Route::get('/codes', 'CodeController@index')->name('codes');
Route::get('/generate-codes', 'CodeController@generate')->name('generate-codes');
Route::get('/export-codes', 'CodeController@export')->name('export-codes');
Route::get('/check-code/{code}', 'CodeController@check')->name('check-code');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');