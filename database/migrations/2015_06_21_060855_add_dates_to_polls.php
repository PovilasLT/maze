<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesToPolls extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('polls', function(Blueprint $table)
		{
			$table->timestamps();
		});

		Schema::table('poll_votes', function(Blueprint $table)
		{
			$table->timestamps();
		});

		Schema::table('answers', function(Blueprint $table)
		{
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
	}

}
