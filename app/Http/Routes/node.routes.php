<?php

Route::get('/skiltis/kurti', [
    'as'    => 'node.create',
    'uses'    => 'NodesController@create'
]);


Route::post('/skiltis/irasyti', [
    'as'    => 'node.store',
    'uses'    => 'NodesController@store'
]);

Route::get('/skiltis/{slug}', [
    'as'    => 'node.show',
    'uses'    => 'NodesController@show'
]);
