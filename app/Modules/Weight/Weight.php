<?php namespace maze\Modules\Weight;

use maze\Reply;
use maze\Vote;
use Config;

class Weight {

	public function __construct()
	{
		$this->boot();
	}

	public function boot()
	{
		Reply::created(function($reply){
			dd('cr');
			$topic = $reply->topic;
			$topic->increment('weight', Config::get('app.reply_gain_weight'));

		});

		Reply::deleted(function($reply){
			$topic = $reply->topic;
			$topic->decrement('weight', Config::get('app.reply_gain_weight'));
		});

		Vote::created(function($vote)
		{
			if($vote->votable_type == 'Topic')
			{
				$topic = Topic::findOrFail($vote->votable_id);
				//Pridedam svori
				if($vote->is == 'upvote')
				{
					$topic->increment('weight', Config::get('app.upvote_gain_weight'));
				}
				else
				{
					$topic->decrement('weight', Config::get('app.downvote_lose_weight'));
				}
			}
		});

		Vote::deleted(function($vote)
		{
			if($vote->votable_type == 'Topic')
			{
				$topic = Topic::findOrFail($vote->votable_id);
				//Grazinam atimta svori
				if($vote->is == 'upvote')
				{
					$topic->decrement('weight', Config::get('app.upvote_gain_weight'));
				}
				else
				{
					$topic->increment('weight', Config::get('app.downvote_lose_weight'));
				}
			}
		});

	}

}