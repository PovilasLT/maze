<?php
Route::group(['domain' => env('DOMAIN', 'maze.lt')], function () {

    //API
    require_once('Routes/api.routes.php');

    //Bendriniai puslapiai
    require_once('Routes/page.routes.php');

    //Autentikavimas
    require_once('Routes/auth.routes.php');

    //Vartotojai
    require_once('Routes/user.routes.php');

    //Balsavimas
    require_once('Routes/vote.routes.php');

    //Nustatymai
    require_once('Routes/settings.routes.php');

    //Temos
    require_once('Routes/topic.routes.php');

    //Skiltys
    require_once('Routes/node.routes.php');

    //Pranesimai
    require_once('Routes/reply.routes.php');

    //Busenos
    require_once('Routes/status.routes.php');

    //Paieška
    require_once('Routes/search.routes.php');

    //AZ
    require_once('Routes/messenger.routes.php');

    //Pranesimu valdymas
    require_once('Routes/notification.routes.php');

    //Senų route 301 redirectai.
    require_once('Routes/legacy.routes.php');

    //Donation alert.
    //Dėl socketo ir SSL, alertai bus pagrindiniam domain.
    Route::get('/donate/{channel}/alert', [
        'as'    => 'twitch.donations.alert',
        'uses'  => 'Twitch\DonationsController@alert'
    ]);

});

Route::group(['domain' => 'tv.'.env('DOMAIN', 'maze.lt')], function () {
    //TV
    require_once('Routes/tv.routes.php');
});

Route::group(['domain' => 'twitch.'.env('DOMAIN', 'maze.lt')], function() {
    // Statiniai puslapiai
    require_once('Routes/twitch/pages.routes.php');

    // PaySera integracija streameriams.
    require_once('Routes/twitch/paysera.routes.php');
    
    // Twitch botas.
    require_once('Routes/twitch/bot.routes.php');

    require_once('Routes/twitch/donations.routes.php');
});