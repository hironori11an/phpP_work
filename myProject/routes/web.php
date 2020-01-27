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
/* 一般ユーザログイン後ホーム*/
Route::get('/home', [
    'uses' => 'bookspaceController@login',
    ]);

// テスト用画面
Route::get('user', 'userRegistKanriController@index');

//処理成功画面
Route::get('/success', function () {
    return view('common.success');
});
/*ユーザ一覧 */
Route::get('/kanri/userListTEST', function () {
    return view('kanri.userListKanri');
});

/* 管理画面 */

Route::get('/loginKanri', 'loginKanriController@init');
Route::post('/login/home', [
    'uses' => 'loginKanriController@postSignin',
    'as' => 'homeKanri.signin'
    ]);

Route::post('/kanri/userRegist/success', [
    'uses' => 'userRegistKanriController@regist',
    'as' => 'userRegistKanri.regist'
    ]);
    
Auth::routes();
//管理ホーム画面
// Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
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
