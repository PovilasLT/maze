<?php

Route::get('/profilis', [
    'as'    => 'user.profile',
    'uses'    => 'UsersController@profile'
]);

Route::get('/vartotojas/{slug}', [
    'as'    => 'user.show',
    'uses'    => 'UsersController@show'
]);

Route::get('/profilis', [
    'as'    => 'user.profile',
    'uses'    => 'UsersController@profile'
]);

Route::get('/vartototojas/{slug}/prenumeruoti', [
    'as'    => 'user.follow',
    'uses'    => 'UsersController@follow'
]);

Route::get('/vartotojas/{slug}/prenumeratoriai', [
    'as'    => 'user.followers',
    'uses'    => 'UsersController@followers'
]);

Route::get('/zinutes', [
    'as' => 'user.messages',
    'uses' => 'UsersController@messages'
]);

Route::get('/slapyvardis/keisti', [
    'as'    => 'user.change.username',
    'uses'    => 'UsersController@changeUsername',
]);

Route::post('/slapyvardis/keisti', [
    'as'    => 'user.change.username.post',
    'uses'    => 'UsersController@postChangeUsername',
]);

Route::get('/vartotojas/{id}/isjungti/vartotoja', [
    'as'    => 'user.disable.user',
    'uses'    => 'UsersController@disableUser',
]);

Route::get('/vartotojas/{id}/isjungti/balsus', [
    'as'    => 'user.disable.vote',
    'uses'    => 'UsersController@disableVote',
]);
