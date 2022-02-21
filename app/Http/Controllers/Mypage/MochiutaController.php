<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Song;


class MochiutaController extends Controller
{
    public function selectSong(Song $song) 
    {
        if(! session()->has('song_search_url')) {
            session(['song_search_url' => url('/mypage/search')]);
        }
        
        if(Auth::user()->hasSelectSong($song->id)) {
            return redirect(session('song_search_url'))->with('add_error', $song->display_name . ' は持ち歌に登録済です');
        }
        
        return view('mypage.mochiuta.add', ['song' => $song]);
    }
    
    
    public function selectSongAdd(Request $request)
    {
        $song_id = $request->song_id;
        $song = Song::find($song_id);
        
        if(empty($song)) {
            return redirect(session('song_search_url'))->with('add_error', '該当する曲がないため登録できませんでした');
        }
        
        if(Auth::user()->hasSelectSong($song_id)) {
            return redirect(session('song_search_url'))->with('add_error', $song->display_name . ' は持ち歌に登録済です');
        }
        
        Auth::user()->songs()->attach($song_id);
        
        return redirect(session('song_search_url'))->with('add_success', $song->display_name . ' を持ち歌に登録しました');
    }
}
