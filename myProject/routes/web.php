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

/* 一般ユーザログイン前後 探す*/
Route::get('/search', [
    'uses' => 'searchController@init',
]);
Route::post('/search/results', [
    'uses' => 'searchController@search',
]);


/* 一般ユーザログイン後　レビューする*/
Route::get('/review', [
    'uses' => 'reviewController@init',
]);
Route::post('/review/success', [
    'uses' => 'reviewController@regist',
]);
Route::get('/userRegist', function () {
    return view('userRegist');
})->name('userRegist');
Route::post('/userRegist/success', [
    'uses' => 'userRegistController@regist',
]);

Route::post('/home/editMyReview', [
    'uses' => 'editMyReviewController@init',
]);
Route::post('/home/editMyReview/success', [
    'uses' => 'editMyReviewController@edit',
]);
//レビュー検索結果
Route::get('/search/results/{user_name?}', [
    'uses' => 'searchController@searchUserName',
]);
//ajax いいね登録用
Route::post('/like', [
    'uses' => 'reviewLikesController@like']);

//ajax いいね取消用
Route::post('/delLike', [
    'uses' => 'reviewLikesController@delLike']);

// テスト用画面
Route::get('user', 'userRegistKanriController@index');

//処理成功画面
Route::get('/success', function () {
    return view('common.success');
});






/* 管理画面 */

Route::get('/loginbs', 'loginKanriController@init');
Route::post('/login/home', [
    'uses' => 'loginKanriController@postSignin',
    'as' => 'homeKanri.signin'
    ]);

Route::post('/kanri/userRegist/success', [
    'uses' => 'userRegistKanriController@regist',
    'as' => 'userRegistKanri.regist'
    ]);
/*ユーザ一覧 */
Route::get('/kanri/userListTEST', function () {
    return view('kanri.userListKanri');
});
    
Auth::routes();
/*一般ログイン後画面 */
Route::group(['middleware' => ['can:user']], function () {
    Route::get('/review', [
        'uses' => 'reviewController@init',
    ]);

    /* 一般ユーザログイン後　ホーム*/
    Route::get('/home', [
    'uses' => 'bookspaceController@login',
]);
});
/*管理者ログイン画面*/
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
});
