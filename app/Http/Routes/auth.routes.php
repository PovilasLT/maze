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