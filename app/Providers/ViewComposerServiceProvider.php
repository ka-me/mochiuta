<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts/common', function ($view) {
            $auth_user_followee_count = Auth::user()->getFolloweeCount();
            $auth_user_follower_count = Auth::user()->getFollowerCount();
            
            $view->with(compact('auth_user_followee_count', 'auth_user_follower_count'));
        });
    }
}
