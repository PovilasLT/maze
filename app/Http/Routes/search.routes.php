<?php

Route::get('paieska', [
    'as'	=>	'search.index',
    'uses'	=> 'SearchController@index'
]);

Route::any('paieska/rezultatai', [
    'as'	=>	'search.results',
    'uses'	=> 'SearchController@results'
]);