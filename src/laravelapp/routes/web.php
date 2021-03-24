<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* ホーム（ログイン前）*/
Route::get('/', [
    'uses' => 'bookspaceController@init',
]);

/* 一般ユーザ 探す*/
Route::get('/search', [
    'uses' => 'searchController@init',
]);
Route::post('/search/results', [
    'uses' => 'searchController@search',
]);


/* 一般ユーザログイン後　レビューする*/
Route::post('/review/success', [
    'uses' => 'reviewController@regist',
]);
//ユーザ登録画面（一般）
Route::get('/userRegist', function () {
    return view('userRegist');
})->name('userRegist');
Route::post('/userRegist/success', [
    'uses' => 'userRegistController@regist',
]);

//一般 マイレビューの編集
Route::post('/home/editMyReview', [
    'uses' => 'bookspaceController@action',
]);
Route::post('/home/editMyReview/success', [
    'uses' => 'editMyReviewController@edit',
]);

//レビュー検索結果
Route::get('/search/results/{user_name?}', [
    'uses' => 'searchController@searchUserName',
]);
// レビューIDパラメータ
Route::get('/search/results/userLiked/{reviewId?}', [
    'uses' => 'searchController@searchlikedUsers',
])->name('searchlikedUsers');
// タグネームパラメータ
Route::get('/search/results/tag/{tagName?}', [
    'uses' => 'searchController@searchTagName',
])->name('searchTagName');
// 著者パラメータ
Route::get('/search/results/chysh/{chysh?}', [
    'uses' => 'searchController@searchChysh',
])->name('searchChysh');
// タイトルパラメータ
Route::get('/search/results/title/{title?}', [
    'uses' => 'searchController@searchTitle',
])->name('searchTitle');

//ajax いいね登録用
Route::post('/like', [
    'uses' => 'reviewLikesController@like']);

//ajax いいね取消用
Route::post('/delLike', [
    'uses' => 'reviewLikesController@delLike']);

//検索画面からレビュー内容をクリック時
Route::get('/search/results/reviewID/{reviewID?}', [
    'uses' => 'reviewNiyServiceController@init',
])->name('reviewResult.init');

Route::post('/search/results/comment', [
    'uses' => 'reviewNiyServiceController@post',
]);

//処理成功画面（共通）
Route::get('/success', function () {
    return view('common.success');
});


/* ログイン画面 */
Route::get('/loginbs', 'loginKanriController@init');
//かんたんログイン
Route::post('/login/home/guest', [
    'uses' => 'loginKanriController@kntnLogin',
    'as' => 'homeKanri.kntnLogin'
    ]);
//一般ログイン
Route::post('/login/home', [
'uses' => 'loginKanriController@login',
'as' => 'homeKanri.login'
]);

/*一般ログイン後画面 直URL禁止*/
Route::group(['middleware' => ['can:user']], function () {
    Route::get('/review', [
        'uses' => 'reviewController@init',
    ]);

    /* 一般ユーザログイン後　ホーム*/
    Route::get('/home', [
    'uses' => 'bookspaceController@login',
    ]);
});



/* 管理画面 */

Route::post('/kanri/userRegist/success', [
    'uses' => 'userRegistKanriController@regist',
    'as' => 'userRegistKanri.regist'
    ]);
    
Auth::routes();

/*管理者ログイン画面 直URL禁止*/
Route::group(['middleware' => ['can:admin']], function () {
    Route::get('/kanri', function () {
        return view('kanri.homeKanri');
    })->name('homeKanri');

    Route::get('/kanri/userRegist', function () {
        return view('kanri.userRegistKanri');
    })->name('userRegistKanri');

    Route::get(
        '/kanri/userList',
        'userListKanriController@index'
    );

    Route::get(
        '/kanri/reviews/{user_name?}',
        'userReviewKanriController@init'
    );
});

// test用
// Route::get('/test',     'testController@index');
Route::get('/test', function () {
    return view('test');
});
