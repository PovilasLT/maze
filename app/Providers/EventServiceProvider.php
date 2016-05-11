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
			'maze\Listeners\LogAction',
		],
		'maze\Events\ReplyWasDeleted' => [
			'maze\Listeners\DecrementWeight',
			'maze\Listeners\DecrementKarma',
			'maze\Listeners\CleanUpNotifications',
			'maze\Listeners\LogAction',
		],
		'maze\Events\TopicWasCreated' => [
			'maze\Listeners\NotifyUser',
			'maze\Listeners\LogAction',
		],
		'maze\Events\TopicWasDeleted' => [
			'maze\Listeners\DecrementKarma',
			'maze\Listeners\CleanUpNotifications',
			'maze\Listeners\LogAction',
			'maze\Listeners\CleanTopic',
		],
		'maze\Events\UpVoted' => [
			'maze\Listeners\IncrementWeight',
			'maze\Listeners\IncrementKarma',
			'maze\Listeners\IncrementVoteCount',
			'maze\Listeners\LogAction',
		],
		'maze\Events\DownVoted' => [
			'maze\Listeners\DecrementWeight',
			'maze\Listeners\DecrementKarma',
			'maze\Listeners\DecrementVoteCount',
			'maze\Listeners\LogAction',
		],
		'maze\Events\StatusWasCreated' => [
			'maze\Listeners\NotifyUser',
			'maze\Listeners\LogAction',
		],
		'maze\Events\StatusWasDeleted' => [
			'maze\Listeners\CleanUpNotifications',
			'maze\Listeners\LogAction',
			'maze\Listeners\CleanStatus',
		],
		'maze\Events\StatusCommentWasCreated' => [
			'maze\Listeners\NotifyUser',
			'maze\Listeners\LogAction',
		],
		'maze\Events\StatusCommentWasDeleted' => [
			'maze\Listeners\CleanUpNotifications',
			'maze\Listeners\LogAction',
		],
		'maze\Events\UserWasMentioned' => [
			'maze\Listeners\NotifyUser',
		],
		'maze\Events\UserWasNotified' => [
			'maze\Listeners\EmailNotification',
		],
		'maze\Events\NewsWasPosted' => [
			'maze\Listeners\LogAction',
		],
		'maze\Events\ConversationWasCreated' => [
			
		],
		'maze\Events\MessageWasSent' => [
			'maze\Listeners\ProcessMessage',
		],
		'maze\Events\AvatarWasUploaded' => [

		],
		'maze\Events\StreamerChannelWasUpdated' => [

		],
		'maze\Events\StreamerStreamWasUpdated' => [
			
		],
		'maze\Events\NodeWasCreated' => [
			'maze\Listeners\AddFrontPageNode',
			'maze\Listeners\LogAction'
		],
		'maze\Events\ServerWasDeleted'	=> [
			'maze\Listeners\NotifyUser',
			'maze\Listeners\CleanUpNotifications',
			'maze\Listeners\LogAction'
		],
		'maze\Events\ServerWasCreated'	=> [
			'maze\Listeners\NotifyUser',
			'maze\Listeners\LogAction'
		],
		'maze\Events\ServerWasRejected' => [
			'maze\Listeners\NotifyUser',
			'maze\Listeners\LogAction'
		],
		'maze\Events\ServerWasApproved' => [
			'maze\Listeners\NotifyUser',
			'maze\Listeners\LogAction'
		],
		'maze\Events\ServerCommentWasCreated' => [
			'maze\Listeners\NotifyUser',
			'maze\Listeners\LogAction'
		],
		'maze\Events\ServerCommentWasDeleted' => [
			'maze\Listeners\NotifyUser',
			'maze\Listeners\CleanUpNotifications',
			'maze\Listeners\LogAction'
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
