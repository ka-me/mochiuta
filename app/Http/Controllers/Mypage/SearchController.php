<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Artist;
use App\Song;


class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        
        if($keyword == '') {
            return view('mypage.search', ['results' => [] ]);
        }
        
        $category = $request->category;
        
        switch($category) {
            case 'artist':
        	    $query = Artist::query();
        		$mysong_ids = null;
        		break;
            case 'song':
        	    $query = Song::query();
        	    $mysong_ids = Auth::user()->getMySongIds();
        		break;
            default:
        	    return view('mypage.search', ['results' => [] ]);
        }
            
        $search_words = str_replace(['　', '%', '_'], [' ', '\%', '\_'], $keyword);
        $search_words = explode(' ', $search_words);
        
        foreach($search_words as $word) {
            $query->where('name', 'like', '%' . $word . '%');
        }
        $results = $query->orderBy('name')->get();
        
        session(['song_search_url' => url()->full()]);

        return view('mypage.search', ['results' => $results, 'category' => $category, 'mysong_ids' => $mysong_ids]);
    }
    
    
    public function selectArtist(Artist $artist)
    {
        $results = $artist->songs()->orderBy('name')->get();
        $mysong_ids = Auth::user()->getMySongIds($artist->id);
        
        session(['song_search_url' => url()->full()]);

        return view('mypage.search', ['results' => $results, 'category' => 'song', 'mysong_ids' => $mysong_ids]);
    }
}
