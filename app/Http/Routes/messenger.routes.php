<?php

Route::get('/pokalbiai', [
	'as'	=> 'conversation.index',
	'uses'	=> 'ConversationsController@index',
]);

Route::get('/pokalbiai/pokalbis/{id}', [
	'as'	=> 'conversation.show',
	'uses'	=> 'ConversationsController@show',
]);

Route::get('/pokalbiai/pradeti/{id}', [
	'as'	=> 'conversation.create',
	'uses'	=> 'ConversationsController@create',
]);

Route::post('/pokalbiai/pradeti', [
	'as'	=> 'conversation.store',
	'uses'	=> 'ConversationsController@store',
]);

Route::post('/pokalbiai/zinute/siusti', [
	'as'	=> 'message.store',
	'uses'	=> 'MessagesController@store',
]);