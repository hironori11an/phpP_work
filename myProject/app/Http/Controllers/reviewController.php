<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\Genre;
use Storage;
use App\Http\Requests\reviewRequest;

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
        /* レビュー登録 */
        $review= new Review;
        $form =$request->all();
        $review->photo_path = null;
        unset($form['_token']);
        unset($form['photo']);
        $review->fill($form)->save();
        //アップロードファイルがある場合、S3にアップロードする
        //S3のurlは、reviews.photo_pathに登録する
        if ($_FILES['photo']['size'] > 0) {
            //S3への保存は、composeメモリ不足により断念
            // $path = Storage::disk('s3')->putFileAs('myprefix', $request->photo, 'review-'.$review->id .'.jpg', 'public');
            $request->photo->storeAs('public/profile_images', 'review-'.$review->id .'.jpg');
            $reviewUpd = Review::find($review->id);
            // $reviewUpd->photo_path = Storage::disk('s3')->url($path);
            $reviewUpd->photo_path = asset('storage/profile_images/review-' . $review->id. '.jpg');
            $reviewUpd->save();
        }
        

        return view(
            'common.success',
            ['success_message'=>'レビュー投稿が完了しました',
            'url'=>'/home']
        );
    }
}
