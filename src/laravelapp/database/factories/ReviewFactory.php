<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        // 'name' => $faker->name,
        // 'email' => $faker->unique()->safeEmail,
        // 'email_verified_at' => now(),
        // 'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        // 'remember_token' => Str::random(10),

        'user_name' =>'taro',
        'genre' => strval($faker->numberBetween(0,3)),
        'title' => $faker->word(5),
        'chysh' => $faker->name,
        'hyk' => strval($faker->numberBetween(1,5)),
        'review_niy' => $faker->realText(70),
        'reread_times' => '1',
        'read_end_date_for_first' => $faker->dateTime,
    ];
});
