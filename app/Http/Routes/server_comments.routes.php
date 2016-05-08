<?php 

Route::post('/serveriai/{id}/komentaras/kurti', [
	'as'	=> 'server.comment.store',
	'uses'	=> 'ServerCommentController@store'
]);

Route::get('serveris/komentaras/{id}/redaguoti', [
	'as'	=> 'server.comment.edit',
	'uses'	=> 'ServerCommentController@edit'
]);

Route::post('serveris/komentaras/{id}/issaugoti', [
	'as'	=> 'server.comment.update',
	'uses'	=> 'ServerCommentController@update'
]);



Route::get('serveris/komentaras/{id}/istrinti', [
	'as'	=> 'server.comment.delete',
	'uses'	=> 'ServerCommentController@destroy'
]);

?>