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

Auth::routes();

Route::get('/', 'HomeController@index')->middleware('auth')->name('home');

Route::group(['prefix' => 'mypage', 'middleware' => 'auth'], function() {
    
    Route::get('mochiuta/add', 'Mypage\MochiutaController@add');
    Route::post('mochiuta/add', 'Mypage\MochiutaController@mochiutaAdd');
    
});