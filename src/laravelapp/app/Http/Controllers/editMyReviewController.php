<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Review;
use App\Genre;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests\editMyReviewRequest;
use Illuminate\Support\Facades\Storage;

class editMyReviewController extends Controller
{
    /* 初期表示 */
    public function init(Request $request)
    {
        // バリデーションエラーかつセッション（selectedReviewId）ある場合
        if ($request->session()->get('errors') && $request->session()->exists('selectedReviewId')) {
            $selectedReviewId = $request->session()->get('selectedReviewId');
        }else{
            $selectedReviewId =$request->input('selectedReviewId');
            $request->session()->put('selectedReviewId', $selectedReviewId);
        }
        
        $all = Session::all();
        $allgenres = \App\Genre::all();
        $item = Review::find($selectedReviewId);

        // タグをカンマ区切り表示にする
        $review_tag_all ="";
        $loop_counts=0;
        foreach ($item->review_tags as $review_tag) {
            if ($loop_counts===0) {
                $review_tag_all = $review_tag->tag_name;
            } else {
                $review_tag_all .= "," . $review_tag->tag_name;
            }
            ++$loop_counts;
        }

        return view('editMyReview', compact('all', 'item', 'allgenres', 'review_tag_all'));
    }

    public function edit(editMyReviewRequest $request)
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
            // レビュータグTBLの更新(delete,insert)
            // tagに入力値がある場合、カンマでタグを分割して登録する
            $reviewWork->review_tags()->delete();
            if ($request->tag_name) {
                $tags=explode(",", $request->tag_name);
                foreach ($tags as $tagValue) {
                    //カンマ終わりの場合にブランクで設定されてるのを回避
                    if ($tagValue) {
                        $reviewWork->review_tags()->create(['tag_name'=>$tagValue]);
                    }
                }
            }

            $reviewWork->genre=$request->input('genre');
            $reviewWork->title=$request->input('title');
            $reviewWork->chysh=$request->input('chysh');
            $reviewWork->hyk=$request->input('hyk');
            $reviewWork->review_niy=$request->input('review_niy');

            $reviewWork->reread_times=$request->input('reread_times');
            $reviewWork->read_end_date_for_first=$request->input('read_end_date_for_first');
            $reviewWork->read_end_date_for_second=$request->input('read_end_date_for_second');
            $reviewWork->read_end_date_for_third=$request->input('read_end_date_for_third');
            $reviewWork->read_end_date_for_fourth=$request->input('read_end_date_for_fourth');
            $reviewWork->save();

            $request->session()->forget('selectedReviewId');
            return view(
                'common.success',
                ['success_message'=>'レビューが更新されました',
                'url'=>'/myreview/'.$request->session()->get('name')]
            );
        //削除ボタン押下時、ストレージの画像とreviewを削除する
        } elseif (Input::get('del-btn')) {
            if (!is_null($reviewWork->photo_path)) {
                Storage::delete('public/profile_images/review-' . $selectedReviewId. '.jpg');
            }
            $reviewWork->delete();
            $request->session()->forget('selectedReviewId');
            return view(
                'common.success',
                ['success_message'=>'レビューが削除されました',
                'url'=>'/myreview/'.$request->session()->get('name')]
            );
        }
    }
}
