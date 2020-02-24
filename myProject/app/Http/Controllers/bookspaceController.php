<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Review;
use App\Genre;

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
        $items = Review::where('user_name', $request->session()->get('name'))->get();
        $user = Auth::user();
        $reviewLikes=$user->reviews()->orderBy('id')->get();
        $all = Session::all();
        return view('bookspace', compact('all', 'items', 'reviewLikes'));
    }
}
