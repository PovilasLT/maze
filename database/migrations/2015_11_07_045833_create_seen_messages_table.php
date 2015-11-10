<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeenMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seen_messages', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();

            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('message_id')->references('id')->on('confer_messages')->onDelete('cascade');
            $table->timestamp('seen_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seen_messages');
    }
}
