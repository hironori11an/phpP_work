<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\userRegistKanriRequest;

use Validator;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userRegistKanriController extends Controller
{
    /* 送信ボタン押下時 */
    public function regist(userRegistKanriRequest $request)
    {
        /* バリデーションチェック成功時 */
        
        //ユーザID・パスワードが両方とも未入力のデータを取り除く
        require_once(app_path('Utility/utl_func.php'));
        $request->merge(validationData_check($request->all()));
        if (count($request->input('name'))===0 and count($request->input('password'))===0) {
            return redirect()->route('userRegistKanri')->with('err_m', '入力されていません');
        }

        
        $max_cnt=count($request->input('name'));
        //ユーザIDの一意制約チェック
        $error_message = null;
        $nameNyryks =$request->input('name');
        foreach ($nameNyryks as $nameNyryk) {
            $nameExist= DB ::table('users')->where('name', $nameNyryk)->count();
            if ($nameExist > 0) {
                $error_message = $error_message . $nameNyryk . " は既に登録されています" ."<br>";
            }
        }
        if (!is_null($error_message)) {
            return redirect()->route('userRegistKanri')->with('err_m', $error_message)->withInput();
        }
        
        $forms =$request->all();
        for ($i=0; $i<$max_cnt; $i++) {
            $user= new User;
            $user->name = $request->input('name.'.$i);
            $user->password = Hash::make($request->input('password.'.$i));
            $user->role = $request->input('authority.'.$i);
            $user->save();
            DB::commit();
        }

        return view('common.success', ['success_message'=>'ユーザ登録処理が成功しました']);
    }
}
