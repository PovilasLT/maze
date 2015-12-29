<?php namespace maze\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use maze\Reply;
use maze\Vote;
use maze\Topic;
use maze\Modules\News\News as ModuleNews;
use maze\Modules\CacheBuster\CacheBuster as ModuleCacheBuster;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'maze\Events\ReplyWasCreated' => [
			'maze\Listeners\NotifyUser',
			'maze\Listeners\IncrementWeight',
		],
		'maze\Events\ReplyWasDeleted' => [
			'maze\Listeners\DecrementWeight',
			'maze\Listeners\DecrementKarma',
		],
		'maze\Events\TopicWasCreated' => [
			'maze\Listeners\NotifyUser',
		],
		'maze\Events\TopicWasDeleted' => [
			'maze\Listeners\DecrementKarma',
		],
		'maze\Events\UpVoted' => [
			'maze\Listeners\IncrementWeight',
			'maze\Listeners\IncrementKarma',
			'maze\Listeners\IncrementVoteCount',
		],
		'maze\Events\DownVoted' => [
			'maze\Listeners\DecrementWeight',
			'maze\Listeners\DecrementKarma',
			'maze\Listeners\DecrementVoteCount',
		],
		'maze\Events\StatusWasCreated' => [
			'maze\Listeners\NotifyUser',
		],
		'maze\Events\StatusCommentWasCreated' => [
			'maze\Listeners\NotifyUser',
		],
		'maze\Events\UserWasMentioned' => [
			'maze\Listeners\NotifyUser',
		],
		'maze\Events\UserWasNotified' => [
			'maze\Listeners\EmailNotification',
		],
	];

	/**
	 * Register any other events or modules for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//modulių registracija
		$modules = [
			'cachebuster'	=> new ModuleCacheBuster(),
		];

	}

}
