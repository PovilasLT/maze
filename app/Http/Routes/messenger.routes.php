<?php

Route::get('/pokalbiai', [
    'as'    => 'conversation.index',
    'uses'    => 'ConversationsController@index',
]);

Route::get('/pokalbiai/pokalbis/{conversation}', [
    'as'    => 'conversation.show',
    'uses'    => 'ConversationsController@show',
]);

Route::get('/pokalbiai/pradeti/{user}', [
    'as'    => 'conversation.create',
    'uses'    => 'ConversationsController@create',
]);

Route::post('/pokalbiai/pradeti', [
    'as'    => 'conversation.store',
    'uses'    => 'ConversationsController@store',
]);

Route::post('/pokalbiai/zinute/siusti', [
    'as'    => 'message.store',
    'uses'    => 'MessagesController@store',
]);

Route::get('/pokalbiai/{conversation}/{message}/perskaityta', [
    'as'    => 'message.read',
    'uses'    => 'MessagesController@read',
]);
