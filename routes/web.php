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
        Route::get('following', 'Mypage\FollowController@following')->name('following');
        Route::get('followers', 'Mypage\FollowController@followers')->name('followers');
        Route::post('follow/{user_id}', 'Mypage\FollowController@follow')->name('follow');
        Route::post('unfollow/{user_id}', 'Mypage\FollowController@unfollow')->name('unfollow');
        
        Route::get('edit', 'Mypage\EditController@edit')->name('edit');
        Route::post('edit/profile', 'Mypage\EditController@updateProfile')->name('profile.update');
        Route::post('edit/email', 'Mypage\EditController@updateEmail')->name('email.update');
        Route::post('edit/password', 'Mypage\EditController@updatePassword')->name('password.update');
        
        Route::get('deactivate', 'Mypage\DeactivateController@deactivate')->name('deactivate');
        Route::post('deactivate', 'Mypage\DeactivateController@destroy')->name('destroy');
        
        Route::get('search', 'Mypage\SearchController@index')->name('search');
        Route::get('search/artist/{artist}', 'Mypage\SearchController@selectArtist')->name('search.selectArtist')->where('artist', '[0-9]+');
        
        Route::get('mochiuta/add/{song}', 'Mypage\MochiutaController@select')->name('mochiuta.select')->where('song', '[0-9]+');
        Route::post('mochiuta/add/song', 'Mypage\MochiutaController@addSelect')->name('mochiuta.addSelect');
        
        Route::get('mochiuta/edit/{song_id}', 'Mypage\MochiutaController@edit')->name('mochiuta.edit')->where('song_id', '[0-9]+');
        Route::post('mochiuta/delete/{song_id}', 'Mypage\MochiutaController@delete')->name('mochiuta.delete');
    });
    
    Route::prefix('users')->group(function() {
        Route::get('{user}', 'Users\HomeController@index')->name('users.home')->where('user', '[0-9]+');
        
        Route::get('{user}/following', 'Users\FollowController@following')->name('users.following')->where('user', '[0-9]+');
        Route::get('{user}/followers', 'Users\FollowController@followers')->name('users.followers')->where('user', '[0-9]+');
        
        Route::get('search', 'Users\SearchController@index')->name('users.search');
    });
    
    Route::middleware(['admin'])->group(function() {
        Route::get('admin', 'Admin\HomeController@index')->name('admin.home');
    });
});