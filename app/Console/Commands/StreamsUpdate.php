<?php namespace maze\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Carbon\Carbon;
use GuzzleHttp\Client;

use maze\Streamer;

class StreamsUpdate extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'streams:update';

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

        $client = new Client(['base_uri' => 'https://api.twitch.tv/kraken/']);

        $streamers = Streamer::sorted()->chunk(30, function($streamers) use($client) {

            $twitch_names = join(',', $streamers->lists('twitch')->toArray());
            //gaunam streamu ir channeliu info is twitch
            $streams_response = $client->get('streams?channel='.$twitch_names);

            $streams = json_decode($streams_response->getBody());
            $streams = collect($streams->streams);

            foreach($streamers as $k => $streamer)
            {
                foreach($streams as $i => $stream)
                {
                    if(strtolower($stream->channel->name) == strtolower($streamer->twitch))
                    {
                        $streamer->updateChannel($stream->channel);
                        $streamer->updateStream($stream);
                        $streams->pull($i); //isimam streama is collection.
                        $streamers->pull($k); //isimam streameri is atnaujinamu saraso.
                    }
                }
            }

            //kas liko sudedam offline.
            foreach($streamers as $streamer)
            {
                $streamer->setOffline();
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
