<?php namespace maze\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use maze\Streamer;

class StreamsLoadAll extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'streams:loadall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atnaujina streamus.';

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


        $streamers = Streamer::sorted()->chunk(30, function($streamers) {
            foreach($streamers as $streamer)
            {
                $streamer->fullLoad();
            }
        });
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
