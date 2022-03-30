<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Library\Common;
use App\User;


class HomeController extends Controller
{
    public function index(Request $request, User $user)
    {
        if($user->id === Auth::id()) {
            return redirect()->route('home');
        }
        
        return view('users.home', Common::getHomeData($user, $request));
    }
}
