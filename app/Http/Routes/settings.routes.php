<?php

Route::post('/nodes/update', [
    'as' => 'nodes.update',
    'uses' => 'FrontPageNodesController@update'
]);

Route::get('/node/toggle/{id}', [
    'as' => 'nodes.toggle',
    'uses' => 'FrontPageNodesController@toggle'
]);

/**
 * Nustatymai
 */

Route::get('/nustatymai/vartotojas', [
    'as'    => 'settings.user',
    'uses'    => 'SettingsController@userSettings'
]);

Route::get('/nustatymai/tv', [
    'as'    => 'settings.tv',
    'uses'    => 'SettingsController@tvSettings'
]);

Route::get('/nustatymai/slaptazodis', [
    'as'    => 'settings.password',
    'uses'    => 'SettingsController@passwordSettings'
]);

/**
 * Nustatymu issaugojimas
 */

Route::post('/nustatymai/vartotojas/issaugoti', [
    'as'    => 'settings.user.save',
    'uses'    => 'SettingsController@userSettingsSave'
]);

Route::post('/nustatymai/tv/issaugoti', [
    'as'    => 'settings.tv.save',
    'uses'    => 'SettingsController@tvSettingsSave'
]);

Route::post('/nustatymai/slaptazodis/issaugoti', [
    'as'    => 'settings.password.save',
    'uses'    => 'SettingsController@passwordSettingsSave'
]);
