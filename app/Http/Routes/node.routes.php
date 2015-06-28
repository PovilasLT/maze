<?php

Route::get('/skiltis/{slug}', [
	'as' 	=> 'node.show',
	'uses'	=> 'NodesController@show' 
]);