<?php

Route::get('/registruotis', [
	'as'	=> 'auth.register',
	'uses'	=> 'AuthController@register'
]);

Route::get('/prisijungti', [
	'as'	=> 'auth.login',
	'uses'	=> 'AuthController@login'
]);

Route::get('/atsijungti', [
	'as'	=> 'auth.logout',
	'uses'	=> 'AuthController@logout'
]);

Route::post('/registruotis', [
	'as'	=> 'auth.register.post',
	'uses'	=> 'AuthController@postRegister'
]);

Route::post('/prisijungti', [
	'as'	=> 'auth.login.post',
	'uses'	=> 'AuthController@postLogin'
]);

Route::get('/slaptazodis/pastas', [
	'middleware' => 'guest',
	'as' 	=> 'auth.reset.email',
	'uses'	=> 'AuthController@getEmail'
]);

Route::post('/slaptazodis/pastas', [
	'middleware' => 'guest',
	'as' 	=> 'auth.reset.email.post',
	'uses'	=> 'AuthController@postEmail'
]);

Route::get('/slaptazodis/keisti/{token}', [
	'middleware' => 'guest',
	'as' 	=> 'auth.reset.token',
	'uses'	=> 'AuthController@getReset'
]);

Route::post('/slaptazodis/keisti', [
	'middleware' => 'guest',
	'as' 	=> 'auth.reset.token.post',
	'uses'	=> 'AuthController@postReset'
]);