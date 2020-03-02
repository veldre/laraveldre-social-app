<?php

use Illuminate\Database\Seeder;

class FriendsTableSeeder extends Seeder
{
     public function run()
    {
        factory(App\Friend::class,100)->create();
    }
}
