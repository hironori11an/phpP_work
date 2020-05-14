<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class reviewNiyServiceController extends Controller
{
    public function tmp(Request $request)
    {
        $selectedReviewId = $request->input('selectedReviewId');
        $items = Review::find($selectedReviewId);
        // return view('common.success',['aaa']);

        return view('reviewNiyRep', compact('items'));
    }
}
