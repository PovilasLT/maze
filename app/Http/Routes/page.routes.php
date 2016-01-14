<?php

Route::get('/test', function() {
    \DB::connection()->enableQueryLog();

    $t = \maze\Notification::mentions()->get();
    // dd($t);
    dd(\DB::getQueryLog());
});

Route::get('/', 'PageController@index');

Route::get('/etiketas', [
    'as' => 'page.rules',
    'uses' => 'PageController@rules'
]);

Route::get('/apie', [
    'as' => 'page.about',
    'uses' => 'PageController@about'
]);

Route::get('/komanda', [
    'as' => 'page.team',
    'uses' => 'PageController@team'
]);

Route::get('/zinynas', [
    'as' => 'page.knowledgebase',
    'uses' => 'PageController@knowledgebase'
]);

Route::get('/susisiekti', [
    'as' => 'page.contact',
    'uses' => 'PageController@contact'
]);
