<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Artist;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(Request $request)
    {
        $mysongs_query = Auth::user()->songs();
        
        $mysong_count = $mysongs_query->count();
        $mysong_by_artist_count = $mysongs_query->pluck('artist_id')->countBy()->toArray();
        
        $myartist_ids = array_keys($mysong_by_artist_count);
        $myartists = Artist::whereIn('id', $myartist_ids)->orderBy('name')->get();
        
        $display = $request->display ?? 'all';
        $id = $request->id;
        
        switch($display) {
            case 'all':
                break;
            case 'artist':
                $mysongs_query->where('artist_id', $id);
                break;
            default:
                $mysongs = [];
                return view('home', compact('mysongs', 'mysong_count', 'myartists', 'mysong_by_artist_count', 'display'));
        }
        
        $mysongs = $mysongs_query->orderBy('added_at', 'desc')->get();
        
        return view('home', compact('mysongs', 'mysong_count', 'myartists', 'mysong_by_artist_count', 'display', 'id'));
    }
}
