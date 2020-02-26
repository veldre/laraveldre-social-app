<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => rand(2,20),
        'title' => $faker->sentence,
        'text' => $faker->paragraphs(7,true),
    ];
});
