<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Library\Common;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('home', Common::getHomeData(Auth::user(), $request));
    }
}
