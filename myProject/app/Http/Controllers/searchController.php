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
        if (!is_null($genre) && $genre !=='9') {
            $query = $query->where('genre', '=', $genre);
        }
        if (!is_null($title)) {
            $query = $query->where('title', 'LIKE', "%{$title}%");
        }
        if (!is_null($chysh)) {
            $query = $query->where('chysh', 'LIKE', "%{$chysh}%");
        }
        

        $items = $query->get();
        $all = Session::all();
        return view('searchResult', compact('all', 'items'));
        // return view('search', compact('all'));
    }
}
