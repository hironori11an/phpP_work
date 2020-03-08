<?php

use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            [
            'user_name' =>'ippan',
            'genre' => '1',
            'title' =>'テストタイトル',
            'chysh' =>'テスト著者',
            'hyk' =>'5',
            'review_niy' =>'ああああああああ',
            ]

        ]);
    }
}
