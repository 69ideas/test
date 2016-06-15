<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');

            $table->text('content');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('seo_keywords');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')->references('id')->on('pages');

            $table->boolean('manage_pages')->default(0)->nullable();
            $table->integer('sort_order');

            $table->string('menu_name');
            $table->string('seo_url');



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
        Schema::drop('pages');
    }
}
