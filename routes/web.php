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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'mypage', 'middleware' => 'auth'], function() {
    Route::get('search', 'Mypage\SearchController@index');
    Route::get('search/artist/{artist}', 'Mypage\SearchController@selectArtist');
    
    Route::get('mochiuta/add/{song}', 'Mypage\MochiutaController@selectSong');
    Route::post('mochiuta/add/song', 'Mypage\MochiutaController@selectSongAdd');
});

Route::group(['prefix' => 'users', 'middleware' => 'auth'], function() {
    Route::get('{user}', 'Users\HomeController@index');
});