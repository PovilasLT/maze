<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrateTo20 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('achievements');
        Schema::drop('activities');
        Schema::drop('dialogues');
        Schema::drop('given_achievements');
        Schema::drop('messages');
        Schema::drop('pops');
        Schema::drop('push');
        Schema::drop('ranks');
        Schema::drop('reports');
        Schema::drop('server_comments');
        Schema::drop('server_ratings');
        Schema::drop('server_status');
        Schema::drop('servers');
        Schema::drop('sliders');
        Schema::drop('polls');
        Schema::drop('poll_votes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
