<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
        // タグから検索
        if (Input::get('tag_button')) {
            $tagName = $request->input('tag_button');
            $items = Review::whereHas('review_tags', function ($query) use ($tagName) {
                $query->where('tag_name', '=', $tagName);
            })
            ->orderBy('updated_at', 'desc')
            ->get();
            
            $all = Session::all();
            return view('searchResult', compact('all', 'items'));
        }
        $genre = $request->input('genre');
        $title = $request->input('title');
        $chysh = $request->input('chysh');

        $query = Review::whereHas('genres');
        if (!is_null($genre) && $genre !=='9') {
            $query = $query->where('genre', '=', $genre);
        }
        if (!is_null($title)) {
            $query = $query->where('title', 'LIKE', "%{$title}%");
        }
        if (!is_null($chysh)) {
            $query = $query->where('chysh', 'LIKE', "%{$chysh}%");
        }
        $items = $query->orderByRaw('updated_at DESC')->get();

        $all = Session::all();
        return view('searchResult', compact('all', 'items'));
    }
    public function searchUserName(Request $request)
    {
        $user_name=$request->user_name;
        $items = Review::where('user_name', $user_name)->orderByRaw('updated_at DESC')->get();
        if ($items->isEmpty()) {
            return response()->view(
                'common.success',
                ['success_message'=>'ユーザが見つかりません',
            'url'=>'/search']
            );
        }

        $all = Session::all();
        return view('searchUserName', compact('all', 'items'));
    }

    public function searchlikedUsers(Request $request)
    {
        $reviewId=$request->reviewId;
        $items = Review::where('id', '=', $reviewId)->get();
        if ($items->isEmpty()) {
            return response()->view(
                'common.success',
                ['success_message'=>'ユーザが見つかりません',
            'url'=>'/search']
            );
        }

        $all = Session::all();
        return view('likedUsers', compact('all', 'items'));
    }
}
