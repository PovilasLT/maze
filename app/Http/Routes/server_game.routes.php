<?php 


Route::get('/zaidimai/kurti', [
	'as'	=> 'servergame.create',
	'uses'	=> 'ServerGameController@create'
]);

Route::post('/zaidimai/isaugoti', [
	'as'	=> 'servergame.store',
	'uses'	=> 'ServerGameController@store'
]);

?>