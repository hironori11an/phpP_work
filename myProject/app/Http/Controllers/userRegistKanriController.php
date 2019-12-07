<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\userRegistRequest;

use Validator;

class userRegistKanriController extends Controller
{
    /* 送信ボタン押下時 */
    public function validation(userRegistRequest $request)
    {
        /* バリデーションチェック成功時 */
        return redirect()->route('home');
    }
}
