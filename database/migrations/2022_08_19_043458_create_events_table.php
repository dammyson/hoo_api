<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{ 
    /**
     * Run the migrations.  php artisan migrate:refresh --path=/database/migrations/2022_08_19_043458_create_events_table.php
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->string('title')->default('');
            $table->string('location')->default('');
            $table->string('description')->default('');
            $table->string('category')->default('');
            $table->string('start_date')->default('');
            $table->string('end_date')->default('');
            $table->string('type')->default('');
            $table->string('banner')->default('');
            $table->string('tickets')->default('');
            $table->string('city')->default('');
            $table->string('longitude')->default('');
            $table->string('latitude')->default('');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
