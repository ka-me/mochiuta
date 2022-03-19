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

Route::middleware(['auth'])->group(function() {
    Route::get('/', 'HomeController@index')->name('home');

    Route::prefix('mypage')->group(function() {
        Route::get('following', 'Mypage\FollowController@following');
        Route::get('followers', 'Mypage\FollowController@followers');
        Route::post('follow/{user_id}', 'Mypage\FollowController@follow');
        Route::post('unfollow/{user_id}', 'Mypage\FollowController@unfollow');
        
        Route::get('search', 'Mypage\SearchController@index');
        Route::get('search/artist/{artist}', 'Mypage\SearchController@selectArtist');
        
        Route::get('mochiuta/add/{song}', 'Mypage\MochiutaController@selectSong');
        Route::post('mochiuta/add/song', 'Mypage\MochiutaController@selectSongAdd');
    });
    
    Route::prefix('users')->group(function() {
        Route::get('{user}', 'Users\HomeController@index')->where('user', '[0-9]+');
        Route::get('search', 'Users\SearchController@index');
    });
    
    Route::middleware(['admin'])->group(function() {
        Route::get('admin', 'Admin\HomeController@index');
    });
});