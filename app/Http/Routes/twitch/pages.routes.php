<?php

Route::get('/', [
    'as'    => 'twitch.pages.index',
    'uses'    => 'Twitch\PagesController@index'
]);