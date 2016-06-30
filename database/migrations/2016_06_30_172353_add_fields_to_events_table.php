<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            
            $table->dropColumn('is_show');
            $table->dropColumn('title');
            $table->string('short_description')->nullable()->change();
            $table->integer('number_participants')->nullable();
            $table->boolean('vxp_fees')->nullable();
            $table->boolean('cc_fees')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->boolean('is_show')->nullable();
            $table->dropColumn('vxp_fees');
            $table->dropColumn('cc_fees');
            $table->dropColumn('number_participants');
            $table->text('short_description')->nullable()->change();

        });
    }
}
