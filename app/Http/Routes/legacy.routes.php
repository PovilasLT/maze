<?php

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