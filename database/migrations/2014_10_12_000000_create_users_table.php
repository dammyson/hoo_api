<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email', 50)->unique();
            $table->string('phone_number', 15)->nullable();
            $table->string('username')->default('');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('dob')->default('');
            $table->string('state')->default('');
            $table->string('gender')->default('');
            $table->string('baby')->default('');
            $table->string('relationship_status')->default('');
            $table->string('avatar')->nullable();
            $table->string('code', 20)->nullable();
            $table->string('password');
            $table->timestamp('last_login')->nullable();
            $table->string('confirmation_token', 60)->nullable();
            $table->integer('two_factor_country_code')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
