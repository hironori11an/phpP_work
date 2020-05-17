<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Http\Requests\loginKanriRequest;

class loginKanriController extends Controller
{
    public static $validator;

    /* 初期表示 */
    public function init()
    {
        return view('/kanri/loginKanri');
    }
    /* かんたんログインボタン押下時 */
    public function kntnLogin(Request $request)
    {
        //かんたんログイン（一般）
        //ユーザ「ippan」としてログイン
        if (Input::get('ippn')) {
            Auth::attempt(['name' => 'ippan', 'password' => 'ippan']);
            $request->session()->put('name', 'ippan');
            $request->session()->put('role', '0');
            
            $user = User::where('name', 'ippan')->first();
            $request->session()->put('userId', $user->id);
            return redirect('/home');
            
        //かんたんログイン（管理）
        //ユーザ「kanri」としてログイン
        } elseif (Input::get('knr')) {
            Auth::attempt(['name' => 'kanri', 'password' => 'kanri']);
            $request->session()->put('name', 'kanri');
            $request->session()->put('role', '1');

            $user = User::where('name', 'kanri')->first();
            $request->session()->put('userId', $user->id);
            return redirect()->route('homeKanri');
        }
    }

    /* 通常ログインボタン押下時 */
    public function login(loginKanriRequest $request)
    {
        if (Auth::attempt(['name' => $request->input('name'), 'password' => $request->input('password')])) {
            // 認証成功

            $users= DB ::table('users')->where('name', $request->input('name'))->get();
            
            //管理者ホームへ
            foreach ($users as $user) {
                $role=$user->role;
                $name=$user->name;
                $id=$user->id;
            }
            $request->session()->put('name', $name);
            $request->session()->put('role', $role);
            $request->session()->put('userId', $id);
            if ($role > 0) {
                return redirect()->route('homeKanri');
            }
            //一般ホームへ
            return redirect('/home');
        } else {
            // 認証失敗
            $message_auth=config('const.login.CERTIFICATION_ERROR');
            // エラーメッセージをセッションに格納し、自画面遷移
            return redirect()->back()->with('message_auth', $message_auth)->withInput();
        }
    }
}
