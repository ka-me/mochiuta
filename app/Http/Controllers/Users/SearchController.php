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
            $song_ids = Auth::user()->getMySongIds();
            $users = User::whereHas('songs', function($q) use($song_ids) {
                                $q->whereIn('songs.id', $song_ids);
                            })
                            ->where('id', '<>', Auth::id())
                            ->with('songs')
                            ->inRandomOrder()
                            ->limit(3)
                            ->get();
        } else {
            $users = Common::searchByName(User::query(), $keyword)
                            ->with('songs')
                            ->get();
        }
        
        session(['user_list_url' => url()->full()]);
        
        return view('users.search', compact('users', 'keyword'));
    }
}
