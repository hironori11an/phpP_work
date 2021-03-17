<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Review;
use App\Genre;
use Illuminate\Support\Facades\Input;

class bookspaceController extends Controller
{
    public function action(Request $request)
    {
        // タグボタン押下時
        if (Input::get('tag_button')) {
            return $this->tagSearch($request);
        // いいねしたレビューの取り消し
        } else {
            $editMyReview = app()->make('App\Http\Controllers\editMyReviewController');
            return $editMyReview->init($request);
        }
    }

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
        $reviewLikes=$user->reviews()->get();
        $all = Session::all();
        // 自分が登録したタグの一覧を取得
        $myReviewTags = DB::table('reviews')
        ->select(DB::raw('distinct review_tags.tag_name'))
        ->join('review_tags','reviews.id','=','review_tags.review_id')
        ->where('reviews.user_name', '=', $request->session()->get('name'))
        ->get();
        return view('bookspace', compact('all', 'items', 'reviewLikes','myReviewTags'));
    }

    /* タグボタン押下時 */
    public function tagSearch(Request $request)
    {
        $tagName = $request->input('tag_button');
        $items = Review::whereHas('review_tags', function ($query) use ($tagName) {
            $query->where('tag_name', '=', $tagName);
        })
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('searchResult', compact('all', 'items'));
    }
}
