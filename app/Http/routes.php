<?php

Route::group(['domain' => env('DOMAIN', 'maze.lt')], function () {

	//API
	require('Routes/api.routes.php');

	//Bendriniai puslapiai
	require('Routes/page.routes.php');

	//Autentikavimas
	require('Routes/auth.routes.php');

	//Vartotojai
	require('Routes/user.routes.php');

	//Balsavimas
	require('Routes/vote.routes.php');

	//Nustatymai
	require('Routes/settings.routes.php');

	//Temos
	require('Routes/topic.routes.php');

	//Skiltys
	require('Routes/node.routes.php');

	//Pranesimai
	require('Routes/reply.routes.php');

	//Busenos
	require('Routes/status.routes.php');

	//Paieška
	require('Routes/search.routes.php');

	//AZ
	require('Routes/messenger.routes.php');

	//Pranesimu valdymas
	require('Routes/notification.routes.php');

	//Senų route 301 redirectai.
	require('Routes/legacy.routes.php');

});

Route::group(['domain' => 'tv.'.env('DOMAIN', 'maze.lt')], function () {
	//TV
	require('Routes/tv.routes.php');
});