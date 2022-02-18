<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        		break;
        	case 'song':
        		$query = Song::query();
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
        
        return view('mypage.search', ['results' => $results, 'category' => $category]);
    }
    
    
    public function selectArtist($id)
    {
        $select_artist = Artist::find($id);
        
        if(is_null($select_artist)) {
            return view('mypage.search', ['results' => [] ]);
        }    
            
        $results = $select_artist->songs()->orderBy('name')->get();
        $category = 'song';
        
        return view('mypage.search', ['results' => $results, 'category' => $category]);
    }
}
