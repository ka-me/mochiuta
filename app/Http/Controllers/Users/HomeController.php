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
        $about = $this->getUserAbout($user);
        
        return view('users.home', [
            'user'     => $user,
            'about'    => $about,
            'tabs'     => $home_data['tabs'],
            'my_songs' => $home_data['my_songs']
        ]);
    }
    
    
    public function getUserAbout($user)
    {
        $follow_count = $user->getFollowCount();
        $follower_count = $user->getFollowerCount();
        
        $is_followed = Auth::user()->isFollowed($user->id);
        $is_following = Auth::user()->isFollowing($user->id);
        
        return compact('follow_count', 'follower_count', 'is_followed', 'is_following');
    }
}
