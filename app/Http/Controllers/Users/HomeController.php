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
        
        $home_data = Common::getHomeData($user, $request);
        
        return view('users.home', [
            'user'     => $user,
            'tabs'     => $home_data['tabs'],
            'my_songs' => $home_data['my_songs']
        ]);
    }
}
