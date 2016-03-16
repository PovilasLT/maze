<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function($table) {
            $table->dropColumn('is_excellent');
            $table->dropColumn('is_wiki');
            $table->dropColumn('excerpt');
            $table->dropColumn('last_reply_user_id');
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
            $table->tinyInteger('is_excellent');
            $table->tinyInteger('is_wiki');
            $table->text('excerpt')->nullable();
            $table->integer('last_reply_user_id')->nullable();
        });
    }
}
