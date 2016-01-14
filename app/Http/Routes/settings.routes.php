<?php

Route::post('/nodes/toggle', [
	'as' => 'nodes.update',
	'uses' => 'FrontPageNodesController@toggle'
]);