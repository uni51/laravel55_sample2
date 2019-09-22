<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * ログイン後のリダイレクト先
     */
    public function redirectTo()
    {
        return route('user.top');
    }

    /**
     * ログイン画面のviewの指定
     */
    public function showLoginForm()
    {
        return view('user.login');
    }

    /**
     * バリデーションを行う（メッセージの日本語化）
     */
    protected function validateLogin(Request $request)
    {
        $messages = [
            $this->username().'.required' => 'メールアドレスを入力して下さい。',
            'password.required' => 'パスワードを入力して下さい。',
        ];

        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ], $messages);
    }

    /**
     * ログアウト処理
     */
    public function logout(Request $request)
    {
        $partialLogin = auth('user')->guest() || auth('admin')->guest();

        $this->guard()->logout();

        // どちらか片方でログインしている時のみ、invalidate する
        if ($partialLogin) {
            $request->session()->invalidate();
        }

        return redirect()->route('user.login');
    }

    /**
     * 使用する認証を返す
     */
    protected function guard()
    {
        return auth('user');
    }
}
