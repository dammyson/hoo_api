<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations. php artisan migrate:refresh --path=/database/migrations/2022_09_04_215549_create_tickets_table.php
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('event_id')->index();
            $table->string('title')->default('');
            $table->double('cost')->default(0.00);
            $table->integer('quantity')->default(0);
            $table->integer('min_allow')->default(0);
            $table->integer('max_allow')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}