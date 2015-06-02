<?php

//Bendriniai puslapiai
Route::get('/', 'PageController@index');

//Autentikavimas

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

//Vartotojai

//Nustatymai

//Temos

Route::get('/tema/kurti', [
	'as'	=> 'topic.create',
	'uses'	=> 'TopicsController@create'
]);

Route::post('/tema/irasyti', [
	'as'	=> 'topic.store',
	'uses'	=> 'TopicsController@store'
]);

Route::get('/tema/{slug}/istrinti', [
	'as'	=> 'topic.delete',
	'uses'	=> 'TopicsController@delete'
]);

Route::get('/tema/{slug}/redaguoti', [
	'as'	=> 'topic.edit',
	'uses'	=> 'TopicsController@edit'
]);

Route::post('/tema/{slug}/atnaujinti', [
	'as'	=> 'topic.update',
	'uses'	=> 'TopicsController@update'
]);

Route::get('/tema/{slug}', [
	'as' 	=> 'topic.show',
	'uses'	=> 'TopicsController@show' 
]);

//Skiltys

//Pranesimai

//TV

//Blog'ai

//TODO: Senų route 301 redirectai.