<?php

//Markdown parseris JavaScriptui
Route::post('/markdown', function()
{
	return Markdown::convertToHtml(Request::input('body'));	
});

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
	'uses'	=> 'TopicsController@destroy'
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
	'uses'	=> 'NodesController@show' 
]);

//Pranesimai

Route::post('/pranesimas/rasyti', [
	'as'	=> 'reply.store',
	'uses'	=> 'RepliesController@store'
]);

Route::get('/pranesimas/{id}/atsakymas', [
	'as'	=> 'reply.answer',
	'uses'	=> 'RepliesController@markAnswer'
]);

Route::get('/pranesimas/{id}/redaguoti', [
	'as'	=> 'reply.edit',
	'uses'	=> 'RepliesController@edit'
]);

Route::post('/pranesimas/{id}/issaugoti', [
	'as'	=> 'reply.update',
	'uses'	=> 'RepliesController@update'
]);

Route::get('/pranesimas/{id}/istrinti', [
	'as'	=> 'reply.delete',
	'uses'	=> 'RepliesController@destroy'
]);

//TV

//Blog'ai

//Senų route 301 redirectai.

Route::get('/users/{id}', function($id)
{
	$user = maze\User::findOrFail($id);
	return redirect()->route('user.show', [$user->slug], 301);
});

Route::get('/vartotojas/{slug}/{id}', function($slug, $id) {
	$user = maze\User::findOrFail($id);
	return redirect()->route('user.show', [$user->slug], 301);
});

Route::get('/topics/{id}', function($id) {
	$topic = maze\Topic::findOrFail($id);
	return redirect()->route('topic.show', [$topic->slug], 301);
});

Route::get('/tema/{slug}/{id}', function($slug, $id) {
	$topic = maze\Topic::findOrFail($id);
	return redirect()->route('topic.show', [$topic->slug], 301);
});