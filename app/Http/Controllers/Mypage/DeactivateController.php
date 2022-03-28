<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;


class DeactivateController extends Controller
{
    public function deactivate()
    {
        return view('mypage.deactivate');
    }
    
    
    public function destroy(Request $request)
    {
        $user = Auth::user();
        
        Auth::logout();
        $request->session()->flush();
        $user->delete();
        
        return redirect()->route('login')->with('status', 'ご利用いただきありがとうございました');
    }
}
