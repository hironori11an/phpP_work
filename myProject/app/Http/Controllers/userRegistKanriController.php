<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\userRegistRequest;

use Validator;
use App\User;

class userRegistKanriController extends Controller
{
    /* 送信ボタン押下時 */
    public function validation(userRegistRequest $request)
    {
        /* バリデーションチェック成功時 */
        // $items = User::all();
        // return redirect()->route('hello', ['items'=>$items]);
    }

    public function index(Request $request)
    {
        $items = User::all();
        return view('user.test', ['items'=>$items]);
    }
}
