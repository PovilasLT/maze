<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_games', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('default_logo');
            $table->string('style_label');
            $table->timestamps();
            $table->integer('server_count')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('server_games');
    }
}
