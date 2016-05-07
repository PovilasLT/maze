<?php

Route::group(['prefix' => '/tema'], function () {

    /**
     * Prisijungusiems.
     */
    Route::group(['middleware' => 'auth'], function () {

        Route::get('/kurti', [
            'as'    => 'topic.create',
            'uses'    => 'TopicsController@create'
        ]);

        Route::post('/irasyti', [
            'as'    => 'topic.store',
            'uses'    => 'TopicsController@store'
        ]);

        Route::get('/{topic}/istrinti', [
            'as'    => 'topic.delete',
            'uses'    => 'TopicsController@destroy'
        ]);

        Route::get('/{topic}/redaguoti', [
            'as'    => 'topic.edit',
            'uses'    => 'TopicsController@edit'
        ]);

        Route::post('/{topic}/atnaujinti', [
            'as'    => 'topic.update',
            'uses'    => 'TopicsController@update'
        ]);
    });

    /**
     * Prisijungusiems Admin ir Mod
     */
    Route::group(['middleware' => ['auth', 'staff']], function() {
            Route::get('/{topic}/pakelti', [
                'as'    => 'topic.bump',
                'uses'    => 'TopicsController@bump'
            ]);

            Route::get('/{topic}/uzrakinti', [
                'as'    => 'topic.lock',
                'uses'    => 'TopicsController@lock'
            ]);

            Route::get('/{topic}/prisegti/skiltyje', [
                'as'    => 'topic.pinLocal',
                'uses'    => 'TopicsController@pinLocal'
            ]);

            Route::get('/{topic}/prisegti/globaliai', [
                'as'    => 'topic.pinGlobal',
                'uses'    => 'TopicsController@pinGlobal'
            ]);

            Route::get('/{topic}/prisegti/globaliai', [
                'as'    => 'topic.pinGlobal',
                'uses'    => 'TopicsController@pinGlobal'
            ]);

            Route::get('/{topic}/atsegti', [
                'as'    => 'topic.unpin',
                'uses'    => 'TopicsController@unpin'
            ]);

            Route::get('/{topic}/nuskandinti', [
                'as'    => 'topic.sink',
                'uses'    => 'TopicsController@sink'
            ]);

            Route::get('/{topic}/atgaivinti', [
                'as'    => 'topic.unsink',
                'uses'    => 'TopicsController@unsink'
            ]);
    });

    /**
     * Paprastos.
     */
    Route::get('/{topic}', [
        'as'    => 'topic.show',
        'uses'    => 'TopicsController@show'
    ]);
});
