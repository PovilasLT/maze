<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTopicsTableForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function($table) {
            $table->integer('user_id')->unsigned()->change();
            $table->integer('node_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('node_id')->references('id')->on('nodes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function($table) {
            $table->dropForeign('topics_user_id_foreign');
            $table->dropForeign('topics_node_id_foreign');
            
        });
        Schema::table('topics', function($table) {
            $table->integer('user_id')->change();
            $table->integer('node_id')->change();
        });
    }
}
