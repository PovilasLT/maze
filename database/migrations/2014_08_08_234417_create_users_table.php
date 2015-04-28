<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');

			//main info
			$table->string('email')->index();
			$table->string('username')->index();
			$table->string('password');

			$table->integer('rank_id')->unsigned();
			$table->integer('group_id')->unsigned(); //rodoma grupė.

			//profile fields
			$table->string('city')->nullable()->index();
			$table->date('dob')->nullable()->index();
			$table->text('about_me')->nullable();
			$table->tinyInteger('sex')->nullable()->index(); // 0 female | 1 male
			
			//social stuff
			$table->string('facebook')->nullable()->index();
			$table->string('twitter')->nullable()->index();
			$table->string('steam')->nullable()->index();
			$table->string('twitch')->nullable()->index();

			$table->string('website')->nullable()->index();
			
			//picture + cover
			$table->string('image_url')->nullable();
			$table->string('cover_url')->nullable();

			//other stuff we don't really care about
			$table->boolean('is_banned')->default(false)->index();
			$table->string('remember_token')->nullable();

			$table->integer('topic_count')->default(0)->index();
			$table->integer('reply_count')->default(0)->index();
			$table->integer('status_count')->default(0)->index();
			$table->integer('follower_count')->default(0)->index();
			$table->integer('wiki_count')->default(0)->index();
			$table->integer('karma_count')->default(0)->index();
			$table->integer('profile_views')->default(0)->index();


			$table->softDeletes();
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
		Schema::drop('users');
	}

}
