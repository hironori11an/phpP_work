<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class userRegistKanriController extends Controller
{
    /* 送信ボタン押下時 */
    public function validation(Request $request)
    {
  
          /* バリデーション */
        $rules = [
              'name' => 'between:4,8|alpha_dash_check',
              'password' => 'between:4,8|alpha_dash_check',
          ];
        $message = [
              'name.between' => config('const.Validation.USERID_LIMIT_CHARACTER_NUMBER'),
              'name.alpha_dash_check' => config('const.Validation.PASSWORD_AVAILABLE_CHARACTER'),
              'password.between' => config('const.Validation.PASSWORD_LIMIT_CHARACTER_NUMBER'),
              'password.alpha_dash_check' => config('const.Validation.PASSWORD_AVAILABLE_CHARACTER'),
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
            return redirect()->route('hello');
        }
    }
}
