<?php

Route::get('/pranesimai/zymeti/pranesima/{id}', [
	'as' 	=> 'notification.mark',
	'uses'	=> 'NotificationsController@markAsRead'
]);

Route::get('/pranesimai/zymeti/visi', [
	'as'	=> 'notification.mark.all',
	'uses'	=> 'NotificationsController@markAllAsRead',
]);