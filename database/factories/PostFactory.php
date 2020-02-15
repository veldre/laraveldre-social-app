<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
//        'user_id'=> rand(1,10),
        'user_id'=> 21,
        'title' => $faker->slug,
        'text' => $faker->paragraph,
    ];
});
