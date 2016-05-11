<?php 

Route::get('serveriai', [
	'as'	=> 'server.list',
	'uses'	=> 'ServerController@index'
]);

Route::get('serveriai/kurti', [
	'as' 	=> 'server.create',
	'uses'	=> 'ServerController@create'
]);

Route::post('serveriai/issaugoti', [
	'as'	=> 'server.store',
	'uses'	=> 'ServerController@store'
]);

Route::get('serveriai/{slug}', [
	'as'	=> 'server.show',
	'uses'	=> 'ServerController@show'
]);

Route::get('serveriai/{slug}/istrinti', [
	'as'	=> 'server.delete',
	'uses'	=> 'ServerController@destroy'
]);

Route::get('serveriai/{slug}/redaguoti', [
	'as'	=> 'server.edit',
	'uses'	=> 'ServerController@edit'
]);	

Route::post('serveriai/{slug}/atnauinti', [
	'as'	=> 'server.update',
	'uses'	=> 'ServerController@update'
]);	

Route::get('serveriai/{slug}/rakinti', [
	'as'	=> 'server.lock',
	'uses'	=> 'ServerController@lock'
]);

Route::get('serveriai/{slug}/patvirtinti', [
	'as'	=> 'server.confirm',
	'uses'	=> 'ServerController@confirm'
]);

Route::post('serveriai/{slug}/atmesti', [
	'as'	=> 'server.reject',
	'uses'	=> 'ServerController@reject'
]);


?>




