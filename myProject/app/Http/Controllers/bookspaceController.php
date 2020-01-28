<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class bookspaceController extends Controller
{
    /* 初期表示 */
    public function init(Request $request)
    {
        $request->session()->flush();
        return view('bookspace');
    }

    /* ログイン */
    public function login(Request $request)
    {
        $all = Session::all();
        return view('bookspace', compact('all'));
    }
}
