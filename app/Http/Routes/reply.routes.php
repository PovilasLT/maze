<?php 

Route::post('/pranesimas/rasyti', [
    'as'    => 'reply.store',
    'uses'    => 'RepliesController@store'
]);

Route::get('/pranesimas/{id}/atsakymas', [
    'as'    => 'reply.answer',
    'uses'    => 'RepliesController@markAnswer'
]);

Route::get('/pranesimas/{id}/redaguoti', [
    'as'    => 'reply.edit',
    'uses'    => 'RepliesController@edit'
]);

Route::post('/pranesimas/{id}/issaugoti', [
    'as'    => 'reply.update',
    'uses'    => 'RepliesController@update'
]);

Route::get('/pranesimas/{id}/istrinti', [
    'as'    => 'reply.delete',
    'uses'    => 'RepliesController@destroy'
]);
