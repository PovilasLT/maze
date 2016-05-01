<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRepliesTableForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('replies', function($table) {
            $table->integer('user_id')->unsigned()->change();
            $table->integer('topic_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('replies', function($table) {
            $table->dropForeign('replies_user_id_foreign');
            $table->dropForeign('replies_topic_id_foreign');
        });

        Schema::table('replies', function($table) {
            $table->integer('user_id')->change();
            $table->integer('topic_id')->change();
        });
    }
}
