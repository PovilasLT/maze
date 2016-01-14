<?php

Route::post('/nodes/update', [
	'as' => 'nodes.update',
	'uses' => 'FrontPageNodesController@update'
]);

Route::get('/node/toggle/{id}', [
	'as' => 'nodes.toggle',
	'uses' => 'FrontPageNodesController@toggle'
]);