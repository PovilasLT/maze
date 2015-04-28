<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGivenAchievementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('given_achievements', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('user_id')->unsigned()->index();
			$table->integer('achievement_id')->unsigned()->index();

			//meta
			$table->timestamps(); //achievement receive date.
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('given_achievements');
	}

}
