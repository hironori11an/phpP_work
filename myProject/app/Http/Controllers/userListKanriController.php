<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

class userListKanriController extends Controller
{
    //
    public function index(Request $request)
    {
        $items = DB::table('users')->simplePaginate(5);
        // $items = User::paginate(5);
        return view('kanri.userListKanri', ['items'=>$items]);
    }
}
