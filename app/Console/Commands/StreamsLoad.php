<?php namespace maze\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use maze\Streamer;

class StreamsLoad extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'streams:load';

    protected $signature = 'streams:load {streamer_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atnaujina streama pilnai.';

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
        $streamer = Streamer::find($this->argument('streamer_id'));
        if($streamer)
        {
            $streamer->fullLoad();
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
            'streamer_id'
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
