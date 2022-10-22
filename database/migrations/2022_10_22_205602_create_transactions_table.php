<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.  php artisan migrate:refresh --path=/database/migrations/2022_10_22_205602_create_transactions_table.php
     *
     * @return void
     */
    public function up()
    {
      
            Schema::create('transactions', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('user_id')->index();
                $table->integer('cost')->default(0);
                $table->string('type')->default('');
                $table->string('ref')->default('');
                $table->string('status')->default('');
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
        Schema::dropIfExists('transactions');
    }
}
