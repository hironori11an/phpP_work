<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;

class reviewController extends Controller
{
    /* 初期表示 */
    public function init(Request $request)
    {
        $all = Session::all();
        return view('review', compact('all'));
    }

    public function regist(Request $request)
    {
        $this->validate($request, Review::$rules);
        $review= new Review;
        $form =$request->all();
        unset($form['_token']);
        $review->fill($form)->save();

        return view('common.success', ['success_message'=>'レビュー投稿が完了しました']);
    }
}
