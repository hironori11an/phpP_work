<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\Genre;
use Illuminate\Http\Request;

class editMyReviewController extends Controller
{
    /* 送信ボタン押下時 */
    public function init(Request $request)
    {
        $selectedReviewId =$request->input('selectedReviewId');
        $all = Session::all();
        $item = Review::find($selectedReviewId);
        return view('editMyReview', compact('all', 'item'));
    }
}
