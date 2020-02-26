<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testView()
    {
        // ホーム画面
        $this->get('/')->assertSee('BookSpace');

        // URLパラメーター（ユーザが存在する場合）　/search/results/{user_name?}
        $this->get('/search/results/ippan')->assertSee('ippan');
        // URLパラメーター（ユーザが存在しない場合）　/search/results/{user_name?}
        $this->get('/search/results/hoge')->assertSee('ユーザが見つかりません');

        // 検索画面
        $this->get('/search')->assertOK();
        
        // レビュー画面　ログインしていない場合、アクセス不可
        $this->get('/review')->assertStatus(403);

        // ログイン後ホーム画面　ログインしていない場合、アクセス不可
        $this->get('/home')->assertStatus(403);

        // 管理画面　ログインしていない場合、アクセス不可
        $this->get('/kanri')->assertStatus(403);
        // 管理ユーザ登録画面　ログインしていない場合、アクセス不可
        $this->get('/kanri/userRegist')->assertStatus(403);
        // 管理ユーザ一覧画面　ログインしていない場合、アクセス不可
        $this->get('/kanri/userList')->assertStatus(403);

        //管理者でログインすると管理者ホームヘ遷移
        $res=$this->post('/login/home', [
            'login' => 'ログイン',
            'name' => 'kanri',
            'password' => 'kanri',
        ]);
        $res->assertStatus(302);

        //一般ユーザでログインすると一般ホームヘ遷移
        $res=$this->post('/login/home', [
            'login' => 'ログイン',
            'name' => 'ippan',
            'password' => 'ippan',
        ]);
        $res->assertStatus(302);
    }
}
