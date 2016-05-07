<?php namespace maze\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use maze\Topic;
use Config;

class TopicsDecay extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'topics:decay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Decay topics.';

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
        $this->info('Decrementing topics.');
        Topic::decrement('weight', Config::get('app.topics_decay'));
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
