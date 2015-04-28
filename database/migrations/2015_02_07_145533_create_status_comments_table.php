<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatusCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('status_comments', function(Blueprint $table)
		{
			$table->increments('id')->index();
			$table->integer('user_id')->unsigned()->index();
			$table->integer('status_id')->unsigned()->index();

			$table->text('body');

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
		Schema::drop('status_comments');
	}

}
