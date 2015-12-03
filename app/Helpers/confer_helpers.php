<?php

function confer_make_list($items, $oxford_comma = false)
{
	if( ! is_array($items)) {
		$items = $items->all();
	}
    $list = implode(', ', $items);
    if (count($items) == 1) return $list;
    return $oxford_comma ? substr_replace($list, ', ir', strrpos($list, ','), strlen(',')) : substr_replace($list, ' ir', strrpos($list, ','), strlen(','));
}

function confer_convert_emoji_to_shortcodes($text)
{
	return \Emojione\Emojione::toShort($text);
}