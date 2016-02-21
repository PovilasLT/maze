<?php

Route::group(['domain' => 'tv.maze.app'], function () {
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