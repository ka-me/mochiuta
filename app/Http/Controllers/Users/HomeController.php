<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Library\Common;
use App\User;


class HomeController extends Controller
{
    public function index(Request $request, User $user)
    {
        if(! session()->has('user_list_url')) {
            session(['user_list_url' => url('/users/search')]);
        }

        return view('users.home', Common::getHomeData($user, $request));
    }
}