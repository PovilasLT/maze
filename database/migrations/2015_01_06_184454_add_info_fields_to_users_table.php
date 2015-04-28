<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddInfoFieldsToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('skype')->nullable()->index();
            $table->string('youtube')->nullable()->index();
            $table->string('hitbox')->nullable()->index();
            $table->string('origin')->nullable()->index();
            $table->string('deviantart')->nullable()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn(['skype', 'youtube', 'hitbox', 'deviantart', 'origin']);
		});
	}

}
