<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventNumnberEventCodeStatusFieldsToEvensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('status')->default(0);
            $table->string('event_number')->nullable();
            $table->string('event_code')->nullable();
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
            $table->dropColumn('status');
            $table->dropColumn('event_number');
            $table->dropColumn('event_code');
        });
    }
}
