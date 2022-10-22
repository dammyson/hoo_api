<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyTicketsTable extends Migration
{
    /**
     * Run the migrations php artisan migrate:refresh --path=/database/migrations/2022_10_22_204900_create_my_tickets_table.php
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_tickets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->uuid('event_id')->index();
            $table->uuid('ticket_id')->index();
            $table->uuid('transaction_id')->index();
            $table->integer('quantity')->default(0);
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('email')->default('');
            $table->string('phone_number')->default('');
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
        Schema::dropIfExists('my_tickets');
    }
}
