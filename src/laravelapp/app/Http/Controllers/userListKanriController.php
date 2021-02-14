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
        $items = DB::table('users')
        ->orderBy('role', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        return view('kanri.userListKanri', ['items'=>$items]);
    }
}
