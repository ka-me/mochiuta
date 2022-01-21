<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Artist;


class MochiutaController extends Controller
{
    
    public function add(Request $request) 
    {
        $artists = Artist::all();
        
        if(empty($request)) {
            $select_artist = null;
        } else {
            $select_artist = Artist::find($request->id);
        }
        
        return view('mypage.mochiuta.add', ['artists' => $artists, 'select_artist' => $select_artist]);
    }
    
    public function mochiutaAdd(Request $request)
    {
        return redirect('mypage/mochiuta/add');
    }
    
}
