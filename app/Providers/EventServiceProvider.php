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
			'maze\Listeners\CleanUpNotifications',
		],
		'maze\Events\TopicWasCreated' => [
			'maze\Listeners\NotifyUser',
		],
		'maze\Events\TopicWasDeleted' => [
			'maze\Listeners\DecrementKarma',
			'maze\Listeners\CleanUpNotifications',
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
		'maze\Events\StatusWasDeleted' => [
			'maze\Listeners\CleanUpNotifications',
		],
		'maze\Events\StatusCommentWasCreated' => [
			'maze\Listeners\NotifyUser',
		],
		'maze\Events\StatusCommentWasDeleted' => [
			'maze\Listeners\CleanUpNotifications',
		],
		'maze\Events\UserWasMentioned' => [
			'maze\Listeners\NotifyUser',
		],
		'maze\Events\UserWasNotified' => [
			'maze\Listeners\EmailNotification',
		],
		'maze\Events\NewsWasPosted' => [
			'maze\Listeners\EmailNews',
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
	}

}
