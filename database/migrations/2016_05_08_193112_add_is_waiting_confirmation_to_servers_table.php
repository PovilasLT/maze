<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsWaitingConfirmationToServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servers', function(Blueprint $table) {
            $table->boolean('is_waiting_confirmation')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servers', function(Blueprint $table) {
            $table->dropColumn('is_waiting_confirmation');
        });
    }
}
