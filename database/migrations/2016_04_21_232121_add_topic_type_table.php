<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTopicTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('topic_types');
        Schema::create('topic_types', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label_style'); // css stiliaus klasė
            $table->string('icon');
            $table->boolean('is_selflock');
            $table->boolean('is_admin');
            $table->boolean('is_ad');
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
        Schema::drop('topic_types');
    }
}
