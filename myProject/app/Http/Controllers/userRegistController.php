<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\userRegistRequest;
use Validator;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userRegistController extends Controller
{
    /* 送信ボタン押下時 */
    public function regist(userRegistRequest $request)
    {
        /* バリデーションチェック成功時 */
            
        //ユーザIDの一意制約チェック
        $error_message = null;
        $nameNyryk =$request->input('name');

        $nameExist= DB ::table('users')->where('name', $nameNyryk)->count();
        if ($nameExist > 0) {
            $error_message = $error_message . $nameNyryk . " は既に登録されています" ."<br>";
        }
        
        if (!is_null($error_message)) {
            return redirect()->route('userRegist')->with('err_m', $error_message)->withInput();
        }
            
        $forms =$request->all();
        
        $user= new User;
        $user->name = $request->input('name');
        $user->password = Hash::make($request->input('password'));
        $user->role = '0';//一般ユーザ:0
        $user->save();
        DB::commit();
    
        return view('common.success', ['success_message'=>'ユーザ登録処理が成功しました']);
    }
}
