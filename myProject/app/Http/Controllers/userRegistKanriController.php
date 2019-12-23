<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\userRegistRequest;

use Validator;
use App\User;

class userRegistKanriController extends Controller
{
    /* 送信ボタン押下時 */
    public function regist(userRegistRequest $request)
    {
        /* バリデーションチェック成功時 */
        
        //ユーザID・パスワードが両方とも未入力のデータを取り除く
        require_once(app_path('Utility/utl_func.php'));
        $request->merge(validationData_check($request->all()));
        if (count($request->input('name'))===0 and count($request->input('password'))===0) {
            return redirect()->route('userRegistKanri')->with('err_m', '入力されていません');
        }

        $user= new User;
        $max_cnt=count($request->input('name'));
        $forms =$request->all();
        for ($i=0; $i<$max_cnt; $i++) {
            $user->name = $request->input('name.'.$i);
            $user->password = $request->input('password.'.$i);
            $user->role = $request->input('authority.'.$i);
            // $user->password = $request->password.$i;
            // $user->role = $request->authority.$i;
            $user->save();
        }

        return view('common.success', ['success_message'=>'ユーザ登録処理が成功しました']);
    }
}
