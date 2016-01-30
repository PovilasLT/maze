<?php namespace maze\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'maze\Console\Commands\Inspire',
		'maze\Console\Commands\ConvertAvatarUploads',
		'maze\Console\Commands\TopicsDecay',
		'maze\Console\Commands\CleanReplies',
		'maze\Console\Commands\RecountFollowers',
		'maze\Console\Commands\EmailNews',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('topics:decay')->hourly();
	}

}
