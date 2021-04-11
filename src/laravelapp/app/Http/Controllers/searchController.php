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
        $reviewTags = DB::table('review_tags')
                    ->select(DB::raw('tag_name,count(tag_name) as tag_cnt'))
                    ->groupBy('tag_name')
                    ->orderByRaw('tag_cnt DESC')
                    ->orderByRaw('tag_name')
                    ->get();
        return view('search', compact('all', 'reviewTags'));
    }

    public function search(Request $request)
    {
        // レビュー内容行押下時
        if (Input::get('reviewNiyClick')) {
            $selectedReviewId = $request->input('selectedReviewId');
            return redirect()->route('reviewResult.init', ['reviewID'=>$selectedReviewId]);
        
        //検索画面（ジャンル、著者、タイトル）から
        } elseif (Input::get('searchBtn')) {
            $genre = $request->input('genre');
            $title = $request->input('title');
            $chysh = $request->input('chysh');
            $onlyMine = $request->input('onlyMine');

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
            if (!is_null($onlyMine)) {
                $query = $query->where('user_name', '=', $request->user_name);
            }
            $items = $query->orderByRaw('updated_at DESC')->get();

            $all = Session::all();
            return view('searchResult', compact('all', 'items'));

        //検索画面（タグ）から
        } elseif (Input::get('tagSearchBtn')) {
            $tagNyryk = $request->input('tagNyryk');
            $items = Review::whereHas('review_tags', function ($query) use ($tagNyryk) {
                $query->where('tag_name', 'LIKE', "%{$tagNyryk}%");
            })
            ->orderBy('updated_at', 'desc')
            ->get();
            $all = Session::all();
            return view('searchResult', compact('all', 'items'));
        }
    }

    //ユーザ名ののリンク押下時（検索結果画面から）
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
        return view('searchResult', compact('all', 'items', 'user_name'));
    }

    //いいねしたユーザボタン押下時（検索結果画面から）
    public function searchlikedUsers(Request $request)
    {
        $reviewId=$request->reviewId;
        $items = Review::where('id', '=', $reviewId)->get();
        if ($items->isEmpty()) {
            return response()->view(
                'common.success',
                ['success_message'=>'レビューが見つかりません',
            'url'=>'/search']
            );
        }

        $all = Session::all();
        return view('likedUsers', compact('all', 'items'));
    }

    // タグリンク押下時
    public function searchTagName(Request $request)
    {
        $tagName=$request->tagName;
        $items = Review::whereHas('review_tags', function ($query) use ($tagName) {
            $query->where('tag_name', '=', $tagName);
        })
        ->orderBy('updated_at', 'desc')
        ->get();
        
        $all = Session::all();
        return view('searchResult', compact('all', 'items'));
    }

    // 著者リンク押下時
    public function searchChysh(Request $request)
    {
        $chysh=$request->chysh;
        $items = Review::where('chysh', $chysh)
        ->orderBy('updated_at', 'desc')
        ->get();
        
        $all = Session::all();
        return view('searchResult', compact('all', 'items'));
    }

    // タイトルリンク押下時
    public function searchTitle(Request $request)
    {
        $title=$request->title;
        $items = Review::where('title', $title)
        ->orderBy('updated_at', 'desc')
        ->get();
        
        $all = Session::all();
        return view('searchResult', compact('all', 'items'));
    }
}
