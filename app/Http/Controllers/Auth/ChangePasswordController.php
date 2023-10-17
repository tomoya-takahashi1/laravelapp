<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ChangePasswordController extends Controller


{
    public function showChangePasswordForm()
{
    return view('auth.passwords.change-password');
}

public function changePassword(Request $request)
{
    // バリデーションルールを定義
    $rules = [
        'current_password' => 'required',
        'new_password' => 'required|string|min:8|confirmed',
    ];

    // バリデーションを実行
    $request->validate($rules);

    // ユーザーの現在のパスワードが正しいかチェック
    if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->current_password])) {
        // 現在のパスワードが正しい場合、新しいパスワードを設定
        $user = Auth::user();
        $user->password = bcrypt($request->new_password);
        $user->save();

        // パスワード変更成功メッセージを表示
        return redirect()->route('home')->with('success', 'パスワードが変更されました。');
    } else {
        // 現在のパスワードが正しくない場合、エラーメッセージを表示
        return back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
    }
}

}




