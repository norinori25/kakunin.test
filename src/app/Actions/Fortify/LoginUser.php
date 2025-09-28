<?php

namespace App\Actions\Fortify;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginUser
{
    public function login(LoginRequest $request)
    {
        $request->validated();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin'); 
        }

        return back()->withErrors([
            'email'    => 'メールアドレスが正しくありません',
            'password' => 'パスワードが正しくありません',
        ])->withInput($request->only('email'));
    }
}
