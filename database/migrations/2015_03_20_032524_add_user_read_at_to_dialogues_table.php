<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserReadAtToDialoguesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dialogues', function(Blueprint $table)
		{
			$table->dropColumn('read_at');
			$table->timestamp('user_read_at');
			$table->timestamp('receiver_read_at');
			$table->boolean('user_read');
			$table->boolean('receiver_read');
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
			
		});
	}

}
