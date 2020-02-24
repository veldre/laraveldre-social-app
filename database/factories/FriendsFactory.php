<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Friend;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Model;

$factory->define(Friend::class, function (Faker $faker) {
    return [
        'friend_id' => 21,
        'user_id' => rand(1, 20),
        'accepted' => rand(0,1)
    ];
});
