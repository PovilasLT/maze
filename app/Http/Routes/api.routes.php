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




Route::resource('api/page', 'ApiPageController');
Route::resource('api/users', 'ApiUsersController');