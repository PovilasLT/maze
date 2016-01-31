<?php namespace maze\Extras\Markdown;

class TwitchLink {
	public static function channel($url) {
		if(str_replace('www.', '', parse_url($url, PHP_URL_HOST)) == 'twitch.tv')
		{
			$params = explode('/', parse_url($url, PHP_URL_PATH));
			if(sizeof($params) == 2)
			{
				return $params[1];
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}