<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'name' =>'ippan',
            'password' =>Hash::make('ippan'),
            'role' =>'0',
            ],
            [
            'name' =>'kanri',
            'password' =>Hash::make('kanri'),
            'role' =>'1',
            ]
        ]);
    }
}
