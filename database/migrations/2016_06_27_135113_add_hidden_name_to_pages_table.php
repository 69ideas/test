<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHiddenNameToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('hidden_name')->nullable();
            $table->string('brief')->nullable();
            $table->boolean('on_top')->nullable();
            $table->boolean('on_bottom')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('hidden_name');
            $table->dropColumn('on_top');
            $table->dropColumn('on_bottom');
            $table->dropColumn('brief');
    

        });
    }
}
