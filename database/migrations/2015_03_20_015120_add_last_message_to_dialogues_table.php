<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLastMessageToDialoguesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dialogues', function(Blueprint $table)
		{
			$table->dateTime('last_message');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dialogues', function(Blueprint $table)
		{
			$table->dropColumn('last_message');
		});
	}

}
