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

        //ジャンル別の件数取得
        $myReviesByGenreSQL = DB::table('reviews as a')
        ->select(DB::raw('b.genre_name,count(b.genre_name) as cnt'))
        ->join('genres as b','a.genre','=','b.id')
        ->where('a.user_name', '=', ':user_name')
        ->groupBy('b.genre_name')
        ->toSql();
        // 　myReviewByGenreSQLをサブクエリとしてジャンル数が多い順で並び替え
        $myReviewsByGenre =DB::table(DB::raw('('.$myReviesByGenreSQL.') AS bygenre'))
        ->setBindings([':user_name'=>$request->session()->get('name')])
        ->orderBy('bygenre.cnt', 'desc')
        ->get();
        $genreGraphKeys = array();
        $genreGraphCounts = array();
        foreach ($myReviewsByGenre as $myReviewByGenre) {
            array_push($genreGraphKeys,$myReviewByGenre->genre_name);
            array_push($genreGraphCounts,$myReviewByGenre->cnt);
        }

        // 著者別の件数を取得
        $myReviesByChyshSQL = DB::table('reviews')
        ->select(DB::raw('chysh,count(chysh) as cnt'))
        ->where('user_name', '=', ':user_name')
        ->groupBy('chysh')
        ->toSql();
        // 　myReviesByChyshSQLをサブクエリとして著者数が多い順で並び替え
        $myReviesByChysh =DB::table(DB::raw('('.$myReviesByChyshSQL.') AS bychysh'))
        ->setBindings([':user_name'=>$request->session()->get('name')])
        ->orderBy('bychysh.cnt', 'desc')
        ->get();
        $chyshGraphKeys = array();
        $chyshGraphCounts = array();
        $chyshCnt = 0;
        $chyshOthersCnt = 0;
        $myReviesByChyshCnt = $myReviesByChysh->count();
        foreach ($myReviesByChysh as $myRevieByChysh) {
            $chyshCnt ++;
            if ($chyshCnt < 9){
                array_push($chyshGraphKeys,$myRevieByChysh->chysh);
                array_push($chyshGraphCounts,$myRevieByChysh->cnt);
            }else{
                // 著者数上位?位以降は、「その他」としてまとめる
                $chyshOthersCnt = $chyshOthersCnt + $myRevieByChysh->cnt;
                // DBコレクション最後のときに、viewに渡す配列に格納
                if($chyshCnt === $myReviesByChyshCnt){
                    array_push($chyshGraphKeys,'その他');
                    array_push($chyshGraphCounts,$chyshOthersCnt);
                }
            }

        }


        return view('bookspace', compact('all', 'items', 'reviewLikes','myReviewTags','genreGraphKeys','genreGraphCounts','chyshGraphKeys','chyshGraphCounts'));
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
