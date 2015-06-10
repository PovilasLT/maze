<?php namespace maze;

use maze\Reply;
use maze\User;
use maze\Topic;
use maze\Vote;
use Illuminate\Support\Facades\Cache;

class Statistics {

	public static function replies() {
		$value = Cache::remember('statistics_replies', 5, function()
				{
				    return Reply::count();
				});
		return $value;
	}

	public static function topics() {
		$value = Cache::remember('statistics_topics', 5, function()
				{
				    return Topic::count();
				});
		return $value;
	}

	public static function users() {
		$value = Cache::remember('statistics_users', 5, function()
				{
				    return User::count();
				});
		return $value;
	}

	public static function karma() {
		$value = Cache::remember('statistics_karma', 5, function()
				{
				    return Vote::count();
				});
		return $value;
	}

}
