<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDialoguesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dialogues', function(Blueprint $table)
		{
			$table->increments('id')->index();
			$table->integer('user_id')->unsigned()->index();
			$table->integer('receiver_id')->unsigned()->index();
			$table->integer('messages')->unsigned()->default(0)->index();
			$table->dateTime('read_at')->nullable();
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
		Schema::drop('dialogues');
	}

}
