<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServerComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_comments', function(Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->text('body_original');
            $table->integer('user_id')->unsigned();
            $table->integer('server_id')->unsigned();
            $table->integer('vote_count');
            $table->timestamps();
            $table->string('slug');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('server_comments');
    }
}
