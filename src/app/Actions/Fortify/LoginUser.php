<?php

namespace App\Actions\Fortify;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginUser
{
    public function login(LoginRequest $request)
    {
        // LoginRequest のバリデーション実行
        $request->validated(); // rules と messages がここで適用される

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin'); // ログイン成功後
        }

        // 失敗したら両方に個別メッセージ
        return back()->withErrors([
            'email'    => 'メールアドレスが正しくありません',
            'password' => 'パスワードが正しくありません',
        ])->withInput($request->only('email'));
    }
}
