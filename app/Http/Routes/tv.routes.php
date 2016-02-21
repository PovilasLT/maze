<?php

Route::group(['domain' => 'tv.'.env('DOMAIN', 'maze.lt')], function () {
    Route::get('/', [
	    'as' => 'tv.index',
	    'uses' => 'TvPagesController@home'
	]);
    Route::get('/ziureti/{twitch}', [
	    'as' => 'streamer.show',
	    'uses' => 'TvStreamerController@show'
	]);
	Route::get('/streameriai', [
	    'as' => 'streamer.all',
	    'uses' => 'TvStreamerController@all'
	]);
});