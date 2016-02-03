<?php

//Markdown parseris JavaScriptui
Route::post('/markdown', function()
{
	return markdown(Request::input('body'));	
});

Route::get('/api/users', function() {
	// return Cache::remember('users', 5, function() {
		return maze\User::paginate(20);
	// });
});

Route::get('/api/users/search/{query}', function($query) {
	return Cache::remember('users_search_'.$query, 3, function() use($query) {
		return maze\User::where('username', 'LIKE', '%'.$query.'%')->get();		
	});
});

Route::get('/api/users/twitch', function() {
	// return Cache::remember('twitch_users', 3, function() {
		return maze\User::whereNotNull('twitch')->get();
	// });
});



Route::post('api/access_token', function() {
 return Response::json(Authorizer::issueAccessToken());
});

Route::get('api', [
	'as'	=> 'page.api',
	'uses'	=> 'ApiPageController@index'
]);	

Route::get('api/register', [
	'as'	=> 'api.app.register',
	'uses'	=> 'ApiController@register'
]);	

Route::group(['prefix'=>'api','before' => 'oauth', 'middleware' => ['oauth']], function()
{
	Route::get('popular', 'ApiPageController@popular');
	Route::get('new', 'ApiPageController@newest');
	Route::resource('users', 'ApiUsersController', ['only' => ['index', 'show', 'edit']]);
	Route::resource('topics', 'ApiTopicsController', ['except' => ['delete']]);

	Route::post('replies/store', [
		'as'	=> 'replies.store',
		'uses'	=> 'ApiRepliesController@store'
	]);
	Route::post('replies/{id}/update', [
		'as'	=> 'replies.update',
		'uses'	=>'ApiRepliesController@update'
	]);

	Route::get('replies/rules', [
		'as'	=> 'replies.rules',
		'uses'	=>'ApiRepliesController@rules'
	]);

	Route::get('replies/{id}', [
		'as'	=> 'replies.show',
		'uses'	=>'ApiRepliesController@show'
	]);

});
