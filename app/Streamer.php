<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Image;
use maze\Events\StreamerChannelWasUpdated;
use maze\Events\StreamerStreamWasUpdated;
use Cache;

class Streamer extends Model
{
    
	protected $fillable = [
		'twitch',
		'facebook',
		'youtube',
		'donate',
		'user_id'
	];

	private $update_interval = 5;
	private $api_values = [];

	public function user() {
		return $this->belongsTo('maze\User');
	}
	
	public function scopeSorted($query) 
	{
		return $query->orderBy('is_partner', 'DESC')->orderBy('is_online', 'DESC')->orderBy('created_at', 'DESC');
	}

	public function scopeRecommended($query) 
	{
		return $query->orderBy('is_online', 'DESC')->orderBy('current_viewers', 'DESC')->orderBy('is_partner', 'DESC')->limit(10);
	}

	public function getStreamImageAttribute() {
		if($this->is_online)
		{
			return $this->screenshot;
		}
		else
		{
			return $this->banner;
		}
	}

	public function getGameAttribute($value) {
		return ucwords($value);
	}

	public function fullLoad() {
        $client = new Client(['base_uri' => 'https://api.twitch.tv/kraken/']);

        try {
	        $stream_response = $client->get('streams/'.$this->twitch);
	        $channel_response = $client->get('channels/'.$this->twitch);
	    }
	    catch(\Exception $e) {
	    	$this->setOffline();
	    	return false;
	    }

	    $stream = json_decode($stream_response->getBody());
        $stream = $stream->stream;

        if($stream_response->getStatusCode() == 200 && $stream)
        {
	        $this->updateStream($stream);
	        $this->updateChannel($stream->channel);
	        
	        if($stream->channel->video_banner)
	        {
	        	$this->createBanner($stream->channel->video_banner);
	        }
	        else
	        {
	        	$this->createBanner('http://wallpoper.com/images/00/37/80/13/abstract-test_00378013.jpg');
	        }
        }
        else
        {
	        if($channel_response->getStatusCode() == 200)
	        {
		        $channel = json_decode($channel_response->getBody());
		        $this->updateChannel($channel);
		        if($channel->video_banner)
		        {
		        	$this->createBanner($channel->video_banner);
		        }
		        else
		        {
		        	$this->createBanner('http://wallpoper.com/images/00/37/80/13/abstract-test_00378013.jpg');
		        }
	        }
	        $this->setOffline();
        }
	}

	public function setOffline() {
		$this->current_viewers = 0;
		$this->is_online = 0;
		$this->save();
	}

	public function updateStream($stream)
	{
		$this->is_online = 1;
		$this->game = $stream->game;
		$this->current_viewers = $stream->viewers;
		$this->status = $stream->channel->status;
		$this->total_viewers = $stream->channel->views;
		$this->total_followers = $stream->channel->followers;
		$this->video_background = $stream->channel->video_banner;
		$this->screenshot = $stream->preview->large;
		$this->logo = $stream->channel->logo;
		$this->save();

		event(new StreamerStreamWasUpdated($this));

	}

	public function updateChannel($channel)
	{
		$this->game = $channel->game;
		$this->status = $channel->status;
		$this->total_viewers =$channel->views;
		$this->total_followers = $channel->followers;
		$this->video_background = $channel->video_banner;
		$this->logo = $channel->logo;
		$this->save();

		event(new StreamerChannelWasUpdated($this));
	}

	public function createBanner($url)
	{
		$image = Image::make($url);
		$file_name = '/images/streamers/'.e($this->twitch).'.jpg';
		$image = $image->fit(640, 360)->save(public_path().$file_name);
		$this->banner = $file_name;
		$this->save();
	}

	public static function getFrontPage()
	{
		$streams = Cache::remember('frontpage_streams', 3, function() {
			return self::recommended()->get();
		});

		return $streams;
	}

	public function url()
	{
		return route('streamer.show', $this->twitch);
	}

}
