<?php

Route::group(['before' => 'manage_topics'], function () {
    Route::post('topics/recomend/{id}',  [
        'as' => 'topics.recomend',
        'uses' => 'TopicsController@recomend',
    ]);

    Route::post('topics/wiki/{id}',  [
        'as' => 'topics.wiki',
        'uses' => 'TopicsController@wiki',
    ]);

    Route::post('topics/pin/{id}',  [
        'as' => 'topics.pin',
        'uses' => 'TopicsController@pin',
    ]);

    Route::delete('topics/delete/{id}',  [
        'as' => 'topics.destroy',
        'uses' => 'TopicsController@destroy',
    ]);

    Route::post('topics/unsink/{id}',  [
        'as' => 'topics.unsink',
        'uses' => 'TopicsController@unsink',
    ]);

    Route::post('topics/sink/{id}',  [
        'as' => 'topics.sink',
        'uses' => 'TopicsController@sink',
    ]);

    Route::post('topics/delete/{id}', [
        'as'    =>    'topics.lock',
        'uses'    => 'TopicsController@lock'
    ]);
});

Route::group(['before' => 'manage_users'], function () {
    Route::post('vartotojas/{slug}/{id}/blokuoti',  [
        'as' => 'user.ban',
        'uses' => 'UsersController@ban',
    ]);
});

Route::controller('admin', 'AdminController');
