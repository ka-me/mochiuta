<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Artist;


class MochiutaController extends Controller
{
    
    public function index(Request $request) 
    {
        $artists = Artist::all();
        
        if(empty($request)) {
            $select_artist = null;
        } else {
            $select_artist = Artist::find($request->id);
        }
        
        return view('mypage.mochiuta.add', ['artists' => $artists, 'select_artist' => $select_artist]);
    }
    
    public function add(Request $request)
    {
        
        Auth::user()->songs()->attach($request->song_id);
        
        return redirect('mypage/mochiuta/add');
    }
    
}
