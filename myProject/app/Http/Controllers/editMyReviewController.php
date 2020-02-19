<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\Genre;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class editMyReviewController extends Controller
{
    /* 初期表示 */
    public function init(Request $request)
    {
        $selectedReviewId =$request->input('selectedReviewId');
        $request->session()->put('selectedReviewId', $selectedReviewId);
        $all = Session::all();
        $allgenres = \App\Genre::all();
        $item = Review::find($selectedReviewId);
        return view('editMyReview', compact('all', 'item', 'allgenres'));
    }

    public function edit(Request $request)
    {
        $selectedReviewId = $request->session()->pull('selectedReviewId');
        $reviewWork = Review::find($selectedReviewId);

        //更新ボタン押下時
        if (Input::get('upd-btn')) {
            //画像変更ありの場合、ストレージの画像とreviewの画像パスを更新する
            if ($_FILES['photo']['size'] > 0) {
                if (!is_null($reviewWork->photo_path)) {
                    Storage::delete('public/profile_images/review-' . $selectedReviewId. '.jpg');
                }
                Storage::putFileAs(
                    'public/profile_images',
                    $request->photo,
                    'review-'.$selectedReviewId .'.jpg'
                );
                //画像なしから画像ありへの変更では、ここではじめてDBにphoto_pathが登録される
                $reviewWork->photo_path=asset('storage/profile_images/review-' . $selectedReviewId. '.jpg');
            }

            $reviewWork->genre=$request->input('genre');
            $reviewWork->title=$request->input('title');
            $reviewWork->chysh=$request->input('chysh');
            $reviewWork->hyk=$request->input('hyk');
            $reviewWork->review_niy=$request->input('review_niy');
            $reviewWork->save();

            return view(
                'common.success',
                ['success_message'=>'レビューが更新されました',
                'url'=>'/home']
            );
        //削除ボタン押下時、ストレージの画像とreviewを削除する
        } elseif (Input::get('del-btn')) {
            if (!is_null($reviewWork->photo_path)) {
                Storage::delete('public/profile_images/review-' . $selectedReviewId. '.jpg');
            }
            Review::find($selectedReviewId)->delete();
            return view(
                'common.success',
                ['success_message'=>'レビューが削除されました',
                'url'=>'/home']
            );
        }
    }
}
