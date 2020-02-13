<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id'=> rand(1,11),
//        'user_id'=> 12,
        'title' => $faker->slug,
        'text' => $faker->paragraph,
    ];
});
