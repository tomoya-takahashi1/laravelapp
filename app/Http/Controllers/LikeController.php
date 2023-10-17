<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Home; 

class LikeController extends Controller
{
    public function like($homeId)
    {
        $user = auth()->user(); // 現在のログインユーザーを取得

        $home = Home::find($homeId); // いいねを押す投稿を取得

        if (!$home) {
            abort(404); // 投稿が存在しない場合、404 エラーを返す
        }

        $existingLike = Like::where('user_id', $user->id)
            ->where('home_id', $home->id)
            ->first();

        if (!$existingLike) {
            Like::create([
                'user_id' => $user->id,
                'home_id' => $home->id,
            ]);
        }

        return redirect()->back(); // 投稿詳細ページにリダイレクト
    }

    public function unlike($homeId)
    {
        $user = auth()->user(); // 現在のログインユーザーを取得

        $home = Home::find($homeId); // いいねを解除する投稿を取得

        if (!$home) {
            abort(404); // 投稿が存在しない場合、404 エラーを返す
        }

        Like::where('user_id', $user->id)
            ->where('home_id', $home->id)
            ->delete();

        return redirect()->back(); // 投稿詳細ページにリダイレクト
    }
}
