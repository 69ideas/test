<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('phone');
            $table->string('zip_code');
            $table->string('city');
            $table->string('state');
            $table->boolean('is_admin')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('address_1');
            $table->text('address_2');
            $table->boolean('bank_account_verified')->nullable();
            $table->string('slug', 32);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
