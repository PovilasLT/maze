<?php

Route::get('/donate/{channel_id}', [
	'as'	=> 'twitch.donations.index',
	'uses'	=> 'Twitch\DonationsController@index'
]);

Route::post('/donate/{channel_id}', [
	'as'	=> 'twitch.donations.gateway',
	'uses'	=> 'Twitch\DonationsController@gateway'
]);

Route::get('/donate/{channel_id}/cancel', [
	'as'	=> 'twitch.donations.cancel',
	'uses'	=> 'Twitch\DonationsController@cancel'
]);

Route::get('/donate/{channel_id}/accept', [
	'as'	=> 'twitch.donations.accept',
	'uses'	=> 'Twitch\DonationsController@accept'
]);

Route::get('/donate/{channel_id}/callback', [
	'as'	=> 'twitch.donations.callback',
	'uses'	=> 'Twitch\DonationsController@callback'
]);