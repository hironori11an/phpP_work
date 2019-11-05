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

Route::get('/hello', function () {
    // xdebug_break();
    return view('hello');
})->name('hello');




Route::get('/loginKanri', 'homeKanriController@init');
Route::post('/homeKanri', [
    'uses' => 'homeKanriController@postSignin',
    'as' => 'homeKanri.signin'
    ]);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
