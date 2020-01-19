<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use App\User;

class loginKanriController extends Controller
{
    /* 初期表示 */
    public function init()
    {
        return view('/kanri/loginKanri');
    }
    /* 送信ボタン押下時 */
    public function postSignin(Request $request)
    {

        /* バリデーション */
        $rules = [
            'name' => 'between:4,8|alpha_dash_check',
            'password' => 'between:4,8|alpha_dash_check',
        ];
        $message = [
            'name.between' => config('const.validation.USERID_LIMIT_CHARACTER_NUMBER'),
            'name.alpha_dash_check' => config('const.validation.PASSWORD_AVAILABLE_CHARACTER'),
            'password.between' => config('const.validation.PASSWORD_LIMIT_CHARACTER_NUMBER'),
            'password.alpha_dash_check' => config('const.validation.PASSWORD_AVAILABLE_CHARACTER'),
        ];
        $validator = Validator::make(
            $request->all(),
            $rules,
            $message
        );

        if ($validator->fails()) {
            /* バリデーションチェック失敗時 */
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        } else {
            /* バリデーションチェック成功時 */
            /* Auth認証 */
            if (Auth::attempt(['name' => $request->input('name'), 'password' => $request->input('password')])) {
                // 認証成功

                $user=DB ::table('users')->where('name', $request->input('name'));
                return redirect()->route('homeKanri');
            } else {
                // 認証失敗
                $message_auth=config('const.login.CERTIFICATION_ERROR');
                // エラーメッセージをセッションに格納し、自画面遷移
                return redirect()->back()->with('message_auth', $message_auth);
            }
        }
    }

    /* ログイン時の入力項目をemailではなく、nameにするため追加 */
    public function username()
    {
        return $username;
    }

    // protected function attemptLogin(Request $request)
    // {
    //     $username = $request->input($this->username());
    //     $password = $request->input('password');
 
    //     if (filter_var($username, \FILTER_VALIDATE_EMAIL)) {
    //         $credentials = [$this->username() => $username, 'password' => $password];
    //     }
 
    //     return $this->guard()->attempt($credentials, $request->filled('remember'));
    // }
}
