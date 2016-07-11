<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommisionsFieldToParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->float('vxp_fees')->nullable();
            $table->float('cc_fees')->nullable();
            $table->float('coordinator_collected')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn('vxp_fees');
            $table->dropColumn('cc_fees');
            $table->dropColumn('coordinator_collected');
        });
    }
}
