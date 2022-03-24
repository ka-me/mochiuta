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
        if(! session()->has('song_search_url')) {
            session(['song_search_url' => url('/mypage/search')]);
        }
        
        if(Auth::user()->hasSelectSong($song->id)) {
            return redirect(session('song_search_url'))->with('error', $song->display_name . ' は持ち歌に登録済です');
        }
        
        return view('mypage.mochiuta.add', ['song' => $song]);
    }
    
    
    public function addSelect(Request $request)
    {
        $song_id = $request->song_id;
        $song = Song::find($song_id);
        
        if(empty($song)) {
            return redirect(session('song_search_url'))->with('error', '該当する曲がないため登録できませんでした');
        }
        
        if(Auth::user()->hasSelectSong($song_id)) {
            return redirect(session('song_search_url'))->with('error', $song->display_name . ' は持ち歌に登録済です');
        }
        
        Auth::user()->songs()->attach($song_id);
        
        return redirect(session('song_search_url'))->with('status', $song->display_name . ' を持ち歌に登録しました');
    }
}
