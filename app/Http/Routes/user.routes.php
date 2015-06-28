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