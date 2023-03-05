<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
/*$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});*/

$factory->define(App\Post::class, function ($faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph(3),
        'status_id' => rand(1,4),
        'public' => rand(0,1),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {

    $maxIndex = DB::table('posts')->max('id');
    $visiblepostsid = \App\Post::where('status_id', 4)->pluck('id')->toArray();
    $rand_key = array_rand($visiblepostsid, 1);

    return [
        'content' => $faker->paragraph,
        'post_id' => $visiblepostsid[$rand_key],
        'user_id' => rand(1,5),
    ];
});
