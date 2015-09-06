<?php

function utf8_urldecode($str) {
	return html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($str)), null, 'UTF-8');
}

function markdown($string) {

	$parser = new \maze\Modules\Markdown\Parser();

	return $parser->parse($string);

}

function ex($string)
{
	return html_entity_decode($string);
}