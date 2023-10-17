<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home; // Homeモデルをインポート
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
  public function index()
  {
    // Homeモデルからデータを取得
    //$homes = Home::all(); // すべてのデータを取得する例
    $homes = Home::with('likes')->get();
    // ビューにデータを渡す
    return view('homes.index', compact('homes'));
  }

  public function create()
  {
    // 新規作成のフォームを表示する処理を追加
    return view('homes.create');
  }

  public function store(Request $request)
  {
    // バリデーションルールを定義
    $rules = [
      'title' => 'required|string|max:255',
      'body' => 'required|integer|min:1',
    ];

    // カスタムエラーメッセージを定義
    $customMessages = [
        'title.required' => '種目を入力して下さい。',
        'body.required' => '回数を入力して下さい。',
        'body.integer' => '回数は整数で入力して下さい。',
        'body.min' => '回数は1以上で入力して下さい。',
    ];

    // バリデーションを実行
    $request->validate($rules, $customMessages);

    // ユーザーに関連付けて投稿を保存
    $user = Auth::user(); // 現在のログインユーザーを取得
    $user->homes()->create([
     'title' => $request->input('title'),
     'body' => $request->input('body'),
    ]);
     $request->session()->flash('success', '投稿が完了しました');
    // リダイレクトなどの処理を追加
    return redirect()->route('homes.index');
  }

  public function show($id)
  {
    // 家の詳細情報を取得（$id を使用してデータベースから取得する例）
    //$home = Home::find($id);
    $home = Home::with('user')->find($id);


    // 詳細情報をビューに渡して表示
    return view('homes.show', compact('home'));
  }

  public function destroy($id)
  {
      // $id を使用して削除操作を実行
      // 例: Home モデルからデータを削除
      $home = Home::find($id);
      if ($home) {
          $home->delete();
      }
     
    // 削除後のリダイレクトなどの処理を追加
    return redirect()->route('homes.index')->with('success', '投稿を削除しました');
   
  }

  public function edit($id)
  {
      // $id を使用して編集対象のデータを取得
      // 例: Home モデルからデータを取得
      $home = Home::find($id);
      if (!$home) {
        // データが存在しない場合の処理を追加（例: リダイレクトなど）
        return redirect()->route('homes.index')->with('success', '投稿を削除しました');
      }
      
    // 編集画面を表示
    return view('homes.edit', compact('home'));
  }

  public function update(Request $request, $id)
  {
    // フォームから送信されたデータを処理し、データベースを更新する処理を追加
    // $id パラメータは、更新対象のホームデータのIDです
    // バリデーションルールを定義
    $rules = [
      'title' => 'required|string|max:255',
      'body' => 'required|integer|min:1',
    ];

    // カスタムエラーメッセージを定義
    $customMessages = [
      'title.required' => '種目を入力して下さい。',
      'body.required' => '回数を入力して下さい。',
      'body.integer' => '回数は整数で入力して下さい。',
      'body.min' => '回数は1以上で入力して下さい。',
    ];

    // バリデーションを実行
    $request->validate($rules, $customMessages);
      // 例：ホームデータの更新
      $home = Home::find($id);
      $home->title = $request->input('title');
      $home->body = $request->input('body');
      $home->save();

      $request->session()->flash('success', '投稿を編集しました');
      return redirect()->route('homes.index');
  }

  public function search(Request $request)
  {
    $keyword = $request->input('keyword');
      // モデルに対して検索クエリを実行
      $homes = Home::where('title', 'LIKE', "%$keyword%")
                    ->orWhere('body', 'LIKE', "%$keyword%")
                    ->get(); 
                    if ($homes->isEmpty()) {
                        $homes = null; // または $homes = collect();
                    }
      return view('homes.index', compact('homes'));
    }
    
    public function searchProducts(Request $request)
    {
      $rakutenConfig = config('services.rakuten'); // Rakutenの設定を取得
      $keyword = $request->input('keyword'); // フォームからキーワードを取得

      // Rakuten APIを呼び出して商品を検索
      $response = Http::get($rakutenConfig['base_url'], [
        'applicationId' => $rakutenConfig['api_key'],
        'keyword' => $keyword, // フォームからのキーワードを使用
      ]);

      $data = $response->json(); // レスポンスデータをJSON形式に変換

      // 例: 検索結果をビューに渡して表示
      return view('products.index', compact('data'));
    }

}
