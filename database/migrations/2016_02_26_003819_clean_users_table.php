<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('rank_id');
            $table->dropColumn('group_id');
            $table->dropColumn('wiki_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->integer('rank_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->integer('wiki_count');
        });
    }
}
