<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\User;


class FollowController extends Controller
{
    public function following(User $user)
    {
        if($user->id === Auth::id()) {
            return redirect()->route('following');
        }
        
        $list_users = $user->getFollowListUsers();
        
        $follower_ids = Auth::user()->getFollowerIds();
        $following_ids = Auth::user()->getFollowingIds();
        
        return view('users.following', compact('user', 'list_users', 'follower_ids', 'following_ids'));
    }
    
    
    public function followers(User $user)
    {
        if($user->id === Auth::id()) {
            return redirect()->route('followers');
        }
        
        $list_users = $user->getFollowerListUsers();
        
        $follower_ids = Auth::user()->getFollowerIds();
        $following_ids = Auth::user()->getFollowingIds();
        
        return view('users.followers', compact('user', 'list_users', 'follower_ids', 'following_ids'));
    }
}
