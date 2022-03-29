<?php

namespace App\Http\Controllers\Mypage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class EditController extends Controller
{
    public function edit()
    {
        return view('mypage.edit', ['user' => Auth::user()]);
    }
    
    
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:160'],
        ]);
        
        $profile = $request->only('name', 'message');
        
        Auth::user()->fill($profile)->save();
        
        return redirect()->route('edit')->with('status', 'プロフィールを更新しました');
    }
    
    
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
        ]);
        
        $email = $request->only('email');
        
        Auth::user()->fill($email)->save();
        
        return redirect()->route('edit')->with('status', 'メールアドレスを更新しました');
    }
    
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        
        $password = Hash::make($request->password);
        
        Auth::user()->fill(['password' => $password])->save();
        
        return redirect()->route('edit')->with('status', 'パスワードを更新しました');
    }
}
