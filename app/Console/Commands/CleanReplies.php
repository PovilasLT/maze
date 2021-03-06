<?php namespace maze\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use maze\Reply;

class CleanReplies extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'clean:replies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans replies w/o topics.';

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
        foreach (Reply::all() as $reply) {
            if (!$reply->topic) {
                $reply->delete();
            }
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
