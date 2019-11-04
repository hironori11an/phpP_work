<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Validator;

class homeKanriController extends Controller
{
    public function postSignin(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'password' => 'min:4'
        //     ]);
        /* バリデーション */
        $rules = [
            'name' => 'between:4,8|alpha_dash_check',
            'password' => 'between:4,8|alpha_dash_check',
        ];
        // between:4,8
        $message = [
            'name.between' => 'IDは４桁から８桁で入力してください',
            'name.alpha_dash_check' => '半角英数字・「_」・「-」の組み合せで入力してください',
            'password.between' => 'パスワードは４桁から８桁で入力してください',
            'password.alpha_dash_check' => '半角英数字・「_」・「-」の組み合せで入力してください',
        ];
        $validator = Validator::make(
            $request->all(),
            $rules,
            $message
            // 'name' => 'required',
            // 'password' => 'min:4'
        );

        if ($validator->fails()) {
            redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        /* Auth認証 */
        if (Auth::attempt(['name' => $request->input('name'), 'password' => $request->input('password')])) {
            return redirect()->route('hello');
        }
        return redirect()->back();
    }

    /* ログイン時の入力項目をemailではなく、nameにするため追加 */
    public function username()
    {
        return $username;
    }

    protected function attemptLogin(Request $request)
    {
        $username = $request->input($this->username());
        $password = $request->input('password');
 
        if (filter_var($username, \FILTER_VALIDATE_EMAIL)) {
            $credentials = [$this->username() => $username, 'password' => $password];
        }
 
        return $this->guard()->attempt($credentials, $request->filled('remember'));
    }
}
