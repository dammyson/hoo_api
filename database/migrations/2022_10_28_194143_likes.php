<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Likes extends Migration
{

    /**
     * Run the migrations php artisan migrate:refresh --path=/database/migrations/2022_10_28_194143_likes.php
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->constrained()->onDelete('cascade');
            $table->string("likeable_id");
            $table->string("likeable_type");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
