<?php

Route::group(['before' => 'auth'], function(){
    Route::any('/balsuoti/{vote}/{type}/{id}/', [
        'as'    => 'vote',
        'uses'  => 'VotesController@vote'
    ]);
});