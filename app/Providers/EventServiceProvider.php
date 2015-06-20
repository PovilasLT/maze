<?php namespace maze\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use maze\Reply;
use maze\Vote;
use maze\Topic;
use Config;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		Reply::created(function($reply){
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
