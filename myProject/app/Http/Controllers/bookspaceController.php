<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;

class bookspaceController extends Controller
{
    /* 初期表示 */
    public function init(Request $request)
    {
        $request->session()->flush();
        
        return view('bookspace');
        // $items = Review::where('user_name', $request->session()->get('name'))->get();
        // $all = Session::all();
        // return view('bookspace', compact('all', 'items'));
    }

    /* ログイン */
    public function login(Request $request)
    {
        // $request->session()->put('name', $name);
        $items = Review::where('user_name', $request->session()->get('name'))->get();
        $all = Session::all();
        // return view('bookspace', compact('all'));
        return view('bookspace', compact('all', 'items'));
    }
}
