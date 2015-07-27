<?php

Route::post('/busena/komentuoti/', [
	'as'	=> 'status.comment.create',
	'uses'	=> 'StatusesController@commentCreate'
]);

Route::get('/busena/komentaras/{id}/istrinti', [
	'as'	=> 'status.comment.delete',
	'uses'	=> 'StatusesController@commentDelete'
]);

Route::get('/busena/komentaras/{id}/redaguoti', [
	'as'	=> 'status.comment.edit',
	'uses'	=> 'StatusesController@commentEdit'
]);

Route::post('/busena/komentaras/issaugoti', [
	'as'	=> 'status.comment.save',
	'uses'	=> 'StatusesController@commentSave'
]);

Route::post('/busena/kurti', [
	'as'	=> 'status.create',
	'uses'	=> 'StatusesController@create'
]);

Route::get('/busena/{id}/istrinti', [
	'as'	=> 'status.delete',
	'uses'	=> 'StatusesController@delete'
]);

Route::get('/busena/{id}/redaguoti', [
	'as'	=> 'status.edit',
	'uses'	=> 'StatusesController@edit'
]);

Route::post('/busena/{id}/issaugoti', [
	'as'	=> 'status.save',
	'uses'	=> 'StatusesController@save'
]);

Route::get('/busena/{id}', [
	'as'	=> 'status.show',
	'uses'	=> 'StatusesController@show'
]);