<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();
        $this->seed('ReviewsTableSeeder');
        $this->seed('GenresTableSeeder');
        $this->seed('UsersTableSeeder');
    }

    /**
     * @test
     * 検索画面から条件を指定して検索する
     */
    public function search()
    {
        /** ジャンルの検索 */
        $res=$this->post(
            '/search/results',
            [
                'genre' => '0',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('文学・評論');
        $res->assertDontSeeText('ノンフィクション');
        
            $res=$this->post(
            '/search/results',
            [
                'genre' => '1',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('ノンフィクション');

        $res=$this->post(
            '/search/results',
            [
                'genre' => '2',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('人文・思想・宗教');

        $res=$this->post(
            '/search/results',
            [
                'genre' => '3',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('コミックス');

        $res=$this->post(
            '/search/results',
            [
                'genre' => '8',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('その他');

        $res=$this->post(
            '/search/results',
            [
                'genre' => '9',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('文学・評論');
        $res->assertSeeText('ノンフィクション');
        $res->assertSeeText('人文・思想・宗教');
        $res->assertSeeText('コミックス');
        $res->assertSeeText('その他');

        /** タイトルの検索 */

        //あいまい検索
        $res=$this->post(
            '/search/results',
            [
                'genre' => '9',
                'title' => 'T',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('T文学・評論');
        $res->assertSeeText('T人文・思想・宗教');
        $res->assertSeeText('Tコミックス');
        $res->assertSeeText('Tその他');

        //完全一致検索
        $res=$this->post(
            '/search/results',
            [
                'genre' => '0',
                'title' => 'T文学・評論',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('T文学・評論');
        $res->assertDontSeeText('T人文・思想・宗教');

        //見つからない
        $res=$this->post(
            '/search/results',
            [
                'genre' => '0',
                'title' => 'Tノンフィクション',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('検索結果はありません。他の条件で検索してください。');

        /** 著者の検索 */

        //あいまい検索
        $res=$this->post(
            '/search/results',
            [
                'genre' => '9',
                'title' => 'T',
                'chysh' =>'C',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('T文学・評論');
        $res->assertSeeText('T人文・思想・宗教');
        $res->assertSeeText('Tコミックス');
        $res->assertSeeText('Tその他');

        //完全一致検索
        $res=$this->post(
            '/search/results',
            [
                'genre' => '0',
                'title' => 'T文学・評論',
                'chysh' =>'C文学・評論',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('T文学・評論');
        $res->assertSeeText('C文学・評論');
        $res->assertDontSeeText('T人文・思想・宗教');
        $res->assertDontSeeText('C人文・思想・宗教');
        

        //見つからない
        $res=$this->post(
            '/search/results',
            [
                'genre' => '0',
                'title' => 'T',
                'chysh' => 'Cノンフィクション',
                'searchBtn' => '検索',
            ]
        );
        $res->assertSeeText('検索結果はありません。他の条件で検索してください。');
    }

    /**
     * @test
     * ユーザを指定して検索する
     */
    public function searchUserName()
    {
        //見つかる
        $res=$this->get('/search/results/ippan');
        $res->assertSeeText('ippanさんのレビュー一覧');

        //見つからない
        $res=$this->get('/search/results/test');
        $res->assertSeeText('ユーザが見つかりません');
    }
}
