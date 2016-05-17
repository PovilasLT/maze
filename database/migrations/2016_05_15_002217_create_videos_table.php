<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->string('youtube_id')->unique();
            $table->string('image')->index();
            $table->integer('user_id')->unsigned()->index();
            $table->boolean('is_approved')->default(0)->index();
            $table->boolean('is_rejected')->default(0)->index();
            $table->string('reason')->index();
            $table->integer('vote_count')->default(0)->index();
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
        Schema::drop('videos');
    }
}
