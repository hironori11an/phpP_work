<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Review;
use App\User;

class userReviewKanriController extends Controller
{
    public function init(Request $request)
    {
        $user_name=$request->user_name;
        $items = Review::where('user_name', $user_name)->orderByRaw('updated_at DESC')->get();
        if ($items->isEmpty()) {
            return response()->view(
                'common.success',
                ['success_message'=>'レビューがありません',
            'url'=>'/kanri/userList']
            );
        }

        // $all = Session::all();
        return view('kanri.userReviewKanri', compact('items'));
    }
}
