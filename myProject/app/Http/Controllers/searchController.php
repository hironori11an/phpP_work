<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class searchController extends Controller
{
    /* 初期表示 */
    public function init(Request $request)
    {
        $all = Session::all();
        return view('search', compact('all'));
    }

    public function search(Request $request)
    {
        $all = Session::all();
        return view('search', compact('all'));
    }
}
