<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ip')->nullable();
            $table->integer('port')->nullable();
            $table->integer('user_id')->unsigned();     
            $table->text('body');
            $table->text('body_original');
            $table->string('website')->nullable();
            $table->integer('game_id')->unsigned();
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->boolean('is_confirmed');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('server_games')->onDelete('cascade'); // Manau tai suteikia nemažai galios game_type ištrynimui :s
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('servers');
    }
}
