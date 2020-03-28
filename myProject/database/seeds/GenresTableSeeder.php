<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = [
            ['id' => '0', 'genre_name' => '文学・評論'],
            ['id' => '1', 'genre_name' => 'ノンフィクション'],
            ['id' => '2', 'genre_name' => '人文・思想・宗教'],
            ['id' => '3', 'genre_name' => 'コミックス'],
            ['id' => '8', 'genre_name' => 'その他'],
        ];

        // save into tstDB.users
        DB::table('genres')->insert($date);
    }
}
