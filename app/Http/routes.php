<?php

//Bendriniai puslapiai
Route::get('/', function() {
	$mention = new \maze\Modules\Mentions\Mention();
	Eloquent::unguard();
	maze\Reply::create([
		'topic_id' => 1,
		'user_id'  => 1,
		'body'     => 'test',
	]);
	return null;
});

//Autentikavimas

Route::get('/registruotis', 'AuthController@register');
Route::get('/prisijungti', 'AuthController@login');
Route::get('/atsijungti', 'AuthController@logout');

Route::get('/reply/delete', 'RepliesController@delete');

//Vartotojai

//Nustatymai

//Temos

//Skiltys

//Pranesimai

//TV

//Blog'ai

//TODO: Senų route 301 redirectai.