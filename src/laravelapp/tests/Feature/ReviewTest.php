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
        $jpeg = UploadedFile::fake()->create('file.jpeg');
        $jpg = UploadedFile::fake()->create('file.jpg');
        $gif = UploadedFile::fake()->create('file.gif');
        
        //png
        $res=$this->post(
            '/review/success',
            [
            'user_name' => 'ippan',
            'genre' => '1',
            'title' => 'テストタイトル',
            'chysh' => 'テスト著者',
            'hyk' => '3',
            'review_niy' => 'テストレビュー内容',
            'photo' => $png,
            'reread_times' => '1',
            'read_end_date_for_first' => '2020-04-01',
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
                'reread_times' => '1',
                'read_end_date_for_first' => '2020-04-01',
            ]
        );
        
        //jpeg
        $res=$this->post(
            '/review/success',
            [
            'user_name' => 'ippan',
            'genre' => '1',
            'title' => 'テストタイトル',
            'chysh' => 'テスト著者',
            'hyk' => '3',
            'review_niy' => 'テストレビュー内容',
            'photo' => $jpeg,
            'reread_times' => '2',
            'read_end_date_for_first' => '2020-04-01',
            'read_end_date_for_second' => '2020-04-02',
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
                'reread_times' => '2',
                'read_end_date_for_first' => '2020-04-01',
                'read_end_date_for_second' => '2020-04-02',
            ]
        );

        //jpg
        $res=$this->post(
            '/review/success',
            [
            'user_name' => 'ippan',
            'genre' => '1',
            'title' => 'テストタイトル',
            'chysh' => 'テスト著者',
            'hyk' => '3',
            'review_niy' => 'テストレビュー内容',
            'photo' => $jpg,
            'reread_times' => '3',
            'read_end_date_for_first' => '2020-04-01',
            'read_end_date_for_second' => '2020-04-02',
            'read_end_date_for_third' => '2020-04-03',
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
                'reread_times' => '3',
                'read_end_date_for_first' => '2020-04-01',
                'read_end_date_for_second' => '2020-04-02',
                'read_end_date_for_third' => '2020-04-03',
            ]
        );

        //gif
        $res=$this->post(
            '/review/success',
            [
            'user_name' => 'ippan',
            'genre' => '1',
            'title' => 'テストタイトル',
            'chysh' => 'テスト著者',
            'hyk' => '3',
            'review_niy' => 'テストレビュー内容',
            'photo' => $gif,
            'reread_times' => '4',
            'read_end_date_for_first' => '2020-04-01',
            'read_end_date_for_second' => '2020-04-02',
            'read_end_date_for_third' => '2020-04-03',
            'read_end_date_for_fourth' => '2020-04-04',
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
                'reread_times' => '4',
                'read_end_date_for_first' => '2020-04-01',
                'read_end_date_for_second' => '2020-04-02',
                'read_end_date_for_third' => '2020-04-03',
                'read_end_date_for_fourth' => '2020-04-04',
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
        $reread_times,//セレクトボックスのため、テスト項目ではない
        $read_end_date_for_first,
        $read_end_date_for_second,
        $read_end_date_for_third,
        $read_end_date_for_fourth,
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
            'reread_times' => $reread_times,
            'read_end_date_for_first' => $read_end_date_for_first,
            'read_end_date_for_second' => $read_end_date_for_second,
            'read_end_date_for_third' => $read_end_date_for_third,
            'read_end_date_for_fourth' => $read_end_date_for_fourth,
            ]
        );
        $res->assertSessionHasErrors($expected);
        $res->assertStatus(302);
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
                '1',//再読回数
                '2020-04-01',//１回目の読了日
                '',//２回目の読了日
                '',//３回目の読了日
                '',//４回目以降の読了日
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
                '1',//再読回数
                '2020-04-01',//１回目の読了日
                '',//２回目の読了日
                '',//３回目の読了日
                '',//４回目以降の読了日
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
                '1',//再読回数
                '2020-04-01',//１回目の読了日
                '',//２回目の読了日
                '',//３回目の読了日
                '',//４回目以降の読了日
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
                '4',//再読回数
                '2020-04-01',//１回目の読了日
                '2020-04-01',//２回目の読了日
                '2020-04-01',//３回目の読了日
                '2020-04-01',//４回目以降の読了日
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
                '4',//再読回数
                '2020-04-01',//１回目の読了日
                '2020-04-01',//２回目の読了日
                '2020-04-01',//３回目の読了日
                '2020-04-01',//４回目以降の読了日
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
                '4',//再読回数
                '2020-04-01',//１回目の読了日
                '2020-04-01',//２回目の読了日
                '2020-04-01',//３回目の読了日
                '2020-04-01',//４回目以降の読了日
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
                '4',//再読回数
                '2020-04-01',//１回目の読了日
                '2020-04-01',//２回目の読了日
                '2020-04-01',//３回目の読了日
                '2020-04-01',//４回目以降の読了日
                ['title']//バリデーションエラー項目
            ],

            // 下記は読了日のチェック
            //10　読了日を全て未入力
            [
                'ippan',//ユーザ名
                '0',//ジャンル
                'タイトル１０',//タイトル
                'テスト著者',//著者
                '3',//評価
                'テストレビュー内容',//レビュー内容
                $photo,//画像
                '4',//再読回数
                '',//１回目の読了日
                '',//２回目の読了日
                '',//３回目の読了日
                '',//４回目以降の読了日
                ['read_end_date_for_first','read_end_date_for_second','read_end_date_for_third','read_end_date_for_fourth']//バリデーションエラー項目
            ],
            //11　読了日を未入力あり
            [
                'ippan',//ユーザ名
                '0',//ジャンル
                'タイトル１１',//タイトル
                'テスト著者',//著者
                '3',//評価
                'テストレビュー内容',//レビュー内容
                $photo,//画像
                '4',//再読回数
                '',//１回目の読了日
                '2020-04-01',//２回目の読了日
                '',//３回目の読了日
                '2020-04-01',//４回目以降の読了日
                ['read_end_date_for_first','read_end_date_for_third']//バリデーションエラー項目
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
                '2',//再読回数
                '2020-04-01',//１回目の読了日
                '2020-04-01',//２回目の読了日
                '',//３回目の読了日
                '',//４回目以降の読了日
                ['photo']//バリデーションエラー項目
            ],
        ];
    }
}
