<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;

class myreviewController extends Controller
{
    /* 初期表示 */
    public function init(Request $request)
    {
        $userName=$request->user_name;
        $genres = DB::table('genres')->orderBy('id');

        // 文学・評論
        $myreviewsByGenre0 = $this->reviewQuery($userName,'0');
        // ノンフィクション
        $myreviewsByGenre1 = $this->reviewQuery($userName,'1');
        // 人文・思想・宗教
        $myreviewsByGenre2 = $this->reviewQuery($userName,'2');
        // コミックス
        $myreviewsByGenre3 = $this->reviewQuery($userName,'3');
        // その他
        $myreviewsByGenre8 = $this->reviewQuery($userName,'8');

        $all = Session::all();
        return view('myreview',compact('all', 'myreviewsByGenre0','myreviewsByGenre1','myreviewsByGenre2','myreviewsByGenre3','myreviewsByGenre8'));
    }

    public function reviewQuery($userName,$genreId)
    {
        $myReviewRtn =DB::table('reviews')
                        ->where('user_name', '=', $userName)
                        ->where('genre', '=', $genreId)
                        ->get();

        return $myReviewRtn;
    }
}
