<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Library\Common;
use App\User;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = Common::keywordTrim($request->keyword);
        
        if($keyword == '') {
            $my_song_ids = Auth::user()->getMySongIds();
            $list_users = User::whereHas('songs', function($q) use($my_song_ids) {
                                    $q->whereIn('songs.id', $my_song_ids);
                                })
                                ->where('id', '<>', Auth::id())
                                ->with('songs')
                                ->inRandomOrder()
                                ->limit(4)
                                ->get();
        } else {
            $list_users = Common::searchByName(User::query(), $keyword)
                                ->with('songs')
                                ->get();
        }
        
        $follower_ids = Auth::user()->getFollowerIds();
        $following_ids = Auth::user()->getFollowingIds();
        
        session(['user_list_url' => url()->full()]);
        
        return view('users.search', compact('list_users', 'keyword', 'follower_ids', 'following_ids'));
    }
}
