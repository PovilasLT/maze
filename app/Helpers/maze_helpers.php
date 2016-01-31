<?php

function utf8_urldecode($str) {
	return html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i", "&#x\\1;", urldecode($str)), null, 'UTF-8');
}

function markdown($string) {
	$markdown = new maze\Extras\Markdown();
	return $markdown->convert($string);
}

function ex($string)
{
	return html_entity_decode(htmlspecialchars($string));
}

function str_clean($string) {
	return strip_tags($string);
}

function message_html(\maze\Modules\Confer\Message $message) {
	return view('vendor.confer.message')->with(['message' => $message])->render();
}