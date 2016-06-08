<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('streamer_id')->unsigned();
            $table->string('secret')->notNullable();
            $table->string('donation_message')->nullable()->index();
            $table->string('donation_gif')->nullable()->index();
            $table->string('donation_banner')->nullable()->index();
            $table->integer('donation_alert_duration')->unsigned()->default(10)->index();
            $table->integer('donation_alert_volume')->unsigned()->default(50)->index();
            $table->string('donation_sound')->nullable()->index();
            $table->integer('paysera_project_id')->unsigned()->index()->notNullable();
            $table->string('paysera_sign_password')->notNullable()->index();
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
        Schema::drop('channels');
    }
}
