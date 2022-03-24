<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\User;


class FollowController extends Controller
{
    public function following()
    {
        $users = Auth::user()->following()
                            ->with('songs')
                            ->orderBy('follows.created_at', 'desc')
                            ->get();
        
        $follower_ids = Auth::user()->getFollowerIds();
        
        session(['user_list_url' => url()->full()]);
        
        return view('mypage.following', compact('users', 'follower_ids'));
    }
    
    
    public function followers()
    {
        $users = Auth::user()->followers()
                            ->with('songs')
                            ->orderBy('follows.created_at', 'desc')
                            ->get();
        
        $followee_ids = Auth::user()->getFolloweeIds();
        
        session(['user_list_url' => url()->full()]);
        
        return view('mypage.followers', compact('users', 'followee_ids'));
    }
    
    
    public function follow($user_id)
    {
        $user = User::find($user_id);
        
        if(empty($user) || $user_id == Auth::id()) {
            return back()->with('error', '該当するユーザーがいないためフォローできませんでした');
        }
        
        if(Auth::user()->isFollowing($user_id)) {
            return back()->with('error', $user->name . ' さんはフォロー済です');
        }
        
        Auth::user()->following()->attach($user_id);
        
        return back()->with('status', $user->name . ' さんをフォローしました');
    }
    
    
    public function unfollow($user_id)
    {
        if(! Auth::user()->isFollowing($user_id)) {
            return back()->with('error', '該当するユーザーがいないためフォロー解除できませんでした');
        }
        
        Auth::user()->following()->detach($user_id);
        
        return back()->with('status', 'フォローを解除しました');
    }
}
