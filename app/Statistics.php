<?php namespace maze;

use maze\Reply;
use maze\User;
use maze\Topic;
use maze\Vote;
use maze\Streamer;
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

	public static function streams() {
		$value = Cache::remember('statistics_streams', 5, function()
				{
				    return Streamer::count();
				});
		return $value;
	}

	public static function online_streams() {
		$value = Cache::remember('statistics_online_streams', 5, function()
				{
				    return Streamer::where('is_online', 1)->count();
				});
		return $value;
	}

	public static function watching_now() {
		$value = Cache::remember('statistics_watching_now', 5, function()
				{
				    return Streamer::sum('current_viewers');
				});
		return $value;
	}

}
