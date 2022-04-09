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
            $follow_count = Auth::user()->getFollowCount();
            $follower_count = Auth::user()->getFollowerCount();
            
            $view->with(compact('follow_count', 'follower_count'));
        });
    }
}
