<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Song;


class MochiutaController extends Controller
{
    public function select(Song $song)
    {
        if(! session('song_search_url')) {
            session(['song_search_url' => route('search')]);
        }
        
        if(Auth::user()->hasInMySong($song->id)) {
            return redirect(session('song_search_url'))->with('error', $song->display_name . ' は持ち歌に登録済です');
        }
        
        return view('mypage.mochiuta.add', compact('song'));
    }
    
    
    public function addSelect($song_id)
    {
        $song = Song::find($song_id);
        
        if(empty($song)) {
            return back()->with('error', '該当する曲がないため登録できませんでした');
        }
        
        if(Auth::user()->hasInMySong($song_id)) {
            return back()->with('error', $song->display_name . ' は持ち歌に登録済です');
        }
        
        Auth::user()->songs()->attach($song_id);
        
        return redirect(session('song_search_url'))->with('status', $song->display_name . ' を持ち歌に登録しました');
    }
    
    
    public function edit($song_id)
    {
        $my_song = Auth::user()->songs()->find($song_id);
        
        if(empty($my_song)) {
            abort(404);
        }
        
        if(! session('home_url')) {
            session(['home_url' => route('home')]);
        }
        
        return view('mypage.mochiuta.edit', compact('my_song'));
    }
    
    
    public function delete($song_id)
    {
        if(! Auth::user()->hasInMySong($song_id)) {
            return back()->with('error', '該当する持ち歌がないため削除できませんでした');
        }
        
        Auth::user()->songs()->detach($song_id);
        
        return redirect(session('home_url'))->with('status', '持ち歌一覧から削除しました');
    }
}
