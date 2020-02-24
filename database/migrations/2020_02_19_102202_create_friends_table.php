<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{

    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();    // id of user who sent request
            $table->integer('friend_id')->unsigned();   // id of user who got request
            $table->tinyInteger('accepted');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friend_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
