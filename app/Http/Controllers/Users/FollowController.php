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
        $list_users = $user->getFollowListUsers();
        
        $follower_ids = Auth::user()->getFollowerIds();
        $followee_ids = Auth::user()->getFolloweeIds();
        
        return view('users.following', compact('user', 'list_users', 'follower_ids', 'followee_ids'));
    }
    
    
    public function followers(User $user)
    {
        $list_users = $user->getFollowerListUsers();
        
        $follower_ids = Auth::user()->getFollowerIds();
        $followee_ids = Auth::user()->getFolloweeIds();
        
        return view('users.followers', compact('user', 'list_users', 'follower_ids', 'followee_ids'));
    }
}
