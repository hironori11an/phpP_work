<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\Genre;
use App\Http\Requests\reviewRequest;

// use Illuminate\Support\Facades\Storage;

class reviewController extends Controller
{
    /* 初期表示 */
    public function init(Request $request)
    {
        $genres = \App\Genre::all();
        $all = Session::all();
        return view('review', compact('all', 'genres'));
    }

    public function regist(reviewRequest $request)
    {
        $review= new Review;
        $form =$request->all();
        unset($form['_token']);
        unset($form['photo']);
        //アップロードファイル画像がある場合、photo_flg='X'にして、
        ///var/www/storage/app/public/profile_images にアップロード
        if ($_FILES['photo']['size'] > 0) {
            $review->photo_flg='X';
        } else {
            $review->photo_flg='O';
        }
        $review->fill($form)->save();
        if ($review->photo_flg=== 'X') {
            $request->photo->storeAs('public/profile_images', 'review-'.$review->id .'.jpg');
        }

        return view(
            'common.success',
            ['success_message'=>'レビュー投稿が完了しました',
            'url'=>'/home']
        );
    }
}
