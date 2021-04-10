<?php

use Illuminate\Database\Seeder;

class ReviewUserLikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('review_user_likes')->insert([
            [
                'user_id' => 1,
                'review_id' => 1,
            ],
 
        ]);
    }
}
