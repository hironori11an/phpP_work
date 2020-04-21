<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\User;
use Illuminate\Support\Facades\Auth;

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

        // $query = DB::table('reviews');
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
        // $userLikes = $items->users()->where('user_id', '=', $request->user_name)->get();

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

    // public function like(Request $request)
    // {
    //     $review_id=$request->review_id;
        
    //     $user = Auth::user();
    //     $review_userLikes=$user->reviews()->attach($review_id);
    //     return response()->json(
    //         \Illuminate\Http\Response::HTTP_OK
    //     );
    // }

    // public function delLike(Request $request)
    // {
    //     $review_id=$request->review_id;
        
    //     $user = Auth::user();
    //     $review_userLikes=$user->reviews()->detach($review_id);
    //     return response()->json(
    //         \Illuminate\Http\Response::HTTP_OK
    //     );
    // }
}
