<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Library\Common;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $home_data = Common::getHomeData(Auth::user(), $request);
        
        session(['home_url' => url()->full()]);
        
        return view('home', [
            'tabs'     => $home_data['tabs'],
            'my_songs' => $home_data['my_songs']
        ]);
    }
}
