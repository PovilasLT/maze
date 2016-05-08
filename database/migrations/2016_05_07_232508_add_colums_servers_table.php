<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servers', function(Blueprint $table) {
            $table->boolean('is_blocked');
            $table->string('slug');
            $table->integer('vote_count');
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
            $table->dropColumn('is_blocked');
            $table->dropColumn('slug');
            $table->dropColumn('vote_count');
        });
    }
}
