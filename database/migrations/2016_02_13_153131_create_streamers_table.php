<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streamers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('twitch')->default('');
            $table->string('youtube')->default('');
            $table->string('donate')->default('');
            $table->string('facebook')->default('');
            $table->boolean('is_online')->default(0);
            $table->boolean('is_partner')->default(0);
            $table->integer('current_viewers')->default(0);
            $table->integer('total_viewers')->default(0);
            $table->integer('total_followers')->default(0);
            $table->string('video_background')->default('');
            $table->string('game')->default('');
            $table->string('logo')->default('');
            $table->string('banner')->default('');
            $table->string('screenshot')->default('');
            $table->string('status')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('streamers');
    }
}
