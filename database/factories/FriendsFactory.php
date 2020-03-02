<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Friend;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Model;

$factory->define(Friend::class, function (Faker $faker) {
    return [
        'friend_id' => App\User::all()->random()->id,
        'user_id' => App\User::all()->random()->id,
        'status' => 'confirmed'
    ];
});
