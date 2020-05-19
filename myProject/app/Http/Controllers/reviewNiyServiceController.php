<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\User;
use App\ReviewNiyReply;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class reviewNiyServiceController extends Controller
{
    public function init(Request $request)
    {
        // $selectedReviewId = $request->input('selectedReviewId');
        $selectedReviewId=$request->reviewID;
        $userId= $request->session()->get('userId');
        $reviewMain = Review::find($selectedReviewId);
        $reviewNiyReplies = DB::table('review_niy_replies')
                            ->join('users', 'review_niy_replies.user_id', '=', 'users.id')
                            ->where('review_niy_replies.review_id', '=', $selectedReviewId)
                            ->select(
                                'review_niy_replies.id as review_niy_replies_id',
                                'review_niy_replies.review_id',
                                'review_niy_replies.reply',
                                'users.id as user_id',
                                'users.name'
                            )
                            ->orderBy('review_niy_replies.updated_at', 'asc')
                            ->get();
        return view('reviewNiyRep', compact('reviewMain', 'reviewNiyReplies'));
    }

    public function post(Request $request)
    {
        if (Input::get('commentBtn')) {
            return $this->commentRegist($request);
        } elseif (Input::get('comDelBtn')) {
            return $this->commentDelete($request);
        }
    }

    //コメント登録押下時
    public function commentRegist(Request $request)
    {
        $ReviewNiyReply = new ReviewNiyReply;
        $userId =$request->session()->get('userId');
        $reviewId = $request->input('reviewId');
        $reviewNiyRepInput = $request->input('reviewNiyRep');
        if (is_null($reviewNiyRepInput)) {
            return view(
                'common.success',
                ['success_message'=>'コメントが未入力です',
                'url'=>"/search/results/reviewID/".$reviewId]
            );
        }

        $ReviewNiyReply->fill([
                            'review_id'=>$reviewId,
                            'user_id'=>$userId,
                            'reply'=>$reviewNiyRepInput
                        ])
                        ->save();

        return view(
            'common.success',
            ['success_message'=>'コメント登録しました',
            'url'=>"/search/results/reviewID/".$reviewId]
        );
    }

    public function commentDelete(Request $request)
    {
        $delComId = $request->input('delComId');
        $reviewId = $request->input('reviewId');
        $ReviewNiyReplyWork = ReviewNiyReply::find($delComId);

        $ReviewNiyReplyWork->delete();

        return view(
            'common.success',
            ['success_message'=>'コメント削除しました',
            'url'=>"/search/results/reviewID/".$reviewId]
        );
    }
}
