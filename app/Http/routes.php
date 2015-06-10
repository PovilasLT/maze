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

Route::get('/vartotojas/{slug}', [
	'as'	=> 'user.show',
	'uses'	=> 'UsersController@show'
]);

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

Route::get('/tema/{id}/istrinti', [
	'as'	=> 'topic.delete',
	'uses'	=> 'TopicsController@delete'
]);

Route::get('/tema/{id}/redaguoti', [
	'as'	=> 'topic.edit',
	'uses'	=> 'TopicsController@edit'
]);

Route::post('/tema/{id}/atnaujinti', [
	'as'	=> 'topic.update',
	'uses'	=> 'TopicsController@update'
]);

Route::get('/tema/{id}/pakelti', [
	'as'	=> 'topic.bump',
	'uses'	=> 'TopicsController@bump'
]);

Route::get('/tema/{id}/uzrakinti', [
	'as'	=> 'topic.lock',
	'uses'	=> 'TopicsController@lock'
]);

Route::get('/tema/{id}/prisegti/skiltyje', [
	'as'	=> 'topic.pinLocal',
	'uses'	=> 'TopicsController@pinLocal'
]);

Route::get('/tema/{id}/prisegti/globaliai', [
	'as'	=> 'topic.pinGlobal',
	'uses'	=> 'TopicsController@pinGlobal'
]);

Route::get('/tema/{id}/prisegti/globaliai', [
	'as'	=> 'topic.pinGlobal',
	'uses'	=> 'TopicsController@pinGlobal'
]);


Route::get('/tema/{id}/atsegti', [
	'as'	=> 'topic.unpin',
	'uses'	=> 'TopicsController@unpin'
]);

Route::get('/tema/{id}/nuskandinti', [
	'as'	=> 'topic.sink',
	'uses'	=> 'TopicsController@sink'
]);

Route::get('/tema/{slug}', [
	'as' 	=> 'topic.show',
	'uses'	=> 'TopicsController@show' 
]);

//Skiltys

Route::get('/skiltis/{slug}', [
	'as' 	=> 'node.show',
	// 'uses'	=> 'TopicsController@show' 
]);

//Pranesimai

//TV

//Blog'ai

//TODO: Senų route 301 redirectai.