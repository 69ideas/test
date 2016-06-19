<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image');
            $table->text('description');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('closed_date')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->text('short_description');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('seo_keywords');
            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->boolean('allow_anonymous')->default(0)->nullable();
            $table->boolean('is_show')->default(0)->nullable();
            $table->integer('sort_order');

            $table->string('slug');



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
        Schema::drop('events');
    }
}
