<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class InsertUserIdToActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('actions', function(Blueprint $table)
		{
            $table->string('name')->index();
            $table->integer('item_id')->unsigned()->nullable()->index();
            $table->string('item_name')->nullable()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('actions', function(Blueprint $table)
		{
            $table->dropColumn('name');
            $table->dropColumn('item_id');
            $table->dropColumn('item_name');
		});
	}

}
