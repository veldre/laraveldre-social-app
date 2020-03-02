<?php

use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Follower::class,200)->create();
    }
}
