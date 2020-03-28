<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class ReviewTest extends TestCase
{
    use RefreshDatabase;
 
    public function setup(): void
    {
        parent::setUp();
        $this->seed('GenresTableSeeder');
        $this->seed('UsersTableSeeder');
    }
    /**
     * @test
     * 正常系
     */
    public function regist()
    {
        $png = UploadedFile::fake()->create('file.png');
        
        $res=$this->post(
            '/review/success',
            [
            'user_name' => 'ippan',
            'genre' => '1',
            'title' => 'テストタイトル',
            'chysh' => 'テスト著者',
            'hyk' => '3',
            'review_niy' => 'テストレビュー内容',
            'photo' => $png
            ]
        );
        $res->assertSessionHasNoErrors();
        $res->assertSeeText('レビュー投稿が完了しました');
        $this->assertDatabaseHas(
            'reviews',
            [
                'user_name' => 'ippan',
                'genre' => '1',
                'title' => 'テストタイトル',
                'chysh' => 'テスト著者',
                'hyk' => '3',
                'review_niy' => 'テストレビュー内容',
            ]
        );
    }

    /**
     * @test
     * @dataProvider requiredProvider
     * @dataProvider niyProvider
     */
    public function testErrValidation(
        $user_name,//sessionの値
        $genre,//セレクトボックスのため、テスト項目ではない
        $title,//最大桁はhtmlにて設定
        $chysh,//最大桁はhtmlにて設定
        $hyk,//ラジオボタンのため、テスト項目ではない
        $review_niy,//最大桁はhtmlにて設定
        $photo,
        $expected
    ) {
        $res=$this->post(
            '/review/success',
            [
            'user_name' => $user_name,
            'genre' => $genre,
            'title' => $title,
            'chysh' => $chysh,
            'hyk' => $hyk,
            'review_niy' => $review_niy,
            'photo' => $photo,
            ]
        );
        $res->assertSessionHasErrors($expected);
        $res->assertStatus(302);
        // $res->assertRedirect('/home');
    }

    public function requiredProvider()
    {
        //必須項目チェック
        $photo = UploadedFile::fake()->create('file.png');
        return [
            //すべて入力なし
            [
                'ippan',//ユーザ名
                '0',//ジャンル
                '',//タイトル
                '',//著者
                '3',//評価
                '',//レビュー内容
                $photo,//画像
                ['title','chysh','review_niy']//バリデーションエラー項目
            ],
            //タイトルのみ入力
            [
                'ippan',//ユーザ名
                '0',//ジャンル
                'テストタイトル',//タイトル
                '',//著者
                '3',//評価
                '',//レビュー内容
                $photo,//画像
                ['chysh','review_niy']//バリデーションエラー項目
            ],

            //著者のみ入力
            [
                'ippan',//ユーザ名
                '0',//ジャンル
                '',//タイトル
                'テスト著者',//著者
                '3',//評価
                '',//レビュー内容
                $photo,//画像
                ['title','review_niy']//バリデーションエラー項目
            ],

            //レビュー内容のみ入力
            [
                'ippan',//ユーザ名
                '0',//ジャンル
                '',//タイトル
                '',//著者
                '3',//評価
                'テストレビュー内容',//レビュー内容
                $photo,//画像
                ['title','chysh']//バリデーションエラー項目
            ],

            //タイトル、著者を入力
            [
                'ippan',//ユーザ名
                '0',//ジャンル
                'テストタイトル',//タイトル
                'テスト著者',//著者
                '3',//評価
                '',//レビュー内容
                $photo,//画像
                ['review_niy']//バリデーションエラー項目
            ],

            //タイトル、レビュー内容を入力
            [
                'ippan',//ユーザ名
                '0',//ジャンル
                'テストタイトル',//タイトル
                '',//著者
                '3',//評価
                'テストレビュー内容',//レビュー内容
                $photo,//画像
                ['chysh']//バリデーションエラー項目
            ],

            //著者、レビュー内容を入力
            [
                'ippan',//ユーザ名
                '0',//ジャンル
                '',//タイトル
                'テスト著者',//著者
                '3',//評価
                'テストレビュー内容',//レビュー内容
                $photo,//画像
                ['title']//バリデーションエラー項目
            ],
        ];
    }

    public function niyProvider()
    {
        //入力内容チェック
        $pdf = UploadedFile::fake()->create('file.pdf');
        return [
            [
                'ippan',//ユーザ名
                '0',//ジャンル
                'テストタイトル',//タイトル
                'テスト著者',//著者
                '3',//評価
                'テストレビュー内容',//レビュー内容
                $pdf,//画像
                ['photo']//バリデーションエラー項目
            ],
        ];
    }
}
