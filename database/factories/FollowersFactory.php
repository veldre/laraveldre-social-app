<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Follower;
use Faker\Generator as Faker;

$factory->define(Follower::class, function (Faker $faker) {
    return [
        'leader_id' => App\User::all()->random()->id,
        'user_id' => App\User::all()->random()->id,
    ];
});
