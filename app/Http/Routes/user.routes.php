<?php

Route::get('/profilis', [
	'as'	=> 'user.profile',
	'uses'	=> 'UsersController@profile'
]);

Route::get('/vartotojas/{slug}', [
	'as'	=> 'user.show',
	'uses'	=> 'UsersController@show'
]);

Route::get('/profilis', [
	'as'	=> 'user.profile',
	'uses'	=> 'UsersController@profile'
]);

Route::get('/vartototojas/{slug}/prenumeruoti', [
	'as'	=> 'user.follow',
	'uses'	=> 'UsersController@follow'
]);

Route::get('/vartotojas/{slug}/prenumeratoriai', [
	'as'	=> 'user.followers',
	'uses'	=> 'UsersController@followers'
]);

Route::get('/zinutes', [
	'as' => 'user.messages',
	'uses' => 'UsersController@messages'
]);

Route::get('/profilis/nustatymai', [
	'as'	=> 'user.settings',
	'uses'	=> 'UsersController@settings'
]);


Route::post('/profilis/nustatymai/issaugoti', [
	'as'	=> 'user.settings.save',
	'uses'	=> 'UsersController@update'
]);