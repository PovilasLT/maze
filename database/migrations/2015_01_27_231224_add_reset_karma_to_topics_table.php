<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use maze\Topic;
use maze\Reply;

class AddResetKarmaToTopicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Topic::where('vote_count', '<', '0')->update(['vote_count' => 0]);
		Reply::where('vote_count', '<', '0')->update(['vote_count' => 0]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('topics', function(Blueprint $table)
		{
			
		});
	}

}
