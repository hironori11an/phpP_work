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
    use RefreshDatabase;
    public function testView()
    {
        // ホーム画面
        $this->get('/')->assertSee('BookSpace');

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
    }
}
