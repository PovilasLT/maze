<?php

Route::group(['before' => 'auth'], function(){
    Route::any('/topics/{id}/upvote', [
        'as' => 'topics.upvote',
        'uses' => 'TopicsController@upvote',
    ]);

    Route::any('/topics/{id}/downvote', [
        'as' => 'topics.downvote',
        'uses' => 'TopicsController@downvote',
    ]);

    Route::any('/replies/{id}/vote', [
        'as' => 'replies.upvote',
        'uses' => 'RepliesController@upVote',
    ]);
    Route::any('/replies/{id}/down', [
        'as' => 'replies.downvote',
        'uses' => 'RepliesController@downVote',
    ]);
});