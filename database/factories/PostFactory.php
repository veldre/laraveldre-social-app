<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id'=> rand(43,62),
//        'user_id'=> 27,
        'title' => $faker->slug,
        'text' => $faker->paragraph,
    ];
});
