<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reviewLikesController extends Controller
{
    public function like(Request $request)
    {
        $review_id=$request->review_id;
        
        $user = Auth::user();
        $review_userLikes=$user->reviews()->attach($review_id);
        return response()->json(
            \Illuminate\Http\Response::HTTP_OK
        );
    }

    public function delLike(Request $request)
    {
        $review_id=$request->review_id;
        
        $user = Auth::user();
        $review_userLikes=$user->reviews()->detach($review_id);
        return response()->json(
            \Illuminate\Http\Response::HTTP_OK
        );
    }
}
