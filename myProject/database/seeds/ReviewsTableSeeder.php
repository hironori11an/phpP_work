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
                'genre' => '0',
                'title' =>'T文学・評論',
                'chysh' =>'C文学・評論',
                'hyk' =>'5',
                'review_niy' =>'ああああああああ',
            ],
            [
                'user_name' =>'ippan',
                'genre' => '1',
                'title' =>'Tノンフィクション',
                'chysh' =>'Cノンフィクション',
                'hyk' =>'5',
                'review_niy' =>'ああああああああ',
            ],
            [
                'user_name' =>'ippan',
                'genre' => '2',
                'title' =>'T人文・思想・宗教',
                'chysh' =>'C人文・思想・宗教',
                'hyk' =>'5',
                'review_niy' =>'ああああああああ',
            ],
            [
                'user_name' =>'ippan',
                'genre' => '3',
                'title' =>'Tコミックス',
                'chysh' =>'Cコミックス',
                'hyk' =>'5',
                'review_niy' =>'ああああああああ',
            ],
            [
                'user_name' =>'ippan',
                'genre' => '8',
                'title' =>'Tその他',
                'chysh' =>'Cその他',
                'hyk' =>'5',
                'review_niy' =>'ああああああああ',
            ],
        ]);
    }
}
