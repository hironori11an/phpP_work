<?php

use Illuminate\Database\Seeder;

class ReviewTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('review_tags')->insert([
            [
                'review_id' => 1,
                'tag_name' => "テスト１",
            ],
 
        ]);
    }
}
