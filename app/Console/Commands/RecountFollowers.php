<?php namespace maze\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use maze\User;
use maze\Follower;

class RecountFollowers extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'recount:followers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recounts followers.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        foreach(User::all() as $user)
        {
            $user->follower_count = $user->followers()->count();
            $user->save();
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
        ];
    }

}
