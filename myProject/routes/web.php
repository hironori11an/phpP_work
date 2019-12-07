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

Route::get('/', function () {
    return view('welcome');
});
//トップ画面
Route::get('/home', function () {
    return view('home');
});

// テスト用画面
Route::get('user', 'userRegistKanriController@index');

//処理成功画面
Route::get('/success', function () {
    return view('common.success');
});

/* 管理画面 */

Route::get('/loginKanri', 'loginKanriController@init');
Route::post('/kanri', [
    'uses' => 'loginKanriController@postSignin',
    'as' => 'homeKanri.signin'
    ]);

Route::post('/hello', [
    'uses' => 'userRegistKanriController@validation',
    'as' => 'userRegistKanri.validation'
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
    });







Route::get('/home', 'HomeController@index')->name('home');
