<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStuffToServersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('servers', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->index();
			$table->string('ip')->index();
			$table->integer('port')->index();
			$table->integer('vote_count')->index();
			$table->integer('visit_count')->unsigned()->index();
			$table->integer('view_count')->unsigned()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('servers', function(Blueprint $table)
		{
			$table->dropColumn(['ip', 'port', 'vote_count', 'visit_count', 'view_count']);
		});
	}

}
