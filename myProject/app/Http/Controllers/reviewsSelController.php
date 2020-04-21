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
        DB::table('review_userLikes')-> join('users', 'review_userLikes.user_id', '=', 'users.id') -> get():
    }
}
