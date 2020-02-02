<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;

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
        $genre = $request->input('genre');
        $title = $request->input('title');
        $chysh = $request->input('chysh');

        $query = DB::table('reviews');
        if ($request->has('genre') && $request->input('genre') !=='9') {
            $query = $query->where('genre', '=', $genre);
        }
        

        $items = $query->get();
        $all = Session::all();
        // return view('search', compact('all', 'items'));
        return view('search', compact('all'));
    }
}
