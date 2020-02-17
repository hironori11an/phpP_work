<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\Genre;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class editMyReviewController extends Controller
{
    /* 初期表示 */
    public function init(Request $request)
    {
        $selectedReviewId =$request->input('selectedReviewId');
        $all = Session::all();
        $allgenres = \App\Genre::all();
        $item = Review::find($selectedReviewId);
        return view('editMyReview', compact('all', 'item', 'allgenres'));
    }

    public function edit(Request $request)
    {
        if (Input::get('upd-btn')) {
            return view(
                'common.success',
                ['success_message'=>'更新']
            );
        } elseif (Input::get('del-btn')) {
            return view(
                'common.success',
                ['success_message'=>'削除']
            );
        }
    }
}
