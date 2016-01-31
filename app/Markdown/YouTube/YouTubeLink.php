<?php namespace maze\Extras\Markdown;

class YouTubeLink {
	
	public static function id($url)
	{
		$pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
	    preg_match($pattern, $url, $matches);
	    return (isset($matches[1])) ? $matches[1] : false;
	}

}