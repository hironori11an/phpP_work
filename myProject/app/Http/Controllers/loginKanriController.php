<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;

class loginKanriController extends Controller
{
    public static $validator;

    /* 初期表示 */
    public function init()
    {
        return view('/kanri/loginKanri');
    }
    /* ログインボタン押下時 */
    public function postSignin(Request $request)
    {
        //かんたんログイン（一般）
        //ユーザ「ippan」としてログイン
        if (Input::get('ippn')) {
            Auth::attempt(['name' => 'ippan', 'password' => 'ippan']);
            $request->session()->put('name', 'ippan');
            $request->session()->put('role', '0');
            return redirect('/home');
            
        //かんたんログイン（管理）
        //ユーザ「kanri」としてログイン
        } elseif (Input::get('knr')) {
            Auth::attempt(['name' => 'kanri', 'password' => 'kanri']);
            $request->session()->put('name', 'kanri');
            $request->session()->put('role', '1');
            return redirect()->route('homeKanri');

        //通常ログイン
        } elseif (Input::get('login')) {
            if ($this->validation($request)->fails()) {
                /* バリデーションチェック失敗時 */
                return redirect()->back()
                ->withErrors(loginKanriController::$validator)
                ->withInput();
            } else {
                /* バリデーションチェック成功時 */
                /* Auth認証 */
                if (Auth::attempt(['name' => $request->input('name'), 'password' => $request->input('password')])) {
                    // 認証成功
    
                    $users= DB ::table('users')->where('name', $request->input('name'))->get();
                    
                    //管理者ホームへ
                    foreach ($users as $user) {
                        $role=$user->role;
                        $name=$user->name;
                    }
                    $request->session()->put('name', $name);
                    $request->session()->put('role', $role);
                    if ($role > 0) {
                        return redirect()->route('homeKanri');
                        // return redirect('/home');
                    }
                    //一般ホームへ
                    return redirect('/home');
                } else {
                    // 認証失敗
                    $message_auth=config('const.login.CERTIFICATION_ERROR');
                    // エラーメッセージをセッションに格納し、自画面遷移
                    return redirect()->back()->with('message_auth', $message_auth);
                }
            }
        }
    }

    //バリデーション
    public function validation(Request $request)
    {
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
        loginKanriController::$validator = Validator::make(
            $request->all(),
            $rules,
            $message
        );
        return loginKanriController::$validator;
    }

    // public function login(Request $request)
    // {
    //     if ($validator->fails()) {
    //         /* バリデーションチェック失敗時 */
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     } else {
    //         /* バリデーションチェック成功時 */
    //         /* Auth認証 */
    //         if (Auth::attempt(['name' => $request->input('name'), 'password' => $request->input('password')])) {
    //             // 認証成功
    
    //             $users= DB ::table('users')->where('name', $request->input('name'))->get();
                    
    //             //管理者ホームへ
    //             foreach ($users as $user) {
    //                 $role=$user->role;
    //                 $name=$user->name;
    //             }
    //             if ($role> 0) {
    //                 return redirect()->route('homeKanri');
    //             }
    //             //一般ホームへ
    //             $request->session()->put('name', $name);
    //             $request->session()->put('role', $role);
    //             return redirect('/home');
    //         } else {
    //             // 認証失敗
    //             $message_auth=config('const.login.CERTIFICATION_ERROR');
    //             // エラーメッセージをセッションに格納し、自画面遷移
    //             return redirect()->back()->with('message_auth', $message_auth);
    //         }
    //     }
    // }
}
