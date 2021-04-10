<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\User;

class reviewsSelController extends Controller
{
    public function showCreateForm()
    {
        DB::table('review_user_likes')-> join('users', 'review_user_likes.user_id', '=', 'users.id') -> get():
    }
}
