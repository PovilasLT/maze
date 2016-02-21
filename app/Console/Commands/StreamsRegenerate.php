<?php namespace maze\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Carbon\Carbon;
use GuzzleHttp\Client;

use maze\Streamer;

class StreamsRegenerate extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'streams:regenerateimage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atnaujina streamų nuotraukas.';

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
        $client = new Client(['base_uri' => 'https://api.twitch.tv/kraken/']);

        $streamers = Streamer::sorted()->chunk(30, function($streamers) use($client) {
            foreach($streamers as $streamer)
            {
                if($streamer->video_background)
                {
                    $url = $streamer->video_background;
                }
                else
                {
                    $url = public_path().'/images/no_video.jpg';
                }
                
                $streamer->createBanner($url);
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
