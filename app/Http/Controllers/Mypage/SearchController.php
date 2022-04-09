<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Library\Common;
use App\Artist;
use App\Song;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = Common::keywordTrim($request->keyword);
        
        if($keyword == '') {
            return view('mypage.search', ['results' => [] ]);
        }
        
        $category = $request->category;
        
        switch($category) {
            case 'artist':
        	    $query = Artist::query();
        		$my_song_ids = null;
        		break;
            case 'song':
        	    $query = Song::query();
        	    $my_song_ids = Auth::user()->getMySongIds();
        		break;
            default:
        	    return view('mypage.search', ['results' => [] ]);
        }
            
        $results = Common::searchByName($query, $keyword)->get();
        
        session(['song_search_url' => url()->full()]);

        return view('mypage.search', compact('results', 'category', 'my_song_ids'));
    }
    
    
    public function selectArtist(Artist $artist)
    {
        $results = $artist->songs()->orderBy('name')->get();
        $category = 'song';
        $my_song_ids = Auth::user()->getMySongIds($artist->id);
        
        session(['song_search_url' => url()->full()]);

        return view('mypage.search', compact('results', 'category', 'my_song_ids'));
    }
}
