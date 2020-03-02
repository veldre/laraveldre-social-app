<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{

    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('album_id')->unsigned();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            $table->string('photo');
            $table->string('title');
            $table->string('size');
            $table->string('description');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
