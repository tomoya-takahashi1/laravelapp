<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
   
    protected $redirectTo = '/homes/index';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

  public function guestLogin()
  {
    if (Auth::check()) {
      Auth::logout();
    }
    
    $guestEmail = 'guest@example.com'; // ゲストユーザーのメールアドレス

    // ゲストユーザーの存在を確認
    $guestUser = User::where('email', $guestEmail)->first();

    if (!$guestUser) {
      // ゲストユーザーが存在しない場合、新しいゲストユーザーを作成
      $user = User::create([
        'name' => 'ゲスト',
        'email' => $guestEmail,
        'password' => bcrypt('guest_password'),
        'is_guest' => true,
        ]);
    } else {
        // ゲストユーザーが存在する場合、そのユーザーでログイン
        Auth::login($guestUser);
    }
    session()->flash('success', 'ゲストユーザーとしてログインしました');
    return redirect()->route('homes.index');
  }

  public function logout(Request $request)
  { 
    Auth::logout();
    session()->flash('success', 'ログアウトしました。');
    return redirect('/login');
  }

  public function login(Request $request)
  {
    // ログインのバリデーションルールを定義するなどのログイン処理を行います
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // ログイン成功時にフラッシュメッセージをセッションに保存
        session()->flash('success', 'ログインしました');
        return redirect()->route('homes.index'); // ログイン後のリダイレクト先に適宜変更
    }
  }

}
